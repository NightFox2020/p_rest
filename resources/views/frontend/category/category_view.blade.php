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
          <th>Ver Productos</th>
        </tr>
      </thead>

      <tbody>
        @foreach($categories as $category)
        <tr>
          <td> <img src="{{ asset($category->imagen) }}" alt="imgProduct" width="50"> </td>
          <td>{{ $category->nombre }}</td>
          <td> <a href="{{ route('menu.categories.products', $category->id) }}" target="_blank">Ver</a> </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </body>
</html>
