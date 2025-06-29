<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PRODUCTOS - Menú | {{ $categoria->nombre }}</title>

  <!-- Bootstrap CSS + Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <!-- En tu <head> -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">


  <!-- Estilos -->
  <style>
    body {
      background-color: #F8F8F8;
      font-family: 'Poppins', sans-serif;
    }

    .product-card {
      border-radius: 16px;
      box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05);
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
      font-weight: 700;
      color: #b3003c;
      font-size: 18px;
      line-height: 1.3;
    }

    .product-desc {
      font-size: 0.875rem;
      color: #666;
      margin-bottom: 10px;
    }

    .price {
      font-size: 20px;
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

    /* Chrome, Safari, Edge, Opera */
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }

    /* Firefox */
    input[type=number] {
      -moz-appearance: textfield;
    }

    input#buscador,
    span.icon-search {
      background: #ffffff;
    }

    span.icon-search {
      border: 0;
      border-top-right-radius: 16px;
      border-bottom-right-radius: 16px;
    }

    @media (max-width: 767px) {

      .product-title,
      .product-desc,
      .price,
      .cantidad-label {
        text-align: left;
      }

      .tittle {
        margin: 0 !important;
      }

      .product-desc {
        height: 42px;
      }

      input#buscador {
        font-size: 14px;
      }
    }
  </style>
</head>

<body>

  <div class="container py-4">

    <!-- Encabezado con volver y carrito -->
    <div class="d-flex justify-content-between align-items-center px-3 py-2 mb-3">
      <!-- Botón volver -->
      <a href="{{ url()->previous() }}" class="btn btn-light rounded-circle shadow-sm">
        <i class="bi bi-arrow-left"></i>
      </a>

      <!-- Título central -->
      <div class="text-center flex-grow-1 tittle" style="margin-left: -40px;">
        <h2 class="section-title m-0">{{ $categoria->nombre }}</h2>
        <p class="section-sub m-0 pt-2">Elige Tu Favorito Y Endulza Tu Día 🍫</p>
      </div>

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


    <!-- Barra de búsqueda con ícono -->
    <div class="mb-4">
      <div class="input-group">
        <input type="text" class="form-control search-bar border-start-0" id="buscador" placeholder="¿Qué Se Te Antoja Hoy?...">
        <span class="input-group-text border-end-0 icon-search">
          <i class="bi bi-search text-muted"></i>
        </span>
      </div>
    </div>


    <!-- Grid de productos -->
    <div class="row row-cols-2 row-cols-md-2 row-cols-lg-4 g-3">
      @foreach ($products as $producto)
      <div class="col">
        <div class="product-card">
          <img src="{{ asset($producto->imagen) }}" alt="{{ $producto->nombre }}" class="product-img">
          <div class="product-title mb-2">{{ $producto->nombre }}</div>
          <div class="product-desc">{{ $producto->descripcion }}</div>
          <div class="cantidad-label mb-1">Cantidad</div>
          <div class="d-flex justify-content-center align-items-center cantidad-controls mb-2">
            <button class="btn btn-sm rounded-circle border-0 text-danger btn-decrease" style="border: 2px solid #ff4d80;"><i class="fas fa-minus-circle"></i></button>
            <input type="number"
              class="form-control text-center cantidad-numero"
              style="width: 60px;"
              value="0"
              min="0"
              max="{{ $producto->cantidad }}"
              data-stock="{{ $producto->cantidad }}"
              data-cantidad="0">

            <button class="btn btn-sm rounded-circle border-0 text-danger btn-increase" style="border: 2px solid #ff4d80;"><i class="fas fa-plus-circle"></i></button>
          </div>
          <div class="mensaje-stock text-danger small" style="display: none;">¡Stock máximo disponible!</div>

          <div class="fw-bold mb-2 price">Bs {{ $producto->precio_venta }}</div>
          <button class="btn btn-add">Añadir</button>
        </div>
      </div>
      @endforeach
    </div>

  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', () => {

      // === LÓGICA DE CANTIDAD POR PRODUCTO ===
      document.querySelectorAll('.product-card').forEach((card, index) => {
        const btnMinus = card.querySelector('.btn-decrease');
        const btnPlus = card.querySelector('.btn-increase');
        const input = card.querySelector('.cantidad-numero');
        const mensaje = card.querySelector('.mensaje-stock');

        const stockMaximo = parseInt(input.dataset.stock);
        console.log(`🧁 Producto #${index + 1} - Stock máximo: ${stockMaximo}`);

        // Inicializa en 0
        input.value = 0;
        input.dataset.cantidad = 0;

        // Botón +
        btnPlus.addEventListener('click', () => {
          let cantidad = parseInt(input.dataset.cantidad);

          if (cantidad < stockMaximo) {
            cantidad++;
            input.value = cantidad;
            input.dataset.cantidad = cantidad;
            mensaje.style.display = "none";
            console.log(`✅ Nueva cantidad: ${cantidad}`);
          } else {
            mensaje.style.display = "block";
            console.log("🚫 Límite alcanzado: Stock máximo");
          }
        });

        // Botón -
        btnMinus.addEventListener('click', () => {
          let cantidad = parseInt(input.dataset.cantidad);

          if (cantidad > 0) {
            cantidad--;
            input.value = cantidad;
            input.dataset.cantidad = cantidad;
            mensaje.style.display = "none";
            console.log(`✅ Nueva cantidad: ${cantidad}`);
          }
        });

        // Entrada manual
        input.addEventListener('input', () => {
          let cantidad = parseInt(input.value);

          if (isNaN(cantidad) || cantidad < 0) cantidad = 0;
          if (cantidad > stockMaximo) {
            cantidad = stockMaximo;
            mensaje.style.display = "block";
          } else {
            mensaje.style.display = "none";
          }

          input.value = cantidad;
          input.dataset.cantidad = cantidad;
          console.log(`⌨️ Input manual - Nueva cantidad: ${cantidad}`);
        });
      });

      // === FILTRO DE PRODUCTOS POR BUSCADOR ===
      const inputBuscador = document.getElementById('buscador');
      if (inputBuscador) {
        inputBuscador.addEventListener('input', function() {
          const filtro = this.value.toLowerCase();
          const productos = document.querySelectorAll('.product-card');

          productos.forEach(card => {
            const titulo = card.querySelector('.product-title')?.textContent.toLowerCase() || '';
            const desc = card.querySelector('.product-desc')?.textContent.toLowerCase() || '';

            const col = card.closest('.col');
            if (titulo.includes(filtro) || desc.includes(filtro)) {
              col.style.display = 'block';
            } else {
              col.style.display = 'none';
            }
          });
        });
      }

    });
  </script>

</body>

</html>