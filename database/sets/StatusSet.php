<?php

use App\Console\Cltvo\SetSite\CltvoSet;
use Illuminate\Console\Command;
use App\Models\Projects\Status;
use App\Services\Projects\StatusService;

class StatusSet extends CltvoSet
{
    /**
     * Etiqueta a desplegarse par ainformar final
     */
    protected $label = "Statuses";

    /**
     * nombre de la clase a ser sembrada
     */
    protected function CltvoGetModelClass(){
        return "App\Models\Projects\Status";
    }

    /**
     * valores a ser introducidos en la base
     */
    protected function CltvoGetItems(){
        return [
            [
                "slug"  => "new",
                "label" => "New",
                'editable' => false,
                'group_slug' => 'quick-turn'
            ],
            [
                "slug"  => "quoting",
                "label" => "Quoting",
                'editable' => false,
                'previous' => 'new',
                'group_slug' => 'quoting'
            ],
            [
                "slug"  => "quoted",
                "label" => "Quoted",
                'editable' => false,
                'previous' => 'quoting',
                'group_slug' => 'quoting'
            ],
            [
                "slug"  => "pending-info",
                "label" => "Pending info",
                'editable' => false,
                'previous' => 'quoted',
                'group_slug' => 'production'
            ],
            [
                "slug"  => "reviewing",
                "label" => "Reviewing",
                'editable' => false,
                'previous' => 'pending-info',
                'group_slug' => 'production'
            ],
            [
                "slug"  => "pending-payment",
                "label" => "Pending payment",
                'editable' => false,
                'previous' => 'reviewing',
                'group_slug' => 'production'
            ],
            [
                "slug"  => "footprints",
                "label" => "Footprints",
                'editable' => true,
                'previous' => 'pending-payment',
                'group_slug' => 'production'
            ],
            [
                "slug"  => "placement",
                "label" => "Placement",
                'editable' => false,
                'previous' => 'footprints',
                'group_slug' => 'production'
            ],
            [
                "slug"  => "pending-approval",
                "label" => "Pending Approval",
                'editable' => false,
                'previous' => 'placement',
                'group_slug' => 'production'
            ],
            [
                "slug"  => "routing",
                "label" => "Routing",
                'editable' => true,
                'previous' => 'pending-approval',
                'group_slug' => 'production'
            ],
            [
                "slug"  => "generating-output-files",
                "label" => "Generating Output Files",
                'editable' => false,
                'previous' => 'routing',
                'group_slug' => 'production'
            ],
            [
                "slug"  => "delivered",
                "label" => "Delivered",
                'editable' => false,
                'previous' => 'generating-output-files',
                'group_slug' => 'production'
            ],
        ];
    }

    /**
     *  Método de introducción de valores
     *  @param array   $args   Argumentos que definiran el sembrado
     *  @param Command $command     Comando actual
     */
    protected function CltvoSower(array $args, Command $command)
    {
        $status = Status::where(['slug' => $args['slug']])->first();

        if(!$status){
        	$status = $this->create($args);
            if ($status){
                $command->line('<info>' . $args[$this->model_label] . ':</info>' . ' successfully set.');
            }else{
                $command->error('<error>' . $args[$this->model_label] . ':</error>' . ' not successfully set.');
            }
        }else {
            $command->line('<comment>' . $args[$this->model_label] . ':</comment>' . ' previously set.');
        }
    }

    protected function create($args)
    {
    	if (array_key_exists('previous', $args)) {    		
    		$previous = Status::where('slug', $args['previous'])->first();
    		$args['status_id'] = ! is_null($previous) ? $previous->id : null;
    		unset($args['previous']);
    	}

		return StatusService::create($args);
    }
}