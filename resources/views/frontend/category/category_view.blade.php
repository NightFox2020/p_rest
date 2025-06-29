<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>MENU - Mi Dulce Inspiración</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <style>
    body {
      background-color: #F8F8F8;
      font-family: 'Poppins', sans-serif;

    }

    strong {
      color: #b3003c;
    }

    .logo {
      width: 130px;
    }

    .circle-card {
      border-radius: 50%;
      background: white;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
      padding: 20px;
      text-align: center;
      transition: transform 0.3s ease;
    }

    .circle-card:hover {
      transform: scale(1.05);
    }

    .circle-img {
      max-width: 100px;
      margin-bottom: 10px;
    }

    h2 {
      font-weight: 600;
      /* margin-top: 20px; */
      letter-spacing: 1px;
    }

    h3 {
      font-family: 'Pacifico', serif;
      font-size: 34px;
    }

    .txt-cus h2,
    .txt-cus h3 {
      color: #b3003c;
    }
  </style>
</head>

<body>

  <div class="container py-4">
    <!-- Logo y carrito -->
    <div class="d-flex justify-content-between align-items-center mb-3">
      <img src="{{ asset('backend/assets/images/logo-sin-fondo.png') }}" alt="Logo" class="logo" style="width: 120px;">
      <!-- Carrito con contador -->
      <div class="position-relative">
        <a href="{{ route('carrito.ver') }}" class="btn btn-light rounded-circle shadow-sm">
          <i class="bi bi-cart3"></i>
        </a>
        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success">
          1
        </span>
      </div>
    </div>

    <!-- Título -->
    <div class="txt-cus text-center">
      <h2 class="fw-semibold">Explora Nuestro</h2>
      <h3 class="fw-normal">Menú</h3>
    </div>

    <!-- Categorías dinámicas -->
    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4 mt-3">
      @foreach($categories as $category)
      <div class="col text-center">
        <a href="{{ route('menu.categories.products', $category->id) }}" class="text-decoration-none text-dark">
          <div class="circle-card mx-auto">
            <img src="{{ asset($category->imagen) }}" class="circle-img" alt="{{ $category->nombre }}">
            <div><strong>{{ $category->nombre }}</strong></div>
          </div>
        </a>
      </div>
      @endforeach
    </div>
  </div>

  <!-- Bootstrap JS & Icons -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
</body>

</html>