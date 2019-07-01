<?php
namespace App\Http\ViewComposers\Emails;

use Illuminate\Contracts\View\View;

use App\Models\Settings\Setting;

class EmailLayoutComposer
{
	public function compose(View $view)
	{
        $view->with('setting_contact', Setting::getContact());
	}
}
