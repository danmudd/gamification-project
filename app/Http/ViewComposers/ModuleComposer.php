<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Repositories\Modules\IModuleRepository;

class ModuleComposer
{

    protected $modules;

    public function __construct(IModuleRepository $modules)
    {
        $this->modules = $modules;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('module_array', $this->modules->getModuleArray());
    }
}