@extends('admin.admin_master')
@section('admin')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<div class="page-content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
          <h4 class="mb-sm-0 font-size-18">Registrar Compra</h4>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-9">
        <div class="card">
          <div class="card-body">
            <div class="">
              <form id="myForm" action="{{ route('purchase.store') }}" method="post">
                @csrf

                <table class="table-sm table-bordered" width="100%" style="border-color: #CED4DA;">
                  <thead>
                    <tr>
                      <th>Ingrediente</th>
                      <th>Cantidad</th>
                      <th>Precio Bs.</th>
                      <th>Subtotal Bs.</th>
                      <th>Acción</th>
                    </tr>
                  </thead>

                  <tbody id="addRow" class="addRow">
                  </tbody>

                  <tbody>
                    <tr>
                      <td colspan="3" class="text-end">Total</td>
                      <td>
                        <input type="text" name="total" value="0" id="estimated_amount" class="form-control estimated_amount" readonly style="background-color: #ddd;" >
                      </td>
                      <td></td>
                    </tr>
                  </tbody>
                </table><br>

                <div class="mb-3">
                  <div class="col-sm-12 text-center">
                    <button type="submit" class="btn btn-primary col-sm-3">
                      Registrar
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
              <input name="purchase_no" type="hidden" value="{{$purchase_no}}" readonly id="purchase_no">

              <div class="col-md-12">
                <div class="mb-3">
                  <label class="control-label">Proveedor</label>
                  <select name="proveedor_id" class="form-select select2" id="proveedor_id">
                    <option value=" " selected disabled>Seleccionar</option>
                    @foreach($suppliers as $item)
                    <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="col-md-12">
                <div class="mb-3">
                  <label class="control-label">Ingrediente</label>
                  <select name="proveedor_id" class="form-select select2" id="ingrediente_id">
                    <option value=" " selected disabled>Seleccionar</option>
                    @foreach($ingredients as $item)
                    <option value="{{ $item->id }}">{{ $item->nombre }} - {{ $item['unit']['nombre'] }}</option>
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
    <input type="hidden" name="purchase_no" value="@{{purchase_no}}">
    <input type="hidden" name="proveedor_id" value="@{{proveedor_id}}">
    <input type="hidden" name="ingrediente_id[]" value="@{{ingrediente_id}}">

    <td>
      @{{ingrediente_nombre}}
    </td>

    <td>
      <input type="number" min="1" class="form-control cantidad_comprada text-right" name="cantidad_comprada[]" value="1" required>
    </td>

    <td>
      <input type="number" class="form-control precio_unitario text-right" name="precio_unitario[]" step="0.01" min="1" placeholder="0.00" required>
    </td>

    <td>
      <input type="number" class="form-control subtotal text-right" name="subtotal[]" value="0" readonly>
    </td>

    <td>
      <i class="fas fa-trash-alt text-danger removeeventmore" style="font-size:15pt;"></i>
    </td>
  </tr>
</script>

<script type="text/javascript">
$(document).ready(function(){
    $(document).on("click",".addeventmore", function(){
      var purchase_no = $('#purchase_no').val();
      var proveedor_id = $('#proveedor_id').val();
      var ingrediente_id = $('#ingrediente_id').val();
      var ingrediente_nombre = $('#ingrediente_id').find('option:selected').text();

      if(!proveedor_id) {
        $.notify("Se requiere Proveedor" ,  {globalPosition: 'top right', className:'error' });
        return false;
      }

      if(!ingrediente_id) {
        $.notify("Se requiere Ingrediente" ,  {globalPosition: 'top right', className:'error' });
        return false;
      }

      var source = $("#document-template").html();
      var tamplate = Handlebars.compile(source);
      var data = {
        purchase_no:purchase_no,
        proveedor_id:proveedor_id,
        ingrediente_id:ingrediente_id,
        ingrediente_nombre:ingrediente_nombre,
      };
      var html = tamplate(data);
      $("#addRow").append(html);
    });

    $(document).on("click",".removeeventmore",function(event){
      $(this).closest(".delete_add_more_item").remove();
      totalAmountPrice();
    });

    $(document).on('keyup click','.precio_unitario,.cantidad_comprada', function(){
      var precio_unitario = $(this).closest("tr").find("input.precio_unitario").val();
      var qty = $(this).closest("tr").find("input.cantidad_comprada").val();
      var total = precio_unitario * qty;
      $(this).closest("tr").find("input.subtotal").val(total);
      totalAmountPrice();
    });

    function totalAmountPrice(){
      var sum = 0;
      $(".subtotal").each(function(){
        var value = $(this).val();
        if(!isNaN(value) && value.length != 0){
          sum += parseFloat(value);
        }
      });
      $('#estimated_amount').val(sum);
    }
  });
</script>

<script type="text/javascript">
$(document).ready(function (){
  $('#myForm').validate({
    rules: {
      proveedor_id: {
        required : true,
      },
      ingrediente_id: {
        required : true,
      },
      cantidad_comprada: {
        required : true,
      },
      precio_unitario: {
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
  $('#proveedor_id').select2({
    placeholder: "Seleccionar un producto"
  });

  $('#proveedor_id').on('select2:select', function (e) {
    $(this).prop('disabled', true).trigger('change');
    $(this).next('.select2-container').addClass('select2-deshabilitado');
  });
});
</script>

@endsection
