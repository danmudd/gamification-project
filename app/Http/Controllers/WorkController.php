<?php
namespace App\Http\Controllers;

use App\Http\Requests\Roles\CreateRoleRequest;
use App\Http\Requests\Roles\UpdateRoleRequest;
use App\Http\Requests\Roles\AddRolePermissionRequest;
use App\Http\Requests\Roles\RemoveRolePermissionRequest;
use App\Http\Requests\Works\CreateWorkRequest;
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
        $works = $this->works->getAll();
        return view('works.list', compact('works'));
    }

    public function store(CreateWorkRequest $request)
    {
        $attributes = $request->all();

        $this->works->create($attributes);

        return redirect()->route('works.index');
    }

    public function show($id)
    {
        $work = $this->works->get($id);

        return view('works.view', compact('work'));
    }

    public function update(UpdateWorkRequest $request, $work)
    {
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
        $this->works->delete($id);

        return redirect()->route('works.index');
    }
}