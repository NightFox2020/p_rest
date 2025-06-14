@extends('admin.admin_master')
@section('admin')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<div class="page-content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
          <h4 class="mb-sm-0 font-size-18">Productos</h4>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <div class="mb-3">
              <a href="{{ route('product.add') }}" class="btn btn-primary">Registrar</a>
            </div>

            <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Imagen</th>
                  <th>Nombre</th>
                  <th>Categoría</th>
                  <th>Precio</th>
                  <th>Cantidad</th>
                  <th>Acción</th>
                </tr>
              </thead>


              <tbody>
                @foreach($product as $key => $item)
                <tr style="vertical-align:middle;">
                  <td>{{ $key+1 }}</td>
                  <td><img src="{{ asset($item->imagen) }}" style="width:50px; height:50px;"></td>
                  <td>{{ $item->nombre }}</td>
                  <td>{{ $item['category']['nombre'] }}</td>
                  <td>Bs{{ $item->precio_venta }}</td>
                  <td>{{ $item->cantidad }}</td>
                  <td>
                    <a href="{{ route('product.edit', $item->id) }}" class="btn btn-sm btn-info" title="Editar">
                      <i class="fas fa-edit font-size-15"></i>
                    </a>

                    <a href="{{ route('product.delete',$item->id) }}" class="btn btn-sm btn-danger" title="Eliminar" id="delete">
                      <i class="fas fa-trash-alt font-size-15"></i>
                    </a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
