<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="{{asset('assets/backend')}}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('assets/backend')}}/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
              with font-awesome or any other icon font library -->
          <li class="nav-item {{Request::is('dashboard') ? 'menu-is-opening menu-open' : ''}}">
            <a href="#" class="nav-link {{Request::is('dashboard') ? 'active' : ''}}">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Home
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item ">
                <a href="{{route('dashboard')}}" class="nav-link {{Request::is('dashboard') ? 'active' : ''}}">
                  <i class="fas fa-tachometer-alt nav-icon"></i>
                  <p>Dashboard</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item {{Request::is('customize') || Request::is('customize/*') ? 'menu-is-opening menu-open' : ''}}">
            <a href="#" class="nav-link {{Request::is('customize') || Request::is('customize/*') ? 'active' : ''}}">
              <i class="nav-icon fas fa-archive"></i>
              <p>
                Customize
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">6</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('customize.brand.index')}}" class="nav-link {{Request::is('customize/brand') || Request::is('customize/brand/*') ? 'active' : ''}}">
                  <i class="fab fa-bootstrap nav-icon"></i>
                  <p>Brand</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('customize.category.index')}}" class="nav-link {{Request::is('customize/category') || Request::is('customize/category/*') ? 'active' : ''}}">
                  <i class="fas fa-copyright nav-icon"></i>
                  <p>Category</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('customize.subCategory.index')}}" class="nav-link {{Request::is('customize/subCategory') || Request::is('customize/subCategory/*') ? 'active' : ''}}">
                  <i class="fab fa-speakap nav-icon"></i>
                  <p>Sub-category & Size</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('customize.feature.index')}}" class="nav-link {{Request::is('customize/feature') || Request::is('customize/feature/*') ? 'active' : ''}}">
                  <i class="fas fa-sitemap nav-icon"></i>
                  <p>Feature & Color</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('customize.slider.index')}}" class="nav-link {{Request::is('customize/slider') || Request::is('customize/slider/*') ? 'active' : ''}}">
                  <i class="fas fa-sliders-h nav-icon"></i>
                  <p>Slider</p>
                </a>
              </li>
              {{--  --}}
              <li class="nav-item {{Request::is('customize/product') || Request::is('customize/product/*') ? 'menu-is-opening menu-open' : ''}}">
                <a href="#" class="nav-link {{Request::is('customize/product') || Request::is('customize/product/*') ? 'active' : ''}}">
                  <i class="nav-icon fab fa-product-hunt"></i>
                  <p>
                    Product
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview" style="display: none !important">
                  <li class="nav-item">
                    <a href="{{route('customize.product.index')}}" class="nav-link {{Request::is('customize/product') ? 'active' : ''}}">
                      <i class="fab fa-product-hunt nav-icon"></i>
                      <p>Create Product</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{route('customize.product.list_view')}}" class="nav-link {{Request::is('customize/product/list-view') ? 'active' : ''}}">
                      <i class="fab fa-product-hunt nav-icon"></i>
                      <p>All Product</p>
                    </a>
                  </li>
                </ul>
              </li>
              {{--  --}}
              <li class="nav-item {{Request::is('customize/discount') || Request::is('customize/discount/*') ? 'menu-open' : ''}}">
                <a href="#" class="nav-link {{Request::is('customize/discount') || Request::is('customize/discount/*') ? 'active' : ''}}">
                  <i class="nav-icon fas fa-percent"></i>
                  <p>
                    Discount
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{route('customize.discount.index')}}" class="nav-link {{Request::is('customize/discount') ? 'active' : ''}}">
                      <i class="fas fa-percent nav-icon"></i>
                      <p>Create Discount</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{route('customize.discount.list_view')}}" class="nav-link {{Request::is('customize/discount/list-view') ? 'active' : ''}}">
                      <i class="fas fa-percent nav-icon"></i>
                      <p>All Discounts</p>
                    </a>
                  </li>
                </ul>
              </li>
            </ul>
          </li>
          <li class="nav-item {{Request::is('utilize') || Request::is('utilize/*') ? 'menu-is-opening menu-open' : ''}}">
            <a href="#" class="nav-link {{Request::is('utilize') || Request::is('utilize/*') ? 'active' : ''}}">
              <i class="nav-icon fas fa-chart-line"></i>
              <p>
                Utilize
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item has-treeview">
                <a href="#" class="nav-link {{Request::is('utilize/stock') || Request::is('utilize/stock/*') ? 'active' : ''}}">
                  <i class="nav-icon fab fa-stripe-s"></i>
                  <p>
                    Stock
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{route('utilize.stock.index')}}" class="nav-link {{Request::is('utilize/stock') ? 'active' : ''}}">
                      <i class="fab fa-stripe-s nav-icon"></i>
                      <p>Create Stock</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{route('utilize.stock.list_view')}}" class="nav-link {{Request::is('utilize/stock/list-view') ? 'active' : ''}}">
                      <i class="fab fa-stripe-s nav-icon"></i>
                      <p>All Stock</p>
                    </a>
                  </li>
                </ul>
              </li>
            </ul>
          </li>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>