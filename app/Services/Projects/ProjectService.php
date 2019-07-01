<?php 

namespace App\Services\Projects;

use App\Models\Projects\Project;

class ProjectService
{
	public static function create($args)
	{
		$project = Project::create($args);
		$production = $project->production()->firstOrCreate([]);
		return $project;
	}
}