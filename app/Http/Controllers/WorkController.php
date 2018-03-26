<?php
namespace App\Http\Controllers;

use App\Events\WorkCreated;
use App\Http\Requests\Roles\CreateRoleRequest;
use App\Http\Requests\Roles\UpdateRoleRequest;
use App\Http\Requests\Roles\AddRolePermissionRequest;
use App\Http\Requests\Roles\RemoveRolePermissionRequest;
use App\Http\Requests\Works\CreateWorkRequest;
use App\Models\User;
use App\Repositories\Modules\IModuleRepository;
use App\Repositories\Permissions\IPermissionRepository;
use App\Repositories\Roles\IRoleRepository;
use App\Repositories\Works\IWorkRepository;

class WorkController extends Controller
{
    protected $works;
    protected $modules;

    public function __construct(IWorkRepository $works, IModuleRepository $modules)
    {
        $this->works = $works;
        $this->modules = $modules;
        $this->middleware('auth');
    }

    public function index()
    {

        $works = [];
        $user = \Auth::user();
        if($user->can('works.view-all'))
        {
            $works = $this->works->getAll();
        }
        else
        {
            $user->load(['modules.works' => function ($q) use ( &$works ) {
                $works = $q->get()->unique();
            }]);
        }

        return view('works.list', compact('works'));
    }

    public function store(CreateWorkRequest $request)
    {
        $attributes = $request->all();
        $user = \Auth::user();

        $module = $this->modules->get($attributes['module_id']);
        if($user->may('show', $module))
        {
            $work = $this->works->create($attributes);
            event(new WorkCreated($work));
        }

        return redirect()->route('works.index');
    }

    public function show($id)
    {
        $work = $this->works->get($id, ['module', 'attachments', 'feedbacks']);
        $this->authorize('show', $work);

        return view('works.view', compact('work'));
    }

    public function update(UpdateWorkRequest $request, $id)
    {
        $work = $this->works->get($id);

        $this->authorize('update', $work);

        $attributes = $request->all();
        $this->works->update($work, $attributes);

        if($request->ajax())
        {
            return response()->json();
        }

        return redirect()->back();
    }

    public function destroy($id)
    {
        $work = $this->works->get($id);

        $this->authorize('destroy', $work);
        $this->works->delete($id);

        return redirect()->route('works.index');
    }
}