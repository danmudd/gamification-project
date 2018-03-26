<?php
namespace App\Http\Controllers;

use App\Http\Requests\Users\CreateUserRequest;
use App\Http\Requests\Users\UpdateUserRequest;
use App\Http\Requests\Users\SearchUserRequest;
use App\Repositories\Roles\IRoleRepository;
use App\Repositories\Users\IUserRepository;

class UserController extends Controller
{
    protected $user;
    protected $role;

    public function __construct(IUserRepository $user, IRoleRepository $role)
    {
        $this->user = $user;
        $this->role = $role;
        $this->middleware('auth');
    }

    public function index()
    {
        $users = $this->user->getAll();

        return view('users.list', compact('users'));
    }

    // DEPRECATED.
    public function create()
    {
        $roles = $this->role->getRoleArray();
        return view('users.create', compact('roles'));
    }

    public function store(CreateUserRequest $request)
    {
        $attributes = $request->all();

        $this->user->create($attributes);

        return redirect()->route('users.index');
    }

    public function show($id)
    {
        $user = $this->user->get($id);
        return view('users.view', compact('user'));
    }

    public function update(UpdateUserRequest $request, $user)
    {
        $attributes = $request->all();
        $this->user->update($user, $attributes);

        if($request->ajax())
        {
            return response()->json();
        }

        return redirect()->back();
    }

    public function destroy($id)
    {
        $this->user->delete($id);
        return redirect()->route('users.index');
    }

    public function achievements($id)
    {
        $user = $this->user->get($id);
        return view('users.achievements', compact('user'));
    }

    public function search(SearchUserRequest $request)
    {
        $results =  $this->user->search($request->all());

        return $results;
    }
}