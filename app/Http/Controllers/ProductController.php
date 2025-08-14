<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        // "INI CODE PERTEMUAN PERTAMA"
        // $limit = request()->query('limit', 10);
        // $products = [
        //     (object) [
        //         "id" => 1,
        //         "name" => "Sapu",
        //         "description" => "Ini sapu murah",
        //         "price" => 10000,
        //     ],
        //     (object) [
        //         "id" => 2,
        //         "name" => "Kemonceng",
        //         "description" => "Ini kemonceng",
        //         "price" => 18000,
        //     ],
        // ];

        // if ($limit < 2) { // misalnya limit nya value nya 1
        //     return [
        //         (object) [
        //             "name" => "Sapu",
        //             "description" => "Ini sapu murah",
        //             "price" => 10000,
        //         ],
        //     ];
        // }

        $limit = request()->query('limit', 10);
        // $products = DB::table('products')->limit($limit)->get();
        $products = Product::limit($limit)->get();

        return $products;
    }

    public function show($productId)
    {
        // "INI CODE PERTEMUAN PERTAMA"
        // $products = [
        //     (object) [
        //         "id" => 1,
        //         "name" => "Sapu",
        //         "description" => "Ini sapu murah",
        //         "price" => 10000,
        //     ],
        //     (object) [
        //         "id" => 2,
        //         "name" => "Kemonceng",
        //         "description" => "Ini kemonceng",
        //         "price" => 18000,
        //     ],
        // ];

        // $filteredProducts = array_filter($products, function ($product) use ($productId) {
        //     return $product->id == $productId;
        // });

        // return $filteredProducts;

        // $product = DB::table('products')->where('id', $productId)->first();
        $product = Product::find($productId);

        if (!$product) {
            return ["message" => "Produk tidak ditemukan"];
        }

        return $product;
    }

    public function store(Request $request)
    {
        if (
            $request->input('name') == null
        ) {
            return "Nama produk harus diisi";
        }

        $product = [
            "name" => $request->input('name'),
            "description" => $request->input('description'),
            "stock" => (int) $request->input('stock'),
            "price" => $request->input('price'),
            "status" => $request->input('status', 'active'),
        ];

        // DB::table('products')->insert($product);
        Product::create($product);

        return $product;
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $product = [
            "name" => $request->input('name'),
            "description" => $request->input('description'),
            "stock" => $request->input('stock'),
            "price" => $request->input('price'),
            "status" => $request->input('status', 'active'),
        ];

        // $saved = DB::table('products')->where('id', $id)->update($product);

        // $product = DB::table('products')->where('id', $id)->first();

        $selectedProduct = Product::find($id);

        if (!$selectedProduct) {
            return ["error" => "Data produk tidak ditemukan"];
        }

        Product::find($id)->update($product);

        return ["message" => "Berhasil mengupdate produk dengan id " . $id];
    }

    public function destroy($id)
    {
        // $deleted = DB::table('products')->where('id', $id)->delete();

        // $product = DB::table('products')->where('id', $id)->first();

        $product = Product::find($id);

        if (!$product) {
            return ["error" => "Data produk tidak ditemukan"];
        }

        Product::find($id)->delete();

        return ["message" => "Berhasil menghapus produk dengan id " . $id];
    }
}
