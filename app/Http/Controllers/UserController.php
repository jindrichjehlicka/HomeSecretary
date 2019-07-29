<?php

namespace HomeSecretary\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use HomeSecretary\User;
use Carbon\Carbon;
class UserController extends Controller
{
    public function search(Request $request)
    {
        $name = $request->search_string;
        return User::where('name', 'LIKE', "%$name%")->limit(10)->get();
    }
}
