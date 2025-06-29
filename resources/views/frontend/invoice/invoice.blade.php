<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>FACTURA - Confirmación de Pedido</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Estilos personalizados -->
  <style>
    body {
      background-color: #f5f5f5;
      font-family: 'Poppins', sans-serif;
    }

    .order-card {
      background-color: #fff;
      border-radius: 8px;
      padding: 24px;
      max-width: 400px;
      margin: 40px auto;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
    }

    .success-icon {
      font-size: 24px;
      color: green;
    }

    .order-detail {
      border: 1px solid #ddd;
      border-radius: 10px;
      padding: 15px;
      margin-top: 15px;
    }

    .footer-box {
      background-color: #e0efff;
      border-radius: 20px 20px 0 0;
      padding: 20px;
      margin-top: 30px;
      text-align: center;
    }

    .footer-box p {
      margin: 0;
      font-size: 14px;
    }

    .btn-add {
      background-color: #007bff;
      color: white;
      font-weight: 600;
      width: 100%;
      border-radius: 10px;
      margin-top: 12px;
    }

    .btn-add:hover {
      background-color: #0056b3;
    }

    .highlight {
      color: #DC1C2E;
      font-weight: bold;
    }
  </style>
</head>
<body>

  <div class="order-card text-center">
    <img src="{{ asset('backend/assets/images/logo-sin-fondo.png') }}" alt="Logo" class="mb-3" style="max-height: 120px;">

    <div class="d-flex align-items-center justify-content-center mb-3">
      <span class="me-2 success-icon">✅</span>
      <div>
        <strong>¡Gracias, John!</strong><br>
        Tu Pedido Ha Sido Recibido.
      </div>
    </div>

    <hr>

    <h5 class="fw-bold">Detalle De Pedido</h5>
    <div class="d-flex justify-content-between">
      <span class="highlight">Orden #45</span>
      <span class="highlight">Mesa #5</span>
    </div>

    <div class="order-detail text-start mt-2">
      <div class="d-flex justify-content-between">
        <strong>Productos</strong>
        <strong>Total</strong>
      </div>
      <div class="d-flex justify-content-between mt-1">
        <span>Brownie De Chocolate X1</span>
        <span>Bs 8</span>
      </div>
      <div class="d-flex justify-content-between">
        <span>Galletas De Chocolate X1</span>
        <span>Bs 17</span>
      </div>
      <div class="d-flex justify-content-between">
        <span>Milkshake De Frutilla X2</span>
        <span>Bs 20</span>
      </div>
    </div>

    <div class="d-flex justify-content-between mt-3">
      <span>Subtotal</span>
      <span>Bs 65</span>
    </div>

    <div class="d-flex justify-content-between mt-2 border-top pt-2">
      <strong>Total</strong>
      <strong>BS 65</strong>
    </div>

    <div class="footer-box mt-4">
      <p><strong class="text-primary">¿Te Olvidaste De Algo?</strong> Puedes Modificar Tu Pedido O Añadir Más Delicias Si Lo Deseas.</p>
      <button class="btn btn-add mt-3">
        🧁 Añadir Productos
      </button>
    </div>
  </div>

  <!-- Bootstrap JS (opcional si usas modales) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
