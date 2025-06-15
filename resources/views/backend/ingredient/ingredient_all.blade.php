@extends('admin.admin_master')
@section('admin')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<div class="page-content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
          <h4 class="mb-sm-0 font-size-18">Ingredientes</h4>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <div class="mb-3">
              <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target=".AddIngr">Registrar</a>
              <a href="{{ route('ingredient.product.add') }}" class="btn btn-primary">Añadir a Producto</a>
            </div>

            <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nombre</th>
                  <th>Unidad</th>
                  <th>Acción</th>
                </tr>
              </thead>


              <tbody>
                @foreach($ingredients as $key => $item)
                <tr>
                  <td>{{ $key+1 }}</td>
                  <td>{{ $item->nombre }}</td>
                  <td>{{ $item->unidad }}</td>
                  <td>
                    <button class="btn btn-sm btn-info" title="Editar" data-bs-toggle="modal" data-bs-target=".EditIngr" id="{{ $item->id }}" onclick="ingrEdit(this.id)">
                      <i class="fas fa-edit font-size-15"></i>
                    </button>

                    <a href="{{ route('ingredient.delete',$item->id) }}" class="btn btn-sm btn-danger" title="Eliminar" id="delete">
                      <i class="fas fa-trash-alt font-size-15"></i>
                    </a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>

            <div class="modal fade AddIngr" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Registrar Ingrediente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form method="post" action="{{ route('ingredient.store') }}" id="myForm" enctype="multipart/form-data">
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

                          <div class="mb-3">
                            <label class="control-label">Unidad de Medida</label>
                            <select name="unidad" class="form-select" required>
                              <option disabled selected value="">Seleccionar</option>
                              <option value="Gramo (g)">Gramo (g)</option>
                              <option value="Kilogramo (kg)">Kilogramo (kg)</option>
                              <option value="Mililitro (ml)">Mililitro (ml)</option>
                              <option value="Litro (L)">Litro (L)</option>
                              <option value="Unidad (u)">Unidad (u)</option>
                            </select>
                            @error('unidad')
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

            <div class="modal fade EditIngr" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Editar Ingrediente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form method="post" action="{{ route('ingredient.update') }}" id="myFormEdit" enctype="multipart/form-data">
                      @csrf

                      <input type="hidden" name="ingredient_id" id="ingredient_id">

                      <div class="row justify-content-center">
                        <div class="col-md-12">
                          <div class="mb-3">
                            <label for="productname">Nombre</label>
                            <input name="nombre" type="text" class="form-control" id="ingredient_nombre">
                            @error('nombre')
                            <span class="text-danger"> {{ $message }} </span>
                            @enderror
                          </div>

                          <div class="mb-3">
                            <label class="control-label">Unidad de Medida</label>
                            <select name="unidad" class="form-select" required id="ingredient_unidad">
                              <option disabled selected value="">Seleccionar</option>
                            </select>
                            @error('unidad')
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
        unidad: { required: true },
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
        registerIngredients();
      }
    });

    function registerIngredients() {
      $.ajax({
        url: "{{ route('ingredient.store') }}",
        type: "POST",
        data: $("#myForm").serialize(),
        success: function(response){
          toastr[response.alert_type](response.message, '', { positionClass: 'toast-bottom-right' });
          $(".AddIngr").modal('hide');
          $("#myForm")[0].reset();

          let tableBody = $("#datatable tbody");
          tableBody.empty();

          response.ingredients.forEach((ingredient, index) => {
            tableBody.append(`
              <tr>
                <td>${index + 1}</td>
                <td>${ingredient.nombre}</td>
                <td>${ingredient.unidad}</td>
                <td>
                  <a class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target=".EditIngr" id="${ingredient.id}" onclick="ingrEdit(this.id)" title="Editar">
                    <i class="fas fa-edit font-size-15"></i>
                  </a>
                  <a href="/ingredient/delete/${ingredient.id}" class="btn btn-sm btn-danger" id="delete" title="Eliminar">
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
function ingrEdit(id){
  $.ajax({
    type: 'GET',
    url: '/ingredient/edit/' + id,
    dataType: 'json',

    success: function(response){
      $('#ingredient_id').val(response.id);
      $('#ingredient_nombre').val(response.nombre);

      let select = $("#ingredient_unidad");
      select.empty();
      const unidades = ["Gramo (g)", "Kilogramo (kg)", "Mililitro (ml)", "Litro (L)", "Unidad (u)"];
      select.append('<option disabled value="">Seleccionar</option>');
      unidades.forEach(unidad => {
        select.append(`<option value="${unidad}" ${response.unidad == unidad ? 'selected' : ''}>${unidad}</option>`);
      });
    },
    error:function(xhr){
      console.error("Error al obtener los datos del ingrediente:", xhr.responseText);
    }
  });
}
</script>

@endsection
