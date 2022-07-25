<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function userCount()
    {
        $userCount = User::all()->count();
        return $userCount;
    }

    public function transaksiCount()
    {
        $userCount = User::all()->count();
        return $userCount;
    }
}
