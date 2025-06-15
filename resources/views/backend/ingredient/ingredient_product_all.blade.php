@extends('admin.admin_master')
@section('admin')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<div class="page-content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
          <h4 class="mb-sm-0 font-size-18">Ingredientes de Productos</h4>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <div class="mb-3">
              <a href="{{ route('ingredient.product.add') }}" class="btn btn-primary">Añadir a Producto</a>
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
                @foreach($products as $key => $item)
                <tr style="vertical-align:middle;">
                  <td>{{ $key+1 }}</td>
                  <td><img src="{{ asset($item->imagen) }}" style="width:50px; height:50px;"></td>
                  <td>{{ $item->nombre }}</td>
                  <td>{{ $item['category']['nombre'] }}</td>
                  <td>Bs{{ $item->precio_venta }}</td>
                  <td>{{ $item->cantidad }}</td>
                  <td>
                    <a class="btn btn-sm btn-success" title="Ingredientes del Producto" data-bs-toggle="modal" data-bs-target=".IngrProDet{{ $key+1 }}">
                      <i class="fas fa-book-open font-size-15"></i>
                    </a>

                    <a href="{{ route('ingredient.product.edit', $item->id) }}" class="btn btn-sm btn-info" title="Editar">
                      <i class="fas fa-edit font-size-15"></i>
                    </a>

                    <a href="{{ route('ingredient.product.delete',$item->id) }}" class="btn btn-sm btn-danger" title="Eliminar" id="delete">
                      <i class="fas fa-trash-alt font-size-15"></i>
                    </a>
                  </td>
                </tr>

                <div class="modal fade IngrProDet{{ $key+1 }}" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Ingredientes del Producto <span class="badge bg-success font-size-15">{{ $item->nombre }}</span> </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>

                      <div class="modal-body">
                        @foreach($item['ingredient_products'] as $item)
                        <div class="row">
                          <div class="col-md-6" style="border: 1px solid #ccc; padding: 10px;">
                            <strong>{{ $item['ingredient']['nombre']}}:</strong>
                          </div>

                          <div class="col-md-4" style="border: 1px solid #ccc; padding: 10px;">
                            {{ $item['ingredient']['unidad']}}
                          </div>

                          <div class="col-md-2" style="border: 1px solid #ccc; padding: 10px;">
                            {{ $item->cantidad_requerida}}
                          </div>
                        </div>
                        @endforeach
                      </div>
                    </div>
                  </div>
                </div>
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
