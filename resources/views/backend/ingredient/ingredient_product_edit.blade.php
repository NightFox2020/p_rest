@extends('admin.admin_master')
@section('admin')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<div class="page-content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
          <h4 class="mb-sm-0 font-size-18">Actualizar Ingredientes del Producto</h4>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-9">
        <div class="card">
          <div class="card-body">
            <div class="">
              <form id="myForm" action="{{ isset($product) ? route('ingredient.product.update', $product->id) : route('ingredient.product.store') }}" method="post">
                @csrf

                @if(isset($product))
                @method('POST')
                @endif

                <table class="table-sm table-bordered" width="100%" style="border-color: #CED4DA;">
                  <thead>
                    <tr>
                      <th>Ingrediente / Unidad</th>
                      <th>Cantidad Requerida</th>
                      <th>Acción</th>
                    </tr>
                  </thead>

                  <tbody id="addRow" class="addRow">
                    @if(isset($product))
                    @foreach($product->ingredient_products as $ingr_prod)
                    <tr class="delete_add_more_item" id="delete_add_more_item">
                      <input type="hidden" name="ingrediente_id[]" value="{{ $ingr_prod->ingrediente_id }}">

                      <td>
                        {{ $ingr_prod->ingredient->nombre }} - {{ $ingr_prod->ingredient->unidad }}
                      </td>

                      <td>
                        <input type="number" min="1" class="form-control cantidad_requerida text-right" name="cantidad_requerida[]" value="{{ $ingr_prod->cantidad_requerida }}" required>
                      </td>

                      <td>
                        <i class="fas fa-trash-alt text-danger removeeventmore" style="font-size:15pt;"></i>
                      </td>
                    </tr>
                    @endforeach
                    @endif
                  </tbody>
                </table><br>

                <div class="mb-3">
                  <div class="col-sm-12 text-center">
                    <button type="submit" class="btn btn-primary col-sm-3">
                      Actualizar
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <div class="col-3">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <div class="mb-3">
                  <label class="control-label">Productos</label>
                  <select name="producto_id" class="form-control select2" id="producto_id" {{ isset($product) ? 'disabled' : '' }}>
                    <option value="" selected disabled>Seleccionar</option>
                    @foreach($products as $item)
                    <option value="{{ $item->id }}" {{ isset($product) && $product->id == $item->id ? 'selected' : '' }}>
                      {{ $item->nombre }}
                    </option>
                    @endforeach
                  </select>
                  @if(isset($product))
                  <input type="hidden" name="producto_id" value="{{ $product->id }}">
                  @endif
                </div>
              </div>

              <div class="col-md-12">
                <div class="mb-3">
                  <label class="control-label">Ingredientes</label>
                  <select class="form-select select2" id="ingrediente_id">
                    <option value="" selected disabled>Seleccionar</option>
                    @foreach($all_ingredients as $item)
                    <option value="{{ $item->id }}">{{ $item->nombre }} - {{ $item->unidad }}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="col-md-12">
                <div class="mb-3">
                  <a class="btn btn-info btn-rounded addeventmore">
                    <i class="fas fa-plus-circle"></i>
                    Añadir
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script id="document-template" type="text/x-handlebars-template">
  <tr class="delete_add_more_item" id="delete_add_more_item">
    <input type="hidden" name="ingrediente_id[]" value="@{{ingrediente_id}}">

    <td>
      @{{ingrediente_nombre}}
    </td>

    <td>
      <input type="number" min="1" class="form-control cantidad_requerida text-right" name="cantidad_requerida[]" value="1" required>
    </td>

    <td>
      <i class="fas fa-trash-alt text-danger removeeventmore" style="font-size:15pt;"></i>
    </td>
  </tr>
</script>

<script type="text/javascript">
$(document).ready(function(){
    $(document).on("click",".addeventmore", function(){
      var producto_id = $('#producto_id').val();
      var ingrediente_id = $('#ingrediente_id').val();
      var ingrediente_nombre = $('#ingrediente_id').find('option:selected').text();

      if(!producto_id) {
        $.notify("Se requiere Producto" ,  {globalPosition: 'top right', className:'error' });
        return false;
      }

      if(!ingrediente_id) {
        $.notify("Se requiere Ingrediente" ,  {globalPosition: 'top right', className:'error' });
        return false;
      }

      var source = $("#document-template").html();
      var tamplate = Handlebars.compile(source);
      var data = {
        producto_id:producto_id,
        ingrediente_id:ingrediente_id,
        ingrediente_nombre:ingrediente_nombre,
      };
      var html = tamplate(data);
      $("#addRow").append(html);
    });

    $(document).on("click",".removeeventmore",function(event){
      $(this).closest(".delete_add_more_item").remove();
    });
  });
</script>

<script type="text/javascript">
$(document).ready(function (){
  $('#myForm').validate({
    rules: {
      producto_id: {
        required : true,
      },
      ingrediente_id: {
        required : true,
      },
    },
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

<style>
.select2-container.select2-deshabilitado .select2-selection--single {
  background-color: #eee;
  cursor: not-allowed;
}
</style>

<script type="text/javascript">
$(document).ready(function() {
  $('#producto_id').select2({
    placeholder: "Seleccionar un producto"
  });

  @if(isset($product))
  $('#producto_id').next('.select2-container').addClass('select2-deshabilitado');
  @endif

  @if(!isset($product))
  $('#producto_id').on('select2:select', function (e) {
    $(this).prop('disabled', true).trigger('change');
    $(this).next('.select2-container').addClass('select2-deshabilitado');
  });
  @endif
});
</script>

@endsection
