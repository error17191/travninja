<?php

namespace App\Http\Controllers;

use App\Agency;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class AgenciesController extends Controller
{
    /**
     * show all agencies
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        return response()->json(['data' => Agency::filter($request)->get()]);
    }

    /**
     *show one agency
     *
     * @param \App\Agency $agency
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Agency $agency): \Illuminate\Http\JsonResponse
    {
        return response()->json(['data' => $agency]);
    }

    /**
     * store new agency
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate($this->rules());
        $data = $request->all();
        $agency = Agency::create($request->all());
        return response()->json(['data' => $agency], 201);
    }

    /**
     * update an agency
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Agency $agency
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Agency $agency): \Illuminate\Http\JsonResponse
    {
        $request->validate($this->rules($agency));
        $agency->update($request->all());
        return response()->json(['data' => $agency]);
    }

    /**
     * deleting an agency
     *
     * @param \App\Agency $agency
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Agency $agency): \Illuminate\Http\JsonResponse
    {
        $agency->delete();
        return response()->json(['status' => true]);
    }

    /**
     * create an validation array
     *
     * @param \App\Agency|null $agency
     *
     * @return array
     */
    private function rules(Agency $agency = null): array
    {
        return [
            'name' => 'required|max:255',
            'phone' => 'required|max:255',
            'mobile' => 'required|max:255',
            'uid' => $agency ? [
                'required',
                'max:255',
                Rule::unique('agencies', 'uid')->ignore($agency->id)
            ] : 'required|unique:agencies,uid|max:255'
        ];
    }
}
