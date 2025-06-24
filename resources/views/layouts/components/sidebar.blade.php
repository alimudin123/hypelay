@php
$links = [
[
"href" => route('home'),
"text" => "Dashboard",
"icon" => "fas fa-home",
"is_multi" => false
],
[
"href" => route('akun.index'),
"text" => "Kelola Akun",
"icon" => "fas fa-box",
"is_multi" => false
],
[
"text" => "Penjualan",
"icon" => "fas fa-shopping-cart",
"is_multi" => true,
"href" => [
[
"section_text" => "Transaksi",
"section_icon" => "far fa-circle",
"section_href" => route('penjualan.transaksipenjualan')
],
[
"section_text" => "Diskon",
"section_icon" => "far fa-circle",
"section_href" => route('penjualan.voucherdiskon.index')
],

]
],
[
"href" => route('produk.index'),
"text" => "Produk",
"icon" => "fas fa-box",
"is_multi" => false
],
[
"href" => route('laporan.penjualan'),
"text" => "Laporan Penjualan",
"icon" => "fas fa-chart-line",
"is_multi" => false
]
];

$navigation_links = json_decode(json_encode($links));
@endphp

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="#" class="brand-link">
    <img src="{{ asset('vendor/adminlte3/img/AdminLTELogo.png') }}" alt="HYPELAY WEAR" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">HYPELAY WEAR</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        @foreach ($navigation_links as $link)
        @if (!$link->is_multi)
        <li class="nav-item">
          <a href="{{ (url()->current() == $link->href) ? '#' : $link->href }}" class="nav-link {{ (url()->current() == $link->href) ? 'active' : '' }}">
            <i class="nav-icon {{ $link->icon }}"></i>
            <p>{{ $link->text }}</p>
          </a>
        </li>
        @else
        @php
        $open = '';
        $status = '';
        foreach ($link->href as $section) {
        if (url()->current() == $section->section_href) {
        $open = 'menu-open';
        $status = 'active';
        break;
        }
        }
        @endphp
        <li class="nav-item {{ $open }}">
          <a href="#" class="nav-link {{ $status }}">
            <i class="nav-icon {{ $link->icon }}"></i>
            <p>
              {{ $link->text }}
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            @foreach ($link->href as $section)
            <li class="nav-item">
              <a href="{{ (url()->current() == $section->section_href) ? '#' : $section->section_href }}" class="nav-link {{ (url()->current() == $section->section_href) ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>{{ $section->section_text }}</p>
              </a>
            </li>
            @endforeach
          </ul>
        </li>
        @endif
        @endforeach
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>