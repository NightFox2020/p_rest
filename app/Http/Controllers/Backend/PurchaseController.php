<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Proveedor;
use App\Models\Ingrediente;
use App\Models\Compra;
use App\Models\DetalleCompra;
use Auth;
use Illuminate\Support\Carbon;
use DB;

class PurchaseController extends Controller
{
  public function PurchaseAll(Request $request){
    $allData = Compra::orderBy('id', 'desc')->get();
    return view('backend.purchase.purchase_all', compact('allData'));
  }

  public function PurchaseAdd(){
    $suppliers = Proveedor::orderBy('nombre', 'asc')->get();
    $ingredients = Ingrediente::with('unit')->latest()->get();
    $purchase_no = 'DI-C'.mt_rand(1000000000, 9999999999);
    return view('backend.purchase.purchase_add',compact('ingredients', 'suppliers', 'purchase_no'));
  }

  public function PurchaseStore(Request $request){
    if ($request->ingrediente_id == null) {
      $notification = array(
        'message' => 'No ha añadido ningún ingrediente',
        'alert-type' => 'info'
      );
      return redirect()->back()->with($notification);
    }
    else {
      $purchase = new Compra();
      $purchase->proveedor_id = $request->proveedor_id;
      $purchase->numero_compra = $request->purchase_no;
      $purchase->total = $request->total;
      $purchase->estado = '0';
      $purchase->usuario_id = Auth::user()->id;
      $purchase->created_at = Carbon::now();
      $purchase->updated_at = null;

      DB::transaction(function() use($request, $purchase){
        if ($purchase->save()) {
          $count_ingredient = count($request->ingrediente_id);
          for ($i=0; $i < $count_ingredient ; $i++) {
            $purchase_details = new DetalleCompra();
            $purchase_details->compra_id = $purchase->id;
            $purchase_details->ingrediente_id = $request->ingrediente_id[$i];
            $purchase_details->cantidad_comprada = $request->cantidad_comprada[$i];
            $purchase_details->precio_unitario = $request->precio_unitario[$i];
            $purchase_details->subtotal = $request->subtotal[$i];
            $purchase_details->created_at = Carbon::now();
            $purchase_details->updated_at = null;
            $purchase_details->save();
          }
        }
      });
    }

    $notification = array(
      'message' => 'Compra realizada exitosamente',
      'alert-type' => 'success'
    );
    return redirect()->route('purchase.all')->with($notification);
  }

  public function PurchaseDelete($id){
    $purchase = Compra::findOrFail($id);
    DetalleCompra::where('compra_id', $purchase->id)->delete();
    $purchase->delete();

    $notification = array(
      'message' => 'Compra pendiente eliminada exitosamente',
      'alert-type' => 'success'
    );
    return redirect()->back()->with($notification);
  }

  public function PurchasePendingDetails($id){
    $purchase = Compra::with('purchase_details')->findOrFail($id);
    return view('backend.purchase.purchase_pending_details', compact('purchase'));
  }

  public function PurchaseApprove(Request $request, $id){
    $purchase = Compra::findOrFail($id);
    $purchase->usuario_id = Auth::user()->id;
    $purchase->estado = '1';

    DB::transaction(function() use($request, $purchase, $id){
      foreach ($request->buying_qty as $key => $val) {
        $purchase_details = DetalleCompra::where('id', $key)->first();
        $purchase_details->save();

        $ingredient = Ingrediente::where('id', $purchase_details->ingrediente_id)->first();
        $ingredient->cantidad = ((float)$ingredient->cantidad) + ((float)$request->buying_qty[$key]);
        $ingredient->save();
      }
      $purchase->save();
    });

    $notification = array(
      'message' => 'Compra aprobada exitosamente',
      'alert-type' => 'success'
    );

    return redirect()->route('purchase.all')->with($notification);
  }

  public function PrintPurchase($id){
    $purchase = Compra::with('purchase_details')->findOrFail($id);
    return view('backend.purchase.purchase_pdf', compact('purchase'));
  }
}
