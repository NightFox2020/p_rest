<!doctype html>
<html lang="en">

<head>

  <meta charset="utf-8" />
  <title>Sistema - Mi Dulce Inspiración</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
  <meta content="Themesbrand" name="author" />
  <!-- App favicon -->
  <link rel="shortcut icon" href="{{asset('backend/assets/images/favicon.ico')}}">

  <!-- Bootstrap Css -->
  <link href="{{asset('backend/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
  <!-- Icons Css -->
  <link href="{{asset('backend/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
  <!-- App Css-->
  <link href="{{asset('backend/assets/css/app.min.css')}}" rel="stylesheet" type="text/css" />
  <!-- App js -->
  <script src="{{asset('backend/assets/js/plugin.js')}}"></script>

  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >

</head>

<body data-sidebar="dark">

  <div class="account-pages my-5 pt-sm-5">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 col-xl-5">
          <div class="card overflow-hidden">
            <div class="bg-primary-subtle">
              <div class="row">
                <div class="col-12">
                  <div class="text-primary p-4 text-center">
                    <h3 class="text-primary" style="font-weight:bold;">INGRESAR AL SISTEMA</h3>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-body pt-0">
              <div class="p-2">
                <form class="form-horizontal" method="POST" action="{{ route('login') }}" id="myForm">
                  @csrf

                  <div class="mb-3">
                    <div class="">
                      @error('email')
                      <span class="text-danger">Datos incorrectos</span>
                      @enderror
                    </div>
                    <label for="email" class="form-label">Correo</label>
                    <input type="email" name="email" class="form-control" id="email" required placeholder="ejemplo@gmail.com">
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Contraseña</label>
                    <div class="input-group auth-pass-inputgroup">
                      <input type="password" name="password" class="form-control" required placeholder="**********************" aria-label="Password" aria-describedby="password-addon">
                      <button class="btn btn-light " type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                    </div>
                  </div>

                  <div class="mt-3 d-grid">
                    <button class="btn btn-primary waves-effect waves-light" type="submit">Iniciar Sesión</button>
                  </div>
                </form>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Right bar overlay-->
  <div class="rightbar-overlay"></div>

  <!-- JAVASCRIPT -->
  <script src="{{asset('backend/assets/libs/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('backend/assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('backend/assets/libs/metismenu/metisMenu.min.js')}}"></script>
  <script src="{{asset('backend/assets/libs/simplebar/simplebar.min.js')}}"></script>
  <script src="{{asset('backend/assets/libs/node-waves/waves.min.js')}}"></script>

  <!-- apexcharts -->
  <script src="{{asset('backend/assets/libs/apexcharts/apexcharts.min.js')}}"></script>

  <!-- dashboard init -->
  <script src="{{asset('backend/assets/js/pages/dashboard.init.js')}}"></script>

  <!-- App js -->
  <script src="{{asset('backend/assets/js/app.js')}}"></script>

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

  <script>
  @if(Session::has('message'))
  var type = "{{ Session::get('alert-type','info') }}"
  switch(type){
    case 'info':
    toastr.info(" {{ Session::get('message') }} ", '', { positionClass: 'toast-bottom-right' });
    break;

    case 'success':
    toastr.success(" {{ Session::get('message') }} ", '', { positionClass: 'toast-bottom-right' });
    break;

    case 'warning':
    toastr.warning(" {{ Session::get('message') }} ", '', { positionClass: 'toast-bottom-right' });
    break;

    case 'error':
    toastr.error(" {{ Session::get('message') }} ", '', { positionClass: 'toast-bottom-right' });
    break;
  }
  @endif
  </script>

  <script src="{{ asset('backend/validate.min.js') }}"></script>
  <script src="{{ asset('backend/handlebars.js') }}"></script>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

  <script src="{{ asset('backend/code.js') }}"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js" ></script>

  <script type="text/javascript">
  $(document).ready(function (){
    $('#myForm').validate({
      rules: {
        email: {
          required : true,
        },
        password: {
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

</body>
</html>
