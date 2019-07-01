<?php

namespace App\Http\ViewComposers\Client;

use Auth;
use App\Models\Seo\Seo;
use App\Models\Settings\Setting;
use Illuminate\Contracts\View\View;

class ClientLayoutComposer
{
	public function compose(View $view)
	{
		$view->with('contact_phone', Setting::getContactPhone('phone'));
		$view->with('contact_mail', Setting::getEmail('contact'));
		$view->with('seo', Seo::getForCurrentRoute());
	}
}
