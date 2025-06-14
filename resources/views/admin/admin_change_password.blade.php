@extends('admin.admin_master')
@section('admin')

<div class="page-content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
          <h4 class="mb-sm-0 font-size-18">Cambiar Contraseña</h4>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <form method="POST" action="{{ route('update.password') }}" id="validatePassword">
              @csrf
              <div class="row justify-content-center">
                <div class="col-sm-4">
                  <div class="mb-3">
                    <label for="productname">Contraseña Actual</label>
                    <input name="oldpassword" type="password" class="form-control" id="current_password">
                    @error('oldpassword')
                    <span class="text-danger"> {{ $message }} </span>
                    @enderror
                  </div>

                  <div class="mb-3">
                    <label for="manufacturername">Nueva Contraseña</label>
                    <input name="newpassword" type="password" class="form-control" id="newpassword">
                    @error('newpassword')
                    <span class="text-danger"> {{ $message }} </span>
                    @enderror
                  </div>

                  <div class="mb-3">
                    <label for="manufacturername">Confirmar Nueva Contraseña</label>
                    <input name="confirm_password" type="password" class="form-control" id="confirm_password">
                    @error('confirm_password')
                    <span class="text-danger"> Se requiere Confirmar la Nueva Contraseña </span>
                    @enderror
                  </div>

                  <div id="mensajeAlerta" class="text-danger"></div><br>
                </div>
              </div>

              <div class="text-center">
                <button type="submit" class="btn btn-primary waves-effect waves-light">Cambiar Contraseña</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  document.getElementById('validatePassword').addEventListener('submit', function(event) {
    var password = document.getElementById('newpassword').value;
    var password_confirmation = document.getElementById('confirm_password').value;
    var mensajeAlerta = document.getElementById('mensajeAlerta');

    if(password !== password_confirmation) {
      mensajeAlerta.textContent = "La Confirmación de la Nueva Contraseña debe ser igual a la Nueva Contraseña";
      event.preventDefault();
    }
    else {
      mensajeAlerta.textContent = "";
    }
  });
</script>

@endsection
