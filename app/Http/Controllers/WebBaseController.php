<?php

namespace App\Http\Controllers;


use Illuminate\Contracts\Auth\Authenticatable;

class WebBaseController extends Controller
{
    public function getCurrentUser(): Authenticatable
    {
        return auth()->user();
    }

    public function getCurrenUserId(): int
    {
        return auth()->id();
    }
}
