<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    protected $product;
    protected $category;
    public function __construct()
    {
        $this->product = new Product();
        $this->category = new Categories();
    }
    public function index_product()
    {
        $product = $this->product::join('categories', 'products.category_id', '=', 'categories.id')
            ->select('products.*', 'categories.name as category_name')->get();
        $all_product = $product;
        $all_categories = $this->category::all();
        return view('Back-office.Products', compact('all_product', 'all_categories'));
    }
    public function new_product(Request $request)
    {

        $request->validate([
            'image' => 'required|image|mimes:png,jpg,jpeg',
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'category' => 'required'
        ]);
        $product = $this->product;
        $img = $request->file('image');
        $image_name = $img->getClientOriginalName();
        $image = uniqid() . $image_name;
        $img->move('Uploads/', $image);
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->image = $image;
        $product->category_id = $request->category;
        $product->save();
        return redirect()->back();
    }
    public function update_product(Request $request)
    {

        $product = $this->product::findOrfail($request->id);
        if ($request->hasFile("image")) {
            $oldImage = public_path('Uploads/' . $product->image);
            if (file_exists($oldImage)) {
                unlink($oldImage);
            }
            $request->validate([
                'image' => 'image|mimes:png,jpg,jpeg',
                'name' => 'required',
                'description' => 'required',
                'price' => 'required',
                'category' => 'required'
            ]);
            $img = $request->file('image');
            $image_name = $img->getClientOriginalName();
            $image = uniqid() . $image_name;
            $img->move('Uploads/', $image);
            $product->name = $request->name;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->image = $image;
            $product->category_id = $request->category;
            $product->update();
        }
        else
        {
            $product = $this->product::findOrfail($request->id);
            $request->validate([
                'name' => 'required',
                'description' => 'required',
                'price' => 'required',
                'category' => 'required'
            ]);
            $product->name = $request->name;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->category_id = $request->category;
            $product->update();
        }
        return redirect()->back();
    }
    public function delete_product(Request $request)
    {
        $product = $this->product::findOrfail($request->id);
        $product->delete();
        return redirect()->back();
    }
}
