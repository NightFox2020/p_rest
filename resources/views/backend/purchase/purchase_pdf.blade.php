@extends('admin.admin_master')
@section('admin')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<div class="page-content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
          <h4 class="mb-sm-0 font-size-18">Detalle de Compra</h4>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="invoice-title">
              <h4 class="float-end font-size-16">N° Compra: {{ $purchase->numero_compra }}</h4>

              <div class="auth-logo mb-4">
                <img src="{{asset('backend/assets/images/logo.jpg')}}" alt="logo" class="auth-logo-dark" height="50"/>
              </div>
            </div>

            <hr>

            <div class="row">
              <div class="col-sm-6">
                <address>
                  <strong>Billed To:</strong><br>
                  John Smith<br>
                  1234 Main<br>
                  Apt. 4B<br>
                  Springfield, ST 54321
                </address>
              </div>

              <div class="col-sm-6 text-sm-end">
                <address class="mt-2 mt-sm-0">
                  <strong>Información adicional</strong><br>
                  Proveedor:
                    @if(isset($purchase['supplier']['nombre']))
                    {{ $purchase['supplier']['nombre'] }}
                    @else
                    Sin Proveedor
                    @endif
                    <br>
                </address>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-6 mt-3">
                <address>
                  <strong>Compra realizada por:</strong><br>
                  @php
                  $user = App\Models\User::find($purchase->usuario_id);
                  $user_name = $user ? $user->name : 'Usuario no encontrado';
                  @endphp
                  {{ $user_name }}
                  <br>
                </address>
              </div>

              <div class="col-sm-6 mt-3 text-sm-end">
                <address>
                  <strong>Fecha de Compra:</strong><br>
                  {{ Carbon\Carbon::parse($purchase->created_at)->format('d/m/Y H:i:s') }}<br><br>
                </address>
              </div>
            </div>

            <div class="py-2 mt-3">
              <h3 class="font-size-15 fw-bold">Resumen de Compra</h3>
            </div>

            <div class="table-responsive">
              <table class="table table-nowrap text-center">
                <thead>
                  <tr>
                    <th style="width: 70px;">#</th>
                    <th>Ingrediente</th>
                    <th>Unidad de Medida</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Subtotal</th>
                  </tr>
                </thead>

                <tbody>
                  @foreach($purchase['purchase_details'] as $key => $details)
                  <tr style="vertical-align:middle;">
                    <td>{{ $key+1 }}</td>
                    <td>{{ $details['ingredient']['nombre'] }}</td>
                    <td>{{ $details['ingredient']['unit']['nombre'] }}</td>
                    <td>{{ $details->cantidad_comprada }}</td>
                    <td>Bs{{ $details->precio_unitario }}</td>
                    <td>Bs{{ $details->subtotal }}</td>
                  </tr>
                  @endforeach

                  <tr>
                    <td colspan="5" class="border-0 text-end">
                      <strong>Total</strong>
                    </td>
                    <td class="border-0"><h4 class="m-0">Bs{{ $purchase->total }}</h4></td>
                  </tr>
                </tbody>
              </table>
            </div>

            <div class="d-print-none">
              <div class="float-end">
                <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light me-1"><i class="fa fa-print"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
