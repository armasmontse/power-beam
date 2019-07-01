<?php namespace App\Http\Helpers\Traits\Auth;

use Auth;

trait RedirectPathTrait {


    /**
     * Get the post register / login redirect path.
     *
     * @return string
     */
    public function redirectPath()
    {
		$user = Auth::user();

		$previous_url = session('CltvoPreviousURL');

		if($user) {

			if($user->hasPermission("admin_access")) {
				return route("admin::index");
			}
			
			return route('user::projects.index', ['user' => $user]);
		}

		return route("client::pages.index");
    }

}
