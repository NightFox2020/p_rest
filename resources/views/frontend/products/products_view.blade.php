<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Menú | {{ $categoria->nombre }}</title>

  <!-- Bootstrap CSS + Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">


  <!-- Estilos -->
  <style>
    body {
      background-color: #F8F8F8;
      font-family: 'Poppins', sans-serif;
    }

    .product-card {
      border-radius: 16px;
      box-shadow: 0 4px 16px rgba(0,0,0,0.05);
      padding: 16px;
      background-color: white;
      text-align: center;
      height: 100%;
    }

    .product-img {
      max-width: 100px;
      margin: 0 auto 12px;
    }

    .product-title {
      font-weight: 600;
      color: #b3003c;
      font-size: 1rem;
    }

    .product-desc {
      font-size: 0.875rem;
      color: #666;
      margin-bottom: 10px;
    }

    .cantidad-label {
      font-weight: 600;
      font-size: 0.9rem;
      color: #222;
    }

    .btn-add {
      background-color: #ff4d80;
      color: white;
      border: none;
      border-radius: 8px;
      padding: 8px 20px;
      font-weight: 500;
      margin-top: 10px;
    }

    .cantidad-controls i {
      color: #ff4d80;
      font-size: 1rem;
      cursor: pointer;
    }

    .cantidad-controls span {
      margin: 0 6px;
      font-weight: 500;
    }

    .search-bar {
      border-radius: 16px;
      background-color: #f5f5f5;
      padding: 10px 15px;
      border: none;
      width: 100%;
    }

    .section-title {
      font-family: 'Pacifico', serif;
      color: #b3003c;
      font-weight: 500;
    }

    .section-sub {
      color: #BABABA;
      font-size: 0.9rem;
    }

    /* Tabla de respaldo oculta */
    .admin-table {
      display: none;
    }
  </style>
</head>
<body>

<div class="container py-4">

  <!-- Título y subtítulo -->
  <div class="mb-3">
    <h2 class="section-title text-center">{{ $categoria->nombre }}</h2>
    <p class="section-sub text-center">Elige Tu Favorito Y Endulza Tu Día 🍫</p>
  </div>

  <!-- Barra de búsqueda -->
  <div class="mb-4">
    <input type="text" class="search-bar" placeholder="¿Qué Se Te Antoja Hoy? Brownies, Tortas...">
  </div>

  <!-- Grid de productos -->
  <div class="row row-cols-2 g-3">
    @foreach ($products as $producto)
      <div class="col">
        <div class="product-card">
          <img src="{{ asset($producto->imagen) }}" alt="{{ $producto->nombre }}" class="product-img">
          <div class="product-title">{{ $producto->nombre }}</div>
          <div class="product-desc">{{ $producto->descripcion }}</div>
          <div class="cantidad-label mb-1">Cantidad</div>
          <div class="d-flex justify-content-center align-items-center cantidad-controls mb-2">
            <i class="bi bi-dash-circle"></i>
            <span>{{ $producto->cantidad ?? 1 }}</span>
            <i class="bi bi-plus-circle"></i>
          </div>
          <div class="fw-bold mb-2">Bs {{ $producto->precio_venta }}</div>
          <button class="btn btn-add">Añadir</button>
        </div>
      </div>
    @endforeach
  </div>

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
