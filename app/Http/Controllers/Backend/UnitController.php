<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Unidad;
use Auth;
use Illuminate\Support\Carbon;

class UnitController extends Controller
{
  public function UnitAll(){
    $units = Unidad::orderBy('id', 'desc')->get();
    return view('backend.unit.unit_all', compact('units'));
  }

  public function UnitStore(Request $request){
    $request->validate([
      'nombre' => 'required',
    ]);

    Unidad::insert([
      'nombre' => $request->nombre,
      'created_at' => Carbon::now(),
      'updated_at' => null,
    ]);

    $units = Unidad::latest()->get();

    return response()->json([
      'message' => 'Unidad registrada exitosamente',
      'alert_type' => 'success',
      'units' => $units
    ]);
  }

  public function UnitEdit($id){
    $unit = Unidad::findOrFail($id);
    return response()->json($unit);
  }

  public function UnitUpdate(Request $request){
    $request->validate([
      'nombre' => 'required',
    ]);

    $unit_id = $request->unit_id;

    Unidad::findOrFail($unit_id)->update([
      'nombre' =>  $request->nombre,
      'updated_at' => Carbon::now(),
    ]);

    $notification = array(
      'message' => 'Unidad actualizada exitosamente',
      'alert-type' => 'success'
    );

    return redirect()->back()->with($notification);
  }

  public function UnitDelete($id){
    $unit = Unidad::findOrFail($id);
    $unit->delete();

    $notification = array(
      'message' => 'Unidad eliminada exitosamente',
      'alert-type' => 'info'
    );
    return redirect()->back()->with($notification);
  }
}
