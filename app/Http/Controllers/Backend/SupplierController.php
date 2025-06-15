<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Proveedor;
use Auth;
use Illuminate\Support\Carbon;

class SupplierController extends Controller
{
  public function SupplierAll(){
  $suppliers = Proveedor::orderBy('id', 'desc')->get();
  return view('backend.supplier.supplier_all', compact('suppliers'));
}

public function SupplierStore(Request $request){
  $request->validate([
    'nombre' => 'required',
    'celular' => 'required',
    'direccion' => 'required',
  ]);

  Proveedor::insert([
    'nombre' => $request->nombre,
    'celular' => $request->celular,
    'direccion' => $request->direccion,
    'created_at' => Carbon::now(),
    'updated_at' => null,
  ]);

  $suppliers = Proveedor::latest()->get();

  return response()->json([
    'message' => 'Proveedor registrado exitosamente',
    'alert_type' => 'success',
    'suppliers' => $suppliers
  ]);
}

public function SupplierEdit($id){
  $supplier = Proveedor::findOrFail($id);
  return response()->json($supplier);
}

public function SupplierUpdate(Request $request){
  $request->validate([
    'nombre' => 'required',
    'celular' => 'required',
    'direccion' => 'required',
  ]);

  $supplier_id = $request->supplier_id;

  Proveedor::findOrFail($supplier_id)->update([
    'nombre' => $request->nombre,
    'celular' => $request->celular,
    'direccion' => $request->direccion,
    'updated_at' => Carbon::now(),
  ]);

  $notification = array(
    'message' => 'Proveedor actualizado exitosamente',
    'alert-type' => 'success'
  );

  return redirect()->back()->with($notification);
}

public function SupplierDelete($id){
  $supplier = Proveedor::findOrFail($id);
  $supplier->delete();

  $notification = array(
    'message' => 'Proveedor eliminado exitosamente',
    'alert-type' => 'info'
  );
  return redirect()->back()->with($notification);
}
}
