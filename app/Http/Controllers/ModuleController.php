<?php
namespace App\Http\Controllers;

use App\Http\Requests\Modules\AddModuleUserRequest;
use App\Http\Requests\Modules\CreateModuleRequest;
use App\Http\Requests\Modules\UpdateModuleRequest;
use App\Repositories\Modules\IModuleRepository;
use App\Repositories\Users\IUserRepository;


class ModuleController extends Controller
{
    protected $modules;
    protected $users;

    public function __construct(IModuleRepository $modules, IUserRepository $users)
    {
        $this->modules = $modules;
        $this->users = $users;
        $this->middleware('auth');
    }

    public function index()
    {
        $modules = [];
        $user = \Auth::user();
        if($user->can('modules.view-all'))
        {
            $modules = $this->modules->getAll();
        }
        else
        {
            $modules = $user->modules;
        }

        return view('modules.list', compact('modules'));
    }

    public function store(CreateModuleRequest $request)
    {
        $attributes = $request->all();

        $this->modules->create($attributes);

        return redirect()->route('modules.index');
    }

    public function show($id)
    {
        $module = $this->modules->get($id);

        $this->authorize('show', $module);
        $userlist = $this->users->getAll();
        return view('modules.view', compact('module', 'userlist'));
    }

    public function update(UpdateModuleRequest $request, $module)
    {
        $attributes = $request->all();
        $this->modules->update($module, $attributes);

        if($request->ajax())
        {
            return response()->json();
        }

        return redirect()->back();
    }

    public function destroy($id)
    {
        $this->modules->delete($id);
        return redirect()->route('modules.index');
    }

    public function addUser(AddModuleUserRequest $request, $module)
    {
        $this->modules->addUser($module, $request->all());

        if($request->ajax())
        {
            return response()->json();
        }

        return redirect()->back();
    }

    public function removeUser($module, $user)
    {
        $this->modules->removeUser($module, $user);

        return redirect()->route('modules.show', $module);
    }
}