<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
   protected $category;
   public function __construct() {
      $this->category = new Categories();
   }
   public function index_category()
   {
      $all_categories = $this->category::all(); 
    return view('Categories' , compact('all_categories'));
   }
   public function new_category(Request $request)
   {
      $this->category->name = $request->name;
      $this->category->save();
      return redirect('/categories');
   }
   public function update_category(Request $request)
   {
      $find_category = $this->category::findOrfail($request->id);
      $find_category->name = $request->name;
      $find_category->save();
      return redirect('/categories');
   }
   public function delete_category(Request $request)
   {
      $find_category = $this->category::findOrfail($request->id);
      $find_category->delete();
      return redirect('/categories');
   }
}
