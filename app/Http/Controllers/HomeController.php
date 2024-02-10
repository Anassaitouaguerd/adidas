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
        $products = $this->product::join('categories', 'products.category_id','=','categories.id')->select('products.*' , 'categories.name as category_name')->get();
        $categories = $this->categorie::all();
        return view('Front-office.index',compact('products','categories'));
    }
}
