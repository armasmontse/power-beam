<?php

namespace App\Http\Binds\Users;

use App\Http\Binds\CltvoBind;
use App\Models\Users\Company;

use Route;

class ManageCompaniesBind extends CltvoBind
{

    /**
     * bind methods
     */
    public static function Bind(){
        // para las empresas
        Route::bind('company', function ($company) {
            return Company::find($company);
        });
    }

}
