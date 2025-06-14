<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categoria;
use Auth;
use Illuminate\Support\Carbon;
use Image;

class CategoryController extends Controller
{
  public function CategoryAll(){
    $categories = Categoria::orderBy('id', 'desc')->get();
    return view('backend.category.category_all', compact('categories'));
  }

  public function CategoryAdd(){
    return view('backend.category.category_add');
  }

  public function CategoryStore(Request $request){
    $request->validate([
      'nombre' => 'required',
      'imagen' => 'required',
    ]);

    $image = $request->file('imagen');
    $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
    Image::make($image)->resize(300,300)->save('upload/category/'.$name_gen);
    $save_url = 'upload/category/'.$name_gen;

    Categoria::insert([
      'nombre' => $request->nombre,
      'imagen' => $save_url,
      'created_at' => Carbon::now(),
      'updated_at' => null,
    ]);

    $notification = array(
      'message' => 'Categoría registrada exitosamente',
      'alert-type' => 'success'
    );

    return redirect()->route('category.all')->with($notification);
  }

  public function CategoryEdit($id){
    $category = Categoria::findOrFail($id);
    return view('backend.category.category_edit', compact('category'));
  }

  public function CategoryUpdate(Request $request){
    $request->validate([
      'nombre' => 'required',
    ]);

    $category_id = $request->category_id;

    Categoria::findOrFail($category_id)->update([
      'nombre' =>  $request->nombre,
      'updated_at' => Carbon::now(),
    ]);

    $notification = array(
      'message' => 'Categoría actualizada exitosamente',
      'alert-type' => 'success'
    );

    return redirect()->route('category.all')->with($notification);
  }

  public function CategoryDelete($id){
    $category = Categoria::findOrFail($id);
    $category->delete();

    $notification = array(
      'message' => 'Categoría eliminada exitosamente',
      'alert-type' => 'info'
    );
    return redirect()->back()->with($notification);
  }
}
