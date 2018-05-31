<?php

namespace App\Http\Controllers;

use App\Agency;
use Illuminate\Http\Request;

class AgenciesController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->all();
        unset($data['password_confirmation']);
        $agency = Agency::create($data);
        return response()->json(['data' => $agency], 201);
    }
}
