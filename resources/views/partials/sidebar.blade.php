<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="index.html" class="app-brand-link">
            <span class="app-brand-logo demo">
                <svg xmlns="http://www.w3.org/2000/svg" width="400" height="400" fill="currentColor" class="bi bi-fire"
                    viewBox="0 0 16 16">
                    <path
                        d="M8 16c3.314 0 6-2 6-5.5 0-1.5-.5-4-2.5-6 .25 1.5-1.25 2-1.25 2C11 4 9 .5 6 0c.357 2 .5 4-2 6-1.25 1-2 2.729-2 4.5C2 14 4.686 16 8 16m0-1c-1.657 0-3-1-3-2.75 0-.75.25-2 1.25-3C6.125 10 7 10.5 7 10.5c-.375-1.25.5-3.25 2-3.5-.179 1-.25 2 1 3 .625.5 1 1.364 1 2.25C11 14 9.657 15 8 15" />
                </svg>
            </span>
            <span class="app-brand-text demo menu-text fw-bolder ms-2">Komobox</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item {{ request()->routeIs('welcome') ? 'active' : '' }}">
            <a href="{{ route('welcome') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        {{-- Transaksi --}}
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Transaksi</span>
        </li>
        @if ($loggedInUser->role->role == 'admin' || $loggedInUser->role->role == 'manager')
            <li class="menu-item {{ request()->routeIs('index.penjualan') ? 'active' : '' }}">
                <a href="{{ route('index.penjualan') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-cart"></i>
                    <div data-i18n="Analytics">Transaksi Penjualan</div>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('index.pembelian', 'transactionPage.pembelian') ? 'active' : '' }}">
                <a href="{{ route('index.pembelian') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-cart"></i>
                    <div data-i18n="Analytics">Transaksi Pembelian</div>
                </a>
            </li>
        @endif
        @if ($loggedInUser->role->role == 'kasir')
        <li class="menu-item {{ request()->routeIs('index.penjualan') ? 'active' : '' }}">
            <a href="{{ route('index.penjualan') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-cart"></i>
                <div data-i18n="Analytics">Transaksi</div>
            </a>
        </li>  
        @endif
        @if ($loggedInUser->role->role == 'admin' || $loggedInUser->role->role == 'manager' || $loggedInUser->role->role == 'owner')  
        <li class="menu-item {{ request()->routeIs('index.pemasukkan') ? 'active' : '' }}">
            <a href="{{ route('index.pemasukkan') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-trending-up"></i>
                <div data-i18n="Analytics">Pemasukkan</div>
            </a>
        </li>
        <li class="menu-item {{ request()->routeIs('index.pengeluaran') ? 'active' : '' }}">
            <a href="{{ route('index.pengeluaran') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-trending-down"></i>
                <div data-i18n="Analytics">Pengeluaran</div>
            </a>
        </li>
        @endif
        @if ($loggedInUser->role->role == 'kasir')
        <li class="menu-item {{ request()->routeIs('index.pemasukkan') ? 'active' : '' }}">
            <a href="{{ route('index.pemasukkan') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-trending-up"></i>
                <div data-i18n="Analytics">Pemasukkan</div>
            </a>
        </li>
        @endif
        @if ($loggedInUser->role->role == 'admin' || $loggedInUser->role->role == 'manager')
            <li class="menu-item {{ request()->routeIs('index.returnBarang') ? 'active' : '' }}">
                <a href="{{ route('index.returnBarang') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-rotate-right"></i>
                    <div data-i18n="Analytics">Return Barang</div>
                </a>
            </li>
        @endif
        <li class="menu-item {{ request()->routeIs('index.infoStok') ? 'active' : '' }}">
            <a href="{{ route('index.infoStok') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-chart"></i>
                <div data-i18n="Analytics">Informasi Stok</div>
            </a>
        </li>

        {{-- financial --}}
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Finansial</span>
        </li>
        @if ($loggedInUser->role->role == 'admin' || $loggedInUser->role->role == 'manager' || $loggedInUser->role->role == 'owner')
        <li class="menu-item {{ request()->routeIs('index.piutang') ? 'active' : '' }}">
            <a href="{{ route('index.piutang') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-credit-card"></i>
                <div data-i18n="Analytics">Piutang</div>
            </a>
        </li>
        <li class="menu-item {{ request()->routeIs('index.utang') ? 'active' : '' }}">
            <a href="{{ route('index.utang') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-credit-card"></i>
                <div data-i18n="Analytics">Utang</div>
            </a>
        </li>
        @endif

        @if ($loggedInUser->role->role == 'kasir')
        <li class="menu-item {{ request()->routeIs('index.piutang') ? 'active' : '' }}">
            <a href="{{ route('index.piutang') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-credit-card"></i>
                <div data-i18n="Analytics">Piutang</div>
            </a>
        </li>
        @endif

        {{-- Laporan --}}
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Laporan</span>
        </li>
        @if ($loggedInUser->role->role == 'admin' || $loggedInUser->role->role == 'manager' || $loggedInUser->role->role == 'owner')    
        <li class="menu-item {{ request()->routeIs('index.laporanPenjualan') ? 'active' : '' }}">
            <a href="{{ route('index.laporanPenjualan') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-report"></i>
                <div data-i18n="Analytics">Laporan Penjualan</div>
            </a>
        </li>
        <li class="menu-item {{ request()->routeIs('index.laporanPembelian') ? 'active' : '' }}">
            <a href="{{ route('index.laporanPembelian') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-report"></i>
                <div data-i18n="Analytics">Laporan Pembelian</div>
            </a>
        </li>
        <li class="menu-item {{ request()->routeIs('index.laporanPemasukkan') ? 'active' : '' }}">
            <a href="{{ route('index.laporanPemasukkan') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-report"></i>
                <div data-i18n="Analytics">Laporan Pemasukkan</div>
            </a>
        </li>
        <li class="menu-item {{ request()->routeIs('index.laporanPengeluaran') ? 'active' : '' }}">
            <a href="{{ route('index.laporanPengeluaran') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-report"></i>
                <div data-i18n="Analytics">Laporan Pengeluaran</div>
            </a>
        </li>
        <li class="menu-item {{ request()->routeIs('index.laporanLabaRugi') ? 'active' : '' }}">
            <a href="{{ route('index.laporanLabaRugi') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-report"></i>
                <div data-i18n="Analytics">Laporan Laba Rugi</div>
            </a>
        </li>
        @endif

        @if ($loggedInUser->role->role == 'kasir')
        <li class="menu-item {{ request()->routeIs('index.laporanPenjualan') ? 'active' : '' }}">
            <a href="{{ route('index.laporanPenjualan') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-report"></i>
                <div data-i18n="Analytics">Laporan Penjualan</div>
            </a>
        </li>
        @endif

        {{-- Master --}}
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Master</span>
        </li>
        <li class="menu-item {{ request()->routeIs('index.diskon') ? 'active' : '' }}">
            <a href="{{ route('index.diskon') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-discount"></i>
                <div data-i18n="Analytics">Diskon</div>
            </a>
        </li>
        <li class="menu-item {{ request()->routeIs('index.stok') ? 'active' : '' }}">
            <a href="{{ route('index.stok') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-table"></i>
                <div data-i18n="Analytics">Stok</div>
            </a>
        </li>
        <li class="menu-item {{ request()->routeIs('index.produk', 'addPage.product', 'editPage.product') ? 'active' : '' }}">
            <a href="{{ route('index.produk') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-spreadsheet"></i>
                <div data-i18n="Analytics">Produk</div>
            </a>
        </li>
        <li class="menu-item {{ request()->routeIs('index.subCtgrProduct') ? 'active' : '' }}">
            <a href="{{ route('index.subCtgrProduct') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-spreadsheet"></i>
                <div data-i18n="Analytics">Sub Kategori Produk</div>
            </a>
        </li>
        <li class="menu-item {{ request()->routeIs('index.ctgrProduct') ? 'active' : '' }}">
            <a href="{{ route('index.ctgrProduct') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-spreadsheet"></i>
                <div data-i18n="Analytics">Kategori Produk</div>
            </a>
        </li>
        <li class="menu-item {{ request()->routeIs('index.supplier', 'addPage.supplier', 'editPage.supplier') ? 'active' : '' }}">
            <a href="{{ route('index.supplier') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-truck"></i>
                <div data-i18n="Analytics">Supplier</div>
            </a>
        </li>
        {{-- <li class="menu-item {{ request()->routeIs('index.member', 'addPage.member') ? 'active' : '' }}">
            <a href="{{ route('index.member') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-group"></i>
                <div data-i18n="Analytics">Member</div>
            </a>
        </li> --}}
    </ul>
</aside>
