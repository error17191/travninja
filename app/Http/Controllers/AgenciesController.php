<?php

namespace App\Http\Controllers;

use App\Agency;
use Illuminate\Http\Request;

class AgenciesController extends Controller
{
    /**
     *show all agencies
     *
     */
    public function index(){
        return response()->json(['data' => Agency::all()],200);
    }

    /**
     * store new agency
     *
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $agency = Agency::create($data);
        return response()->json(['data' => $agency], 201);
    }

    /**
     *update an agency
     *
     */
    public function update(Request $request,Agency $agency){
        $agency->update($request->all());
        return response()->json(['data' => $agency],201);
    }
}
