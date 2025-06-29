<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Producto;

class IndexController extends Controller
{
  public function MenuCategory()
  {
    $categories = Categoria::orderBy('id', 'desc')->get();
    return view('frontend.category.category_view', compact('categories'));
  }

  public function MenuCategoryProducts(Request $request, $categoria_id)
  {
    $categoria = Categoria::findOrFail($categoria_id);
    $products = Producto::where('categoria_id', $categoria_id)->get();
    return view('frontend.products.products_view', compact('products', 'categoria'));
  }

  public function Carrito()
  {
    return view('frontend.cart.cart');
  }
  public function Detalle()
  {
    return view('frontend.invoice.invoice');
  }
}
