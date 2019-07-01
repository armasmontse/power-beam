<?php

namespace App\Http\Binds\Quotes;

use Route;
use App\Http\Binds\CltvoBind;
use App\Models\Projects\Quote;

class AdminManageQuotesBind extends CltvoBind
{
    public static function Bind()
    {
        Route::bind('admin_quote', function ($id, $route){
            $parameters = $route->parameters();
            if (!array_key_exists('projects_admin', $parameters)) {
            	return null;
            }
            return Quote::where('id', $id)->where('project_id', $parameters['projects_admin']->id)->first();
        });
    }
}
