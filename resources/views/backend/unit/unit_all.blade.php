@extends('admin.admin_master')
@section('admin')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<div class="page-content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
          <h4 class="mb-sm-0 font-size-18">Unidades de Medida</h4>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <div class="mb-3">
              <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target=".AddUnit">Registrar</a>
            </div>

            <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nombre</th>
                  <th>Acción</th>
                </tr>
              </thead>


              <tbody>
                @foreach($units as $key => $item)
                <tr>
                  <td>{{ $key+1 }}</td>
                  <td>{{ $item->nombre }}</td>
                  <td>
                    <button class="btn btn-sm btn-info" title="Editar" data-bs-toggle="modal" data-bs-target=".EditUnit" id="{{ $item->id }}" onclick="unitEdit(this.id)">
                      <i class="fas fa-edit font-size-15"></i>
                    </button>

                    <a href="{{ route('unit.delete',$item->id) }}" class="btn btn-sm btn-danger" title="Eliminar" id="delete">
                      <i class="fas fa-trash-alt font-size-15"></i>
                    </a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>

            <div class="modal fade AddUnit" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Registrar Unidad de Medida</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form method="post" action="{{ route('unit.store') }}" id="myForm" enctype="multipart/form-data">
                      @csrf
                      <div class="row justify-content-center">
                        <div class="col-md-12">
                          <div class="mb-3">
                            <label for="productname">Nombre</label>
                            <input name="nombre" type="text" class="form-control">
                            @error('nombre')
                            <span class="text-danger"> {{ $message }} </span>
                            @enderror
                          </div>
                        </div>

                        <div class="text-center">
                          <button type="submit" class="btn btn-primary waves-effect waves-light">Registrar</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>

            <div class="modal fade EditUnit" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Editar Unidad de Medida</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form method="post" action="{{ route('unit.update') }}" id="myFormEdit" enctype="multipart/form-data">
                      @csrf

                      <input type="hidden" name="unit_id" id="unit_id">

                      <div class="row justify-content-center">
                        <div class="col-md-12">
                          <div class="mb-3">
                            <label for="productname">Nombre</label>
                            <input name="nombre" type="text" class="form-control" id="cat_nombre">
                            @error('nombre')
                            <span class="text-danger"> {{ $message }} </span>
                            @enderror
                          </div>
                        </div>

                        <div class="text-center">
                          <button type="submit" class="btn btn-primary waves-effect waves-light">Actualizar</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function (){
    $("#myForm").validate({
      rules: {
        nombre: { required: true },
      },
      errorElement : 'span',
      errorPlacement: function (error, element) {
        error.addClass('invalid-feedback');
        element.closest('.mb-3').append(error);
      },
      highlight: function(element){
        $(element).addClass('is-invalid');
      },
      unhighlight: function(element){
        $(element).removeClass('is-invalid');
      },
      submitHandler: function(form) {
        registerCategories();
      }
    });

    function registerCategories() {
      $.ajax({
        url: "{{ route('unit.store') }}",
        type: "POST",
        data: $("#myForm").serialize(),
        success: function(response){
          toastr[response.alert_type](response.message, '', { positionClass: 'toast-bottom-right' });
          $(".AddUnit").modal('hide');
          $("#myForm")[0].reset();

          let tableBody = $("#datatable tbody");
          tableBody.empty();

          response.units.forEach((unit, index) => {
            tableBody.append(`
              <tr>
                <td>${index + 1}</td>
                <td>${unit.nombre}</td>
                <td>
                  <a class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target=".EditUnit" id="${unit.id}" onclick="unitEdit(this.id)" title="Editar">
                    <i class="fas fa-edit font-size-15"></i>
                  </a>
                  <a href="/unit/delete/${unit.id}" class="btn btn-sm btn-danger" id="delete" title="Eliminar">
                    <i class="fas fa-trash-alt font-size-15"></i>
                  </a>
                </td>
              </tr>
            `);
          });
        },
        error: function(xhr){
          toastr.error('Ocurrió un error al registrar el proveedor', '', { positionClass: 'toast-bottom-right' });
        }
      });
    }
  });
</script>

<script>
function unitEdit(id){
  $.ajax({
    type: 'GET',
    url: '/unit/edit/' + id,
    dataType: 'json',

    success:function(data){
      $('#unit_id').val(data.id);
      $('#cat_nombre').val(data.nombre);
    },
    error:function(xhr){
      console.error("Error al obtener los datos de la categoría:", xhr.responseText);
    }
  });
}
</script>

@endsection
