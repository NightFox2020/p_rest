@extends('admin.admin_master')
@section('admin')

<div class="page-content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
          <h4 class="mb-sm-0 font-size-18">Editar Perfil</h4>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <form method="POST" action="{{ route('store.profile', $editData->id) }}" id="myForm">
              @csrf
              <div class="row justify-content-center">
                <div class="col-sm-4">
                  <div class="mb-3">
                    <label for="productname">Nombre</label>
                    <input name="name" type="text" class="form-control" value="{{ $editData->name }}">
                  </div>

                  <div class="mb-3">
                    <label for="manufacturername">Correo</label>
                    <input name="email" type="email" class="form-control" value="{{ $editData->email }}">
                  </div>
                </div>
              </div>

              <div class="text-center">
                <button type="submit" class="btn btn-primary waves-effect waves-light">Guardar Cambios</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
$(document).ready(function (){
  $('#myForm').validate({
    errorElement : 'span',
    errorPlacement: function (error,element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight : function(element, errorClass, validClass){
      $(element).addClass('is-invalid');
    },
    unhighlight : function(element, errorClass, validClass){
      $(element).removeClass('is-invalid');
    },
  });
});
</script>

@endsection
