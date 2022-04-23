<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;


class ProductController extends Controller
{
    function show()
    {
        $products = Product::get()->toJson(JSON_PRETTY_PRINT);
        return response($products, 200);
    }

    function detail($id)
    {
        $product = Product::findOrFail($id);
        return response()->json($product, 200);
    }

    function register(Request $request)
    {
        $product = new Product;
        $product->title = $request->title;
        $product->price = number_format($request->price, 2);
        $product->quantity = $request->quantity;

        $product->save();

        return response()->json(["msg" => "Produto cadastrado com sucesso!", "data" => $product], 201);
    }

    function update(Request $request, $id){
        $product = $request->all();
        $product = Product::findOrFail($id)->update($product);

        return response()->json(["msg" => "Produto atualizado com sucesso!"], 200);
    }

    function destroy($id){
        Product::findOrFail($id)->delete();
        return response()->json(["msg"=> "Produto deletado com sucesso!"], 200);
    }

    function addImage(Request $request, $id)
    {
        $product = $request->all();
        $image = $request->file('urlImage')->store("", "google");
        $detailsImage = Storage::disk('google')->getMetadata($image);
        $product['urlImage'] = $detailsImage['path'];
        $product = Product::findOrFail($id)->update($product);

        return response()->json(["msg"=> "Imagem adicionada com sucesso!", "data" => $product], 200);
    }

}
