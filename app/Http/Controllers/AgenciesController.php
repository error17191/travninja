<?php

namespace App\Http\Controllers;

use App\Agency;
use Illuminate\Validation\Rule;
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

    public function show(Agency $agency){
        return response()->json(['data' => $agency],200);
    }

    /**
     * store new agency
     *
     */
    public function store(Request $request)
    {
        $request->validate($this->validations());
        $data = $request->all();
        $agency = Agency::create($data);
        return response()->json(['data' => $agency], 201);
    }

    /**
     *update an agency
     *
     */
    public function update(Request $request,Agency $agency){
        $validations = $this->validations();
        $validations['uid'] = [
            'required',
            Rule::unique('agencies','uid')->ignore($agency->id)
        ];
        $request->validate($validations);
        $agency->update($request->all());
        return response()->json(['data' => $agency],201);
    }

    /**
     *deleting an agency
     *
     */
    public function destroy(Agency $agency){
        Agency::destroy($agency->id);
        return response()->json(['status' => true],200);
    }

    private function validations(){
        return [
            'name' => 'required|max:255',
            'phone' => 'required|max:255',
            'mobil' => 'required|max:255',
            'uid' => 'required|unique:agencies,uid'
        ];
    }
}
