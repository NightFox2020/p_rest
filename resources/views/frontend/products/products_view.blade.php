<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <table>
      <thead>
        <tr>
          <th>Imagen</th>
          <th>Nombre</th>
        </tr>
      </thead>

      <tbody>
        @foreach($products as $product)
        <tr>
          <td> <img src="{{ asset($product->imagen) }}" alt="imgProduct" width="50"> </td>
          <td>{{ $product->nombre }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </body>
</html>
