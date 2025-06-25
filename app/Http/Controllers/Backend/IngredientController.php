<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ingrediente;
use App\Models\Unidad;
use App\Models\IngredienteProducto;
use App\Models\Producto;
use Auth;
use Illuminate\Support\Carbon;
use DB;

class IngredientController extends Controller
{
  public function IngredientAll(){
    $ingredients = Ingrediente::orderBy('id', 'desc')->get();
    $units = Unidad::orderBy('id', 'desc')->get();
    return view('backend.ingredient.ingredient_all', compact('ingredients', 'units'));
  }

  public function IngredientStore(Request $request){
    $request->validate([
      'nombre' => 'required',
      'unidad_id' => 'required',
    ]);

    Ingrediente::insert([
      'nombre' => $request->nombre,
      'unidad_id' => $request->unidad_id,
      'created_at' => Carbon::now(),
      'updated_at' => null,
    ]);

    $ingredients = Ingrediente::with('unit')->latest()->get();

    return response()->json([
      'message' => 'Ingrediente registrado exitosamente',
      'alert_type' => 'success',
      'ingredients' => $ingredients
    ]);
  }

  public function IngredientEdit($id){
    $ingredient = Ingrediente::with('unit')->findOrFail($id);
    $units = Unidad::all();

    return response()->json([
      'ingredient' => $ingredient,
      'units' => $units
    ]);
  }

  public function IngredientUpdate(Request $request){
    $request->validate([
      'nombre' => 'required',
      'unidad_id' => 'required',
    ]);

    $ingredient_id = $request->ingredient_id;

    Ingrediente::findOrFail($ingredient_id)->update([
      'nombre' =>  $request->nombre,
      'unidad_id' =>  $request->unidad_id,
      'updated_at' => Carbon::now(),
    ]);

    $notification = array(
      'message' => 'Ingrediente actualizado exitosamente',
      'alert-type' => 'success'
    );

    return redirect()->route('ingredient.all')->with($notification);
  }

  public function IngredientDelete($id){
    $ingredient = Ingrediente::findOrFail($id);
    $ingredient->delete();

    $notification = array(
      'message' => 'Ingrediente eliminado exitosamente',
      'alert-type' => 'info'
    );
    return redirect()->back()->with($notification);
  }

  public function IngredientProductAll(){
    $products = Producto::with('ingredient_products.ingredient')->orderBy('id', 'desc')->get();
    return view('backend.ingredient.ingredient_product_all', compact('products'));
  }

  public function IngredientProductAdd(){
    $ingredients = Ingrediente::orderBy('nombre', 'asc')->get();
    $products = Producto::orderBy('nombre', 'asc')->get();
    return view('backend.ingredient.ingredient_product_add', compact('ingredients', 'products'));
  }

  public function IngredientProductStore(Request $request){

    if ($request->producto_id == null) {
      $notification = array(
        'message' => 'No ha añadido ningún producto',
        'alert-type' => 'info'
      );
      return redirect()->back()->with($notification);
    }
    else {
      DB::transaction(function() use($request){
        $count_ingredient = count($request->ingrediente_id);
        for ($i=0; $i < $count_ingredient ; $i++) {
          $ingredient_product = new IngredienteProducto();
          $ingredient_product->producto_id = $request->producto_id[$i];
          $ingredient_product->ingrediente_id = $request->ingrediente_id[$i];
          $ingredient_product->cantidad_requerida = $request->cantidad_requerida[$i];
          $ingredient_product->created_at = Carbon::now();
          $ingredient_product->updated_at = null;
          $ingredient_product->save();
        }
      });
    }

    $notification = array(
      'message' => 'Ingredientes añadidos al producto exitosamente',
      'alert-type' => 'success'
    );
    return redirect()->route('ingredient.product.all')->with($notification);
  }

  public function IngredientProductEdit($id){
    $product = Producto::with('ingredient_products.ingredient')->findOrFail($id);
    $products = Producto::orderBy('nombre', 'asc')->get();
    $all_ingredients = Ingrediente::orderBy('nombre', 'asc')->get();
    return view('backend.ingredient.ingredient_product_edit', compact('product', 'all_ingredients', 'products'));
  }

  public function IngredientProductUpdate(Request $request, $id){
    DB::transaction(function() use($request, $id){
      IngredienteProducto::where('producto_id', $id)->delete();

      if ($request->has('ingrediente_id') && count($request->ingrediente_id) > 0) {
        $count_ingredient = count($request->ingrediente_id);
        for ($i=0; $i < $count_ingredient ; $i++) {
          IngredienteProducto::create([
            'producto_id' => $id,
            'ingrediente_id' => $request->ingrediente_id[$i],
            'cantidad_requerida' => $request->cantidad_requerida[$i],
          ]);
        }
      }
    });

    $notification = array(
      'message' => 'Ingredientes del producto actualizados exitosamente',
      'alert-type' => 'success'
    );

    return redirect()->route('ingredient.product.all')->with($notification);
  }
}
