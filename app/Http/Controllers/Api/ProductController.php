<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CreateProductRequest;
use App\Http\Requests\Api\IndexProductRequest;
use App\Http\Requests\Api\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexProductRequest $request)
    {
        $input = $request->validated();
        $rows = Product::search($input);

        return response()->json(['message' => 'Datos obtenidos por json', 'data' => $rows]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleted(IndexProductRequest $request)
    {
        $input = $request->validated();
        $rows = Product::search($input, true);

        return response()->json(['message' => 'Los siguientes registros han sido eliminado lógicamente', 'data' => $rows]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProductRequest $request)
    {
        $input = $request->validated();
        $product = Product::create($input);

        return response()->json(['message' => 'Datos obtenidos por json', 'data' => $product]);
    }

    /**
     * Display the specified resource.
     *
     * @param  Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return response()->json(['message' => 'Datos obtenidos', 'data' => $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateProductRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $input = $request->validated();
        $product->update($input);
        $product->refresh();
        return response()->json(['message' => 'Datos actualizados correctamente', 'data' => $product]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product -> delete();
        return response()->json(['message' => 'Producto eliminado, ID '. $product->id], 202);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function forceDestroy(Product $product)
    {
        $product -> forceDelete();
        return response()->json(['message' => 'Producto eliminado, ID '. $product->id], 202);
    }

    public function deleteByFilters(IndexProductRequest $request, $deleteType)
    {

        //0: borrado lógico   1: borrado físico

        if(in_array($deleteType, [0,1])){
            $input = $request->validated();
            $response = Product::destroyByFilters($input, $deleteType);

            if(!$response){
                return response()->json(['messaje'=>'Error al eliminar'], 422);
            }

            return response()->json(['message' => 'Datos eliminados'], 200);
        }

        return response()->json(['messaje'=>'Error en parámetros de entrada'], 422);
    }
}
