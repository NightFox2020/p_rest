<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
  public function destroy(Request $request){
    Auth::guard('web')->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/login');
  }

  public function EditProfile(){
    $id = Auth::user()->id;
    $editData = User::find($id);
    return View('admin.admin_profile_edit', compact('editData'));
  }

  public function StoreProfile($id, Request $request){
    request()->validate([
      'email' => 'required|email|unique:users,email,'.$id,
    ],[
      'email.required' => 'Ya existe este Correo',
    ]);

    $id = Auth::user()->id;
    $data =  User::find($id);

    $data->name = $request->name;
    $data->email = $request->email;
    $data->save();

    $notification = array(
      'message' => 'Perfil actualizado exitosamente',
      'alert-type' => 'success'
    );

    return redirect()->back()->with($notification);
  }

  public function ChangePassword(){
    return View('admin.admin_change_password');
  }

  public function UpdatePassword(Request $request){
    $validateData = $request->validate([
      'oldpassword' => 'required',
      'newpassword' => 'required',
      'confirm_password' => 'required|same:newpassword',
    ],[
      'oldpassword.required' => 'Se requiere la Contraseña Actual',
      'newpassword.required' => 'Se requiere la Nueva Contraseña'
    ]);

    if (!Hash::check($request->oldpassword, auth::user()->password)) {
      $notification = array(
        'message' => 'La Contraseña Actual no coincide',
        'alert-type' => 'error'
      );
      return back()->with($notification);
    }

    User::whereId(auth()->user()->id)->update([
      'password' => Hash::make($request->newpassword)
    ]);

    $notification = array(
      'message' => 'Se ha cambiado la Contraseña exitosamente',
      'alert-type' => 'success'
    );
    return back()->with($notification);
  }
}
