<?php

namespace App\Http\Controllers;

use App\Helpers\ImageHelper;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(10);
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create', [
            'product' => new Product,
        ]);
    }

    public function store(ProductRequest $request)
    {
        $lastId = Product::latest()->first()->id ?? 0;
        $image = ImageHelper::store($request->image, 'products');
        $slug = Str::slug($request->name) . '-' . ($lastId + 1);

        Product::create([
            'created_by' => auth()->user()->id,
            'name' => $request->name,
            'slug' => $slug,
            'image' => $image,
            'description' => $request->description,
            'price' => $request->price,
        ]);

        return redirect()->route('products.index');
    }

    public function show(Product $product)
    {
        //
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(ProductRequest $request, Product $product)
    {
        //
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return back();
    }
}
