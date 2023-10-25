<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
        $viewData = [];
        $viewData["title"] = "Products - Online Store";
        $viewData["subtitle"] =  "List of products";
        $viewData["products"] = Product::all();
        return view('product.index')->with("viewData", $viewData);
    }

    public function show(Request $request, $id)
    {
        $viewData = [];
        $productsInCart = [];

        $productsInSession = $request->session()->get("products", []);
        foreach ($productsInSession as $item) {
            $productsInCart[] = $item['id'];
        }



        $product = Product::findOrFail($id);
        $viewData["title"] = $product->getName()." - Online Store";
        $viewData["subtitle"] = $product->getName()." - Product information";
        $viewData["product"] = $product;
        $viewData["cart"] = $productsInCart;
        return view('product.show')->with("viewData", $viewData);
    }
}
