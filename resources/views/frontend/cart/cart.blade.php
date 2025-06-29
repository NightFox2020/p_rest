<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CARRITO - Resumen de Pedido</title>

  <!-- Bootstrap CSS + Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <style>
    body {
      background-color: #f9f9f9;
      font-family: 'Poppins', sans-serif;
    }

    .section-title {
      font-family: 'Pacifico', cursive;
      color: #dc1c2e;
      font-size: 1.8rem;
    }

    .section-sub {
      color: #b3003c;
      font-weight: 500;
    }

    .card-product {
      background: white;
      border-radius: 16px;
      padding: 16px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.06);
    }

    .qty-box {
      display: flex;
      align-items: center;
      gap: 10px;
      background: #f9f9f9;
      padding: 4px 10px;
      border-radius: 20px;
      font-weight: 500;
    }

    .btn-circle {
      border: none;
      background: none;
      font-size: 1.2rem;
      color: #dc1c2e;
    }

    .summary-box {
      background-color: #ff4d80;
      color: white;
      padding: 20px;
      border-radius: 30px 30px 0 0;
    }

    .btn-checkout {
      background-color: white;
      color: #dc1c2e;
      font-weight: 600;
      border: none;
      padding: 10px;
      border-radius: 12px;
      width: 100%;
    }

    .price-old {
      text-decoration: line-through;
      color: #bbb;
      font-size: 0.9rem;
    }

    .txt-cus h2,
    .txt-cus h3 {
      color: #b3003c;
    }

    .txt-cus h2 {
      font-weight: 600;
      margin: 0px;
      letter-spacing: 1px;
      font-size: 28px; 
    }

    .txt-cus h3 {
      font-family: 'Pacifico', serif;
      font-size: 28px;
    }
  </style>
</head>

<body>
  <div class="container py-4">

    <!-- Encabezado -->
    <div class="d-flex align-items-center mb-4 justify-content-between">
      <a href="#" class="btn btn-light rounded-circle me-2">
        <i class="bi bi-arrow-left"></i>
      </a>
      <!-- Título -->
      <div class="txt-cus text-center">
        <h2 class="fw-semibold">Resumen De</h2>
        <h3 class="fw-normal">Pedido</h3>
      </div>
      <!-- Box-Helper -->
      <div class="">
      </div>
    </div>

    <!-- Productos seleccionados -->
    <h6 class="fw-bold">Productos Seleccionados</h6>

    <div class="d-flex flex-column gap-3 mb-4">
      <!-- Producto -->
      <div class="card-product d-flex align-items-center">
        <img src="https://via.placeholder.com/60" class="me-3 rounded" alt="producto">
        <div class="flex-grow-1">
          <div class="fw-semibold">Brownie De Chocolate</div>
          <div>
            <span>Bs 8</span> <span class="price-old">Bs 12</span>
          </div>
        </div>
        <div class="qty-box">
          <button class="btn-circle btn-decrease"><i class="bi bi-dash"></i></button>
          <span class="cantidad">1</span>
          <button class="btn-circle btn-increase"><i class="bi bi-plus"></i></button>
        </div>
        <button class="btn btn-link text-danger ms-2"><i class="bi bi-trash"></i></button>
      </div>

      <!-- Repetí el bloque de arriba para otros productos -->

    </div>

    <!-- Datos del cliente -->
    <h6 class="fw-bold">Datos Del Cliente</h6>
    <input type="text" class="form-control mb-4" placeholder="Ingresa Tu Nombre (Sin Apellidos)">

    <!-- Totales -->
    <div class="summary-box">
      <div class="d-flex justify-content-between">
        <span>Subtotal</span>
        <span>Bs 65</span>
      </div>
      <hr class="my-2">
      <div class="d-flex justify-content-between fw-bold">
        <span>Total</span>
        <span>Bs 65</span>
      </div>
      <button class="btn-checkout mt-3">Realizar Pedido</button>
    </div>
  </div>

  <!-- Bootstrap Bundle JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Aquí podrías manejar la lógica de aumento, reducción y borrado si lo necesitás
    document.querySelectorAll('.btn-increase').forEach(btn => {
      btn.addEventListener('click', () => {
        const span = btn.parentElement.querySelector('.cantidad');
        span.textContent = parseInt(span.textContent) + 1;
      });
    });

    document.querySelectorAll('.btn-decrease').forEach(btn => {
      btn.addEventListener('click', () => {
        const span = btn.parentElement.querySelector('.cantidad');
        const valor = parseInt(span.textContent);
        if (valor > 1) span.textContent = valor - 1;
      });
    });
  </script>
</body>

</html>