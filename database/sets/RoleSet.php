<?php
use App\Console\Cltvo\SetSite\CltvoSet;
use Illuminate\Console\Command;

class RoleSet extends CltvoSet
{
    /**
     * Etiqueta a desplegarse par ainformar final
     */
    protected $label =  "roles";

    /**
     * nombre de la clase a ser sembrada
     */
    protected function CltvoGetModelClass(){
        return "App\Models\Users\Role";
    }

    /**
     * valores a ser introducidos en la base
     */
    protected function CltvoGetItems(){
        return [
            [
                "slug" => "admin",
                "label"=> "Administrador"
            ],
            [
                "slug" => "super_admin",
                "label"=> "Super administrador"
            ],
            [
                "slug"  => "project_manager",
                "label" =>  "Project Manager"
            ]
        ];
    }

}
