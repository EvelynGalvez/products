<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CreateBranchRequest;
use App\Http\Requests\Api\IndexBranchRequest;
use App\Http\Requests\Api\UpdateBranchRequest;
use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexBranchRequest $request)
    {
        $input = $request->validated();
        $rows = Branch::search($input);

        return response()->json(['message' => 'Datos obtenidos', 'data' => $rows]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateBranchRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateBranchRequest $request)
    {
        /*$branch = new Branch();
        $branch->name = $request->input('name');
        $branch->save();*/

        $input = $request->validated();
        $branch = Branch::create($input);

        return response()->json(['message' => 'Datos obtenidos por json', 'data' => $branch]); //Arreglo con 2 indices (message y data)
    }

    /**
     * Display the specified resource.
     *
     * @param  Branch $branch
     * @return \Illuminate\Http\Response
     */
    public function show(Branch $branch)
    {
        return response()->json(['message' => 'Datos obtenidos', 'data' => $branch]);

        /*
        $branch = Branch::find($id);
        if($branch){
            return response()->json(['message' => 'Datos obtenidos', 'data' => $branch]);
        }
        return response()->json(['message' => 'El ID no fue encontrado'], '404');
        */
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateBranchRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBranchRequest $request, Branch $branch)
    {
        $input = $request->validated();
        $branch->update($input);
        $branch->refresh();
        return response()->json(['message' => 'Datos actualizados correctamente', 'data' => $branch]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
