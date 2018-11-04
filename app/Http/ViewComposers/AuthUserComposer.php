<?php

namespace App\Http\ViewComposers;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthUserComposer
{
    protected $is_auth;
    protected $user;

    public function __construct()
    {
        $this->is_auth = Auth::check();
        $this->user = Auth::user();
    }

    public function compose(View $view)
    {
        $view->with('is_auth', $this->is_auth)
             ->with('user', $this->user);
    }
}
