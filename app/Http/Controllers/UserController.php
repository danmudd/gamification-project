<?php
namespace App\Http\Controllers;

use App\Achievements\UserExceptionalFeedback;
use App\Achievements\UserExceptionalWork;
use App\Http\Requests\Users\CreateUserRequest;
use App\Http\Requests\Users\GiveAchievementRequest;
use App\Http\Requests\Users\UpdateUserRequest;
use App\Http\Requests\Users\SearchUserRequest;
use App\Models\User;
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
        $achievements = collect([new UserExceptionalFeedback(), new UserExceptionalWork()]);
        $achievements = $achievements->mapWithKeys(function ($item)
        {
            $model = $item->getModel();
            return [str_replace('\\', '\\\\', $model->class_name) => $model->name];
        });

        return view('users.view', compact('user', 'achievements'));
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

    public function giveAchievement(GiveAchievementRequest $request, $user)
    {
        $user = $this->user->get($user);
        $attributes = $request->all();
        $user->unlock(new $attributes['achievement']());
    }
}