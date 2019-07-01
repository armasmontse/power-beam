<?php 

namespace App\Services\Projects;

use App\Models\Projects\Status;

class StatusService
{
	public static function create($args)
	{
		return Status::create($args);
	}
}