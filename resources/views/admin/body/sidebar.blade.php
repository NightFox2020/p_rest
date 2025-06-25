<div class="vertical-menu" style="background:black;">
  <div data-simplebar class="h-100">
    <div id="sidebar-menu">
      <ul class="metismenu list-unstyled" id="side-menu">
        <li class="menu-title" key="t-menu">Administración</li>
        <li>
          <a href="javascript: void(0);" class="waves-effect has-arrow">
            <i class="bx bx-briefcase-alt"></i>
            <span key="t-jobs">Inventario</span>
          </a>
          <ul class="sub-menu" aria-expanded="false">
            <li><a href="{{ route('category.all') }}">Cateogrías</a></li>
            <li><a href="{{ route('product.all') }}">Productos</a></li>
            <li><a href="{{ route('unit.all') }}">Unidades de Medida</a></li>
            <li><a href="{{ route('ingredient.all') }}">Ingredientes</a></li>
            <li><a href="{{ route('ingredient.product.all') }}">Recetas</a></li>
            <li><a href="{{ route('supplier.all') }}">Proveedores</a></li>
            <li><a href="{{ route('purchase.all') }}">Compras</a></li>
          </ul>
        </li>

      </ul>
    </div>
  </div>
</div>
