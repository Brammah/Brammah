<?php

namespace App\Http\Helpers;

use Illuminate\Support\Facades\Auth;

class UserHelper
{
    public static function getUserRolesString()
    {
        return implode(',', Auth::user()->roles->pluck('name')->toArray());
    }
}