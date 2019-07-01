<?php

use App\Console\Cltvo\SetSite\CltvoSet;
use Illuminate\Console\Command;
use App\Models\Projects\Status;
use App\Services\Projects\StatusService;

class OrderStatusSet extends CltvoSet
{
    /**
     * Etiqueta a desplegarse par ainformar final
     */
	protected $label = 'Orders Status';
	
	/**
	 * Etiqueta para mostrar mensaje
	 */
	protected $model_label = 'slug';

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
				'slug'  => 'new',
				'order' => 0
            ],
            [
				'slug'  => 'quoting',
				'order' => 0
            ],
            [
				'slug'  => 'quoted',
				'order' => 0
            ],
            [
				'slug'  => 'pending-info',
				'order' => 0
            ],
            [
				'slug'  => 'reviewing',
				'order' => 0
            ],
            [
				'slug'  => 'pending-payment',
				'order' => 0
            ],
            [
				'slug'  => 'footprints',
				'order' => 0
            ],
            [
				'slug'  => 'placement',
				'order' => 0
            ],
            [
				'slug'  => 'pending-approval',
				'order' => 0
            ],
            [
				'slug'  => 'routing',
				'order' => 0
            ],
            [
				'slug'  => 'generating-output-files',
				'order' => 0
            ],
            [
				'slug'  => 'delivered',
				'order' => 1
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
			
			tap($status)->fill(['order' => $args['order']])->save();

            if ($status){
                $command->line('<info>' . $args[$this->model_label] . ':</info>' . ' order successfully set.');
            }else{
                $command->error('<error>' . $args[$this->model_label] . ':</error>' . ' order not successfully set.');
			}
			
        }else {

            $command->line('<comment>' . $args[$this->model_label] . ':</comment>' . ' order cant be set.');
        }
    }
}