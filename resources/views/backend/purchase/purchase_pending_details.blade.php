@extends('admin.admin_master')
@section('admin')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<div class="page-content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
          <h4 class="mb-sm-0 font-size-18">Compra Pendiente</h4>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <div class="row mb-4">
              <div class="col-md-6">
                <h4 class="card-title mb-0">
                  N° Compra: <span class="text-info">{{ $purchase->numero_compra }}</span> <br>
                  Fecha de la Compra: <span class="text-info">{{ date('d-m-Y',strtotime($purchase->created_at)) }}</span>
                </h4>
              </div>

              <div class="col-md-6 text-end">
                <a href="{{ route('purchase.all') }}" class="btn btn-info waves-effect waves-light" style="float:right;">
                  Volver
                </a>
              </div>
            </div>

            <h5>Información adicional</h5>
            <span> Proveedor: {{ $purchase['supplier']['nombre']  }} </span> <br>
            <br><br>

            <form method="get" action="{{ route('purchase.approve',$purchase->id) }}">
              @csrf
              <table border="1" class="table table-bordered" style="border:solid 2px black;" width="100%">
                <thead style="background:#A4CACE;">
                  <tr>
                    <th class="text-center text-dark" style="background:#FFE3E4">#</th>
                    <th class="text-center text-dark" style="background:#FFE3E4">Ingrediente</th>
                    <th class="text-center text-dark" style="background:#FFE3E4">Unidad de Medida</th>
                    <th class="text-center text-dark" style="background:#FFE3E4">Cantidad</th>
                    <th class="text-center text-dark" style="background:#FFE3E4">Precio</th>
                    <th class="text-center text-dark" style="background:#FFE3E4">Subtotal</th>
                  </tr>
                </thead>
                <tbody>
                  @php
                  $total_sum = '0';
                  @endphp
                  @foreach($purchase['purchase_details'] as $key => $details)
                  <tr style="vertical-align:middle;">
                    <input type="hidden" name="ingrediente_id []" value="{{ $details->ingrediente_id  }}">
                    <input type="hidden" name="buying_qty[{{$details->id}}]" value="{{ $details->cantidad_comprada }}">

                    <td class="text-center">{{ $key+1 }}</td>
                    <td class="text-center">
                      {{ $details['ingredient']['nombre'] }}
                    </td>
                    <td class="text-center">
                      {{ $details['ingredient']['unit']['nombre'] }}
                    </td>
                    <td class="text-center">{{ $details->cantidad_comprada }}</td>
                    <td class="text-center">Bs{{ $details->precio_unitario }}</td>
                    <td class="text-center">Bs{{ $details->subtotal }}</td>
                  </tr>
                  @php
                  $total_sum += $details->subtotal;
                  @endphp
                  @endforeach
                  <tr>
                    <td colspan="5" class="text-end"> Total </td>
                    <td class="text-center" style="background:#DEDEDE; color:black;"> Bs{{ $total_sum }} </td>
                  </tr>
                </tbody>
              </table>
              @if($purchase->estado != '1')
              <div class=" text-center">
                <button type="submit" class="btn btn-primary">Aprobar Compra</button>
              </div>
              @endif
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
