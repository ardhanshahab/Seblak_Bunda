<div class="main-sidebar">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="index.html">Stisla</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
        <a href="index.html">St</a>
      </div>
      <ul class="sidebar-menu">
          <li class="menu-header">Menu Admin</li>
          <li><a class="nav-link" href=""><i class="fas fa-tachometer-alt"></i> <span> {{ __('menu.dashboard') }}</span></a></li>
          <li class="{{ request()->is('app/feature/cashier*') ? 'active' : '' }}"><a class="nav-link " href="{{ route('feature.cashier.index') }}"><i class="fas fa-cash-register"></i> <span> {{ __('menu.cashier') }}</span></a></li>
          <li class="nav-item dropdown {{ request()->is('app/master*') ? 'active' : '' }}">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-table"></i><span>Master</span></a>
            <ul class="dropdown-menu">
              <li><a class="nav-link" href="{{ route('master.user.index') }}">{{ __('menu.user') }}</a></li>
              <li><a class="nav-link" href="{{ route('master.category.index') }}">{{ __('menu.category') }}</a></li>
              <li><a class="nav-link" href="{{ route('master.product.index') }}">{{ __('menu.product') }}</a></li>
              {{-- <li><a class="nav-link" href="{{ route('master.outlet.index') }}">{{ __('menu.outlet') }}</a></li> --}}
            </ul>
          </li>
          <li class="nav-item dropdown {{ request()->is('app/order*') ? 'active' : '' }}">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-table"></i><span>{{ __('menu.order') }}</span></a>
            <ul class="dropdown-menu">
              <li><a class="nav-link" href="{{ route('feature.order.index') }}">{{ __('menu.order_history') }}</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-cog"></i><span>{{ __('menu.setting') }}</span></a>
            <ul class="dropdown-menu">
              <li><a class="nav-link" href="{{ route('setting.web') }}">{{ __('menu.setting_web') }}</a></li>
            </ul>
          </li>
        </ul>
    </aside>
  </div>
