<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $product;
    protected $categorie;
    public function __construct()
    {
        $this->product = new Product();
        $this->categorie = new Categories();
    }
    public function index()
    {
        $products = $this->product::join('categories', 'products.category_id', '=', 'categories.id')->select('products.*', 'categories.name as category_name')->paginate(5);
        $categories = $this->categorie::all();
        return view('Front-office.index', compact('products', 'categories'));
    }
    public function search(Request $request)
    {

        $products = Product::where('name', 'like', '%' . $request->search_title . '%')->paginate(5);
        $categories = $this->categorie::all();
        return view('Front-office.index', compact('products', 'categories'));
    }
    public function filtre($id)
    {
        $products = Product::where('category_id', $id)->paginate(5);
      
        $categories = $this->categorie::all();
        
        return view('Front-office.index', compact('products', 'categories'));
    }
}