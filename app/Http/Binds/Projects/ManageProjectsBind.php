<?php

namespace App\Http\Binds\Projects;

use Route;
use App\Http\Binds\CltvoBind;
use App\Models\Projects\Project;

class ManageProjectsBind extends CltvoBind
{
    public static function Bind()
    {
        Route::bind('user_project', function ($slug){
            return Project::where(['slug' => $slug])->first();
        });
    }

}
