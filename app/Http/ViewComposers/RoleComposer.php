<?php

namespace App\Http\ViewComposers;

use App\Repositories\Roles\IRoleRepository;
use Illuminate\View\View;

class RoleComposer
{

    protected $roles;

    public function __construct(IRoleRepository $roles)
    {
        $this->roles = $roles;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('role_array', $this->roles->getRoleArray());
    }
}