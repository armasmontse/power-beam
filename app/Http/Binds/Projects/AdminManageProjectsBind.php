<?php

namespace App\Http\Binds\Projects;

use Route;
use App\Http\Binds\CltvoBind;
use App\Models\Projects\Project;

class AdminManageProjectsBind extends CltvoBind
{
    public static function Bind()
    {
        Route::bind('projects_admin', function ($id){
            return Project::find($id);
        });
    }

}
