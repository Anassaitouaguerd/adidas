<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
   protected $category;
   public function __construct()
   {
      $this->category = new Categories();
   }
   public function index_category()
   {
      $all_categories = $this->category::all();
      return view('Back-office.Categories', compact('all_categories'));
   }
   public function new_category(Request $request)
   {

      $request->validate([
         'image' => 'required|image|mimes:png,jpg,jpeg',
         'name' => 'required',
      ]);
      $img = $request->file('image');
      $image_name = $img->getClientOriginalName();
      $image = uniqid() . $image_name;
      $img->move('Uploads/', $image);
      $this->category->name = $request->name;
      $this->category->image = $image;
      $this->category->save();
      return redirect('/admin/categories');
   }
   public function update_category(Request $request)
   {
      $find_category = $this->category::findOrfail($request->id);
      if ($request->hasFile("image")) {
         $oldImage = public_path('Uploads/' . $find_category->image);
         if (file_exists($oldImage)) {
            unlink($oldImage);
         }
         $request->validate([
               'image' => 'required|image|mimes:png,jpg,jpeg',
               'name' => 'required',
            ]);
         $img = $request->file('image');
         $image_name = $img->getClientOriginalName();
         $image = uniqid() . $image_name;
         $img->move('Uploads/', $image);
         $find_category->image = $image;
         $find_category->name = $request->name;
         $find_category->save();
      } else {
         $request->validate([
               'name' => 'required',
            ]);
         $find_category->name = $request->name;
         $find_category->save();
      }
      return redirect('/admin/categories');
   }
   public function delete_category(Request $request)
   {
      $find_category = $this->category::findOrfail($request->id);
      $find_category->delete();
      return redirect('/admin/categories');
   }
}
