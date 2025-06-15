@extends('admin.admin_master')
@section('admin')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<div class="page-content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
          <h4 class="mb-sm-0 font-size-18">Compras</h4>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <div class="mb-3">
              <a href="{{ route('purchase.add') }}" class="btn btn-primary">Registrar</a>
            </div>

            <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
              <thead>
                <tr>
                  <th>#</th>
                  <th>N° Compra</th>
                  <th>Fecha</th>
                  <th>Total</th>
                  <th>Estado</th>
                  <th>Acción</th>
                </tr>
              </thead>


              <tbody>
                @foreach($allData as $key => $item)
                <tr style="vertical-align:middle;">
                  <td>{{ $key+1 }}</td>
                  <td>{{ $item->numero_compra }}</td>
                  <td>{{ date('d/m/Y',strtotime($item->created_at))}}</td>
                  <td>Bs{{ $item->total }}</td>
                  <td>
                    @if($item->estado == '0')
                    <span class="badge badge-pill badge-soft-warning font-size-12">Pendiente</span>
                    @elseif($item->estado == '1')
                    <span class="badge badge-pill badge-soft-success font-size-12" style="font-size:10pt;">Aprobada</span>
                    @endif
                  </td>
                  <td>
                    @if($item->estado == '0')
                    <a href="{{ route('purchase.pending.details', $item->id) }}" class="btn btn-sm btn-warning" title="Compra Pendiente">
                      <i class="fas fa-clipboard-list font-size-15"></i>
                    </a>
                    
                    <a href="{{ route('purchase.delete', $item->id) }}" class="btn btn-sm btn-danger" title="Eliminar" id="delete">
                      <i class="fas fa-trash-alt font-size-15"></i>
                    </a>
                    @else
                    <a href="{{ route('print.purchase', $item->id) }}" class="btn btn-sm btn-success" title="Imprimir">
                      <i class="fas fa-print font-size-15"></i>
                    </a>
                    @endif
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
