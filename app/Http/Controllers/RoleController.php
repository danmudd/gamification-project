<?php
namespace App\Http\Controllers;

use App\Http\Requests\Roles\CreateRoleRequest;
use App\Http\Requests\Roles\UpdateRoleRequest;
use App\Http\Requests\Roles\AddRolePermissionRequest;
use App\Http\Requests\Roles\RemoveRolePermissionRequest;
use App\Repositories\Permissions\IPermissionRepository;
use App\Repositories\Roles\IRoleRepository;

class RoleController extends Controller
{
    protected $roles;
    protected $permissions;

    public function __construct(IRoleRepository $roles, IPermissionRepository $permissions)
    {
        $this->roles = $roles;
        $this->permissions = $permissions;
        $this->middleware('auth');
    }

    public function index()
    {
        $roles = $this->roles->getAll();
        return view('roles.list', compact('roles'));
    }

    // DEPRECATED.
    public function create()
    {
        return view('roles.create');
    }

    public function store(CreateRoleRequest $request)
    {
        $attributes = $request->all();

        $this->roles->create($attributes);

        return redirect()->route('roles.index');
    }

    public function show($id)
    {
        $role = $this->roles->get($id, ['perms']);
        $permissions = $this->permissions->getPermissionArray();

        return view('roles.view', compact('role', 'permissions'));
    }

    public function update(UpdateRoleRequest $request, $role)
    {
        $attributes = $request->all();
        $this->roles->update($role, $attributes);

        if($request->ajax())
        {
            return response()->json();
        }

        return redirect()->back();
    }

    public function destroy($id)
    {
        $this->roles->delete($id);

        return redirect()->route('roles.index');
    }

    public function addPermission(AddRolePermissionRequest $request, $role)
    {
        $this->roles->addPermission($role, $request->all());

        if($request->ajax())
        {
            return response()->json();
        }

        return redirect()->back();
    }

    public function removePermission($role, $permission)
    {
        $this->roles->removePermission($role, $permission);

        return redirect()->route('roles.show', $role);
    }

}