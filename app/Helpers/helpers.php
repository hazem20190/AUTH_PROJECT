<?php

use Illuminate\Support\Facades\Auth;

function permission(...$permission)
{
    return Auth::guard('admin')->user()->hasAnyPermission($permission) ? true : false;
}

function role(...$role)
{
    return Auth::guard('admin')->user()->hasAnyRole($role) ? true : false;
}
