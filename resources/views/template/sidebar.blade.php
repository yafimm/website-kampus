<div id="page-sidebar">
    <div class="scroll-sidebar">

        <ul id="sidebar-menu">
            <li class="header"><span>Menu</span></li>
            <li>
                <a href="{{ route('dashboard') }}" title="Admin Dashboard">
                    <i class="glyph-icon icon-typicons-home-outline" style="color:#337ab7"></i>
                    <span>Beranda</span>
                </a>
            </li>
            <li class="divider"></li>
            @if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('bagumum'))
            <li class="no-menu">
                <a href="{{ route('barang.index') }}" title="Frontend template">
                    <i class="glyph-icon icon-typicons-popup" style="color:#337ab7"></i>
                    <span>Data Barang</span>
                </a>
            </li>
            <li class="no-menu">
                <a href="{{ route('inventaris.index') }}" title="Frontend template">
                    <i class="glyph-icon icon-typicons-popup" style="color:#337ab7"></i>
                    <span>Data Inventaris</span>
                </a>
            </li>
            @endif

            @if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('bagumum') || Auth::user()->hasRole('dosen'))
            <li class="no-menu">
              <a href="{{ route('request.index') }}" title="Frontend template">
                <i class="glyph-icon icon-typicons-popup" style="color:#337ab7"></i>
                <span>Data Request Barang</span>
              </a>
            </li>
            @endif

            <li class="no-menu">
                <a href="{{ route('peminjaman.index') }}" title="Frontend template">
                    <i class="glyph-icon icon-typicons-popup" style="color:#337ab7"></i>
                    <span>Data Peminjaman</span>
                </a>
            </li>

            @if(Auth::user()->hasRole('admin'))
            <li class="no-menu">
                <a href="{{ route('user.index') }}" title="Frontend template">
                    <i class="glyph-icon icon-typicons-popup" style="color:#337ab7"></i>
                    <span>Data Pengguna</span>
                </a>
            </li>
            @endif

            <li class="header"><span>Shortcut</span></li>

            @if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('bagumum'))
            <li class="btn-primary">
                <a href="{{ route('barang.tambah') }}" style="text-decoration: none;color:#fff">
                    <i class="glyph-icon icon-typicons-upload" style="color:#fff"></i>
                    <span>Tambah Data Barang</span>
                </a>
            </li>
            <li class="btn-primary">
                <a href="{{ route('inventaris.tambah') }}" style="text-decoration: none;color:#fff">
                    <i class="glyph-icon icon-typicons-upload" style="color:#fff"></i>
                    <span>Tambah Data Inventaris</span>
                </a>
            </li>


            @elseif(Auth::user()->hasRole('mahasiswa') || Auth::user()->hasRole('dosen'))

              @if(Auth::user()->hasRole('dosen'))
              <li class="btn-primary">
                <a href="{{ route('request.tambah') }}" style="text-decoration: none;color:#fff">
                  <i class="glyph-icon icon-typicons-upload" style="color:#fff"></i>
                  <span>Request Barang</span>
                </a>
              </li>
              @endif

            <li class="btn-primary">
                <a href="{{ url('/user/peminjaman/pinjam') }}" style="text-decoration: none;color:#fff">
                    <i class="glyph-icon icon-typicons-upload" style="color:#fff"></i>
                    <span>Pinjam Barang</span>
                </a>
            </li>

            @endif

        </ul><!-- #sidebar-menu -->


    </div>
</div>
