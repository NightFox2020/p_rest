<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Support\Carbon;
use Auth;
use Image;

class ProductController extends Controller
{
  public function ProductAll(){
    $product = Producto::orderBy('id', 'desc')->get();
    return view('backend.product.product_all', compact('product'));
  }

  public function ProductAdd(){
    $category = Categoria::all();
    return view('backend.product.product_add',compact('category'));
  }

  public function ProductStore(Request $request){
    $request->validate([
      'categoria_id' => 'required',
      'nombre' => 'required',
      'precio_venta' => 'required',
      'imagen' => 'required',
      'cantidad' => 'required',
    ]);

    $image = $request->file('imagen');
    $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
    Image::make($image)->resize(300,300)->save('upload/product/'.$name_gen);
    $save_url = 'upload/product/'.$name_gen;

    Producto::insert([
      'categoria_id' => $request->categoria_id,
      'nombre' => $request->nombre,
      'precio_venta' => $request->precio_venta,
      'imagen' => $save_url,
      'cantidad' => $request->cantidad,
      'descripcion' => $request->descripcion,
      'created_at' => Carbon::now(),
      'updated_at' => null,
    ]);

    $notification = array(
      'message' => 'Producto registrado exitosamente',
      'alert-type' => 'success'
    );
    return redirect()->route('product.all')->with($notification);
  }

  public function ProductEdit($id){
    $category = Categoria::all();
    $product = Producto::findOrFail($id);
    return view('backend.product.product_edit',compact('product','category'));
  }

  public function ProductUpdate(Request $request){
    $request->validate([
      'categoria_id' => 'required',
      'nombre' => 'required',
      'precio_venta' => 'required',
      'cantidad' => 'required',
    ]);

    $product_id = $request->id;

    if ($request->file('imagen')) {
      $image = $request->file('imagen');
      $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
      Image::make($image)->resize(300,300)->save('upload/product/'.$name_gen);
      $save_url = 'upload/product/'.$name_gen;

      Producto::findOrFail($product_id)->update([
        'categoria_id' => $request->categoria_id,
        'nombre' => $request->nombre,
        'precio_venta' => $request->precio_venta,
        'imagen' => $save_url,
        'cantidad' => $request->cantidad,
        'descripcion' => $request->descripcion,
        'updated_at' => Carbon::now(),
      ]);

      $notification = array(
        'message' => 'Producto actualizado exitosamente',
        'alert-type' => 'success'
      );
      return redirect()->route('product.all')->with($notification);
    }

    else {
      Producto::findOrFail($product_id)->update([
        'categoria_id' => $request->categoria_id,
        'nombre' => $request->nombre,
        'precio_venta' => $request->precio_venta,
        'cantidad' => $request->cantidad,
        'descripcion' => $request->descripcion,
        'updated_at' => Carbon::now(),
      ]);

      $notification = array(
        'message' => 'Producto actualizado exitosamente',
        'alert-type' => 'success'
      );
      return redirect()->route('product.all')->with($notification);
    }
  }

  public function ProductDelete($id){
    $product = Producto::findOrFail($id);
    $product->delete();

    $notification = array(
      'message' => 'Producto eliminado exitosamente',
      'alert-type' => 'success'
    );
    return redirect()->back()->with($notification);
  }
}
