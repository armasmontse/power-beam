<?php

namespace App\Http\Controllers\Admin\Quotes;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Models\Projects\Project;
use App\Models\Projects\Quote;

class ManageQuotesController extends Controller
{
	public function show(Project $projects_admin, Quote $admin_quote)
	{
		$data = [
			'project' => $projects_admin,
			'quote' => $admin_quote
		];

		return view('admin.quotes.show', $data);
	}
}