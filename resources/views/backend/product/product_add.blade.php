@extends('admin.admin_master')
@section('admin')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<div class="page-content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
          <h4 class="mb-sm-0 font-size-18">Registrar Producto</h4>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <form id="myForm" action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="row">
                <div class="col-md-4">
                  <div class="mb-3">
                    <label class="control-label">Categoría</label>
                    <select name="categoria_id" class="form-control select2">
                      <option value="" selected disabled>Seleccionar</option>
                      @foreach($category as $item)
                      <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="mb-3">
                    <label for="productname">Nombre</label>
                    <input name="nombre" type="text" class="form-control">
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="mb-3">
                    <label for="productname">Precio de Venta</label>
                    <input name="precio_venta" type="number" min="1" class="form-control">
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="mb-3">
                    <label for="productname">Cantidad</label>
                    <input name="cantidad" type="number" min="1" class="form-control">
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="mb-3">
                    <label for="productname">Descripcion</label>
                    <textarea class="form-control" name="descripcion" rows="1" cols="80"></textarea>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="mb-3">
                    <label for="productname">Imagen</label>
                    <input name="imagen" type="file" class="form-control" id="image">
                  </div>

                  <div class="mb-3">
                    <img id="showImage" src="{{ url('upload/no_image.jpg')}}" alt="Admin" width="170">
                  </div>
                </div>
              </div>

              <div class="text-center">
                <button type="submit" class="btn btn-primary waves-effect waves-light">Registrar</button>
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
      rules: {
        categoria_id: {
          required : true,
        },
        nombre: {
          required : true,
        },
        precio_venta: {
          required : true,
        },
        imagen: {
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

<script type="text/javascript">
  $(document).ready(function(){
    $('#image').change(function(e){
      var reader = new FileReader();
      reader.onload = function(e){
        $('#showImage').attr('src',e.target.result);
      }
      reader.readAsDataURL(e.target.files['0']);
    });
  });
</script>

@endsection
