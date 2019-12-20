<div id="page-sidebar">
    <div class="scroll-sidebar">

        <ul id="sidebar-menu">
            <li class="header"><span>Menu</span></li>
            <li>
                <a href="{{ url('/admin/dashboard') }}" title="Admin Dashboard">
                    <i class="glyph-icon icon-typicons-home-outline" style="color:#337ab7"></i>
                    <span>Beranda</span>
                </a>
            </li>
            <li class="divider"></li>
            <li class="no-menu">
                <a href="{{ url('/admin/barang') }}" title="Frontend template">
                    <i class="glyph-icon icon-typicons-popup" style="color:#337ab7"></i>
                    <span>Data Barang</span>
                </a>
            </li>
            <li class="no-menu">
                <a href="{{ url('/admin/inventaris') }}" title="Frontend template">
                    <i class="glyph-icon icon-typicons-popup" style="color:#337ab7"></i>
                    <span>Data Inventaris</span>
                </a>
            </li>
            <li class="no-menu">
                <a href="{{ url('/admin/peminjaman') }}" title="Frontend template">
                    <i class="glyph-icon icon-typicons-popup" style="color:#337ab7"></i>
                    <span>Data Peminjaman</span>
                </a>    
            </li>
            <li class="no-menu">
                <a href="{{ url('/admin/pengguna') }}" title="Frontend template">
                    <i class="glyph-icon icon-typicons-popup" style="color:#337ab7"></i>
                    <span>Data Pengguna</span>
                </a>    
            </li>
            <li class="no-menu">
                <a href="{{ url('/admin/request') }}" title="Frontend template">
                    <i class="glyph-icon icon-typicons-popup" style="color:#337ab7"></i>
                    <span>Data Request Barang</span>
                </a>    
            </li>
            <li class="header"><span>Shortcut</span></li>
            <li class="btn-primary">
                <a href="{{ url('/admin/barang/tambah') }}" style="text-decoration: none;color:#fff">
                    <i class="glyph-icon icon-typicons-upload" style="color:#fff"></i>
                    <span>Tambah Data Barang</span>
                </a>
            </li>
            <li class="btn-primary">
                <a href="{{ url('/admin/inventaris/tambah') }}" style="text-decoration: none;color:#fff">
                    <i class="glyph-icon icon-typicons-upload" style="color:#fff"></i>
                    <span>Tambah Data Inventaris</span>
                </a>
            </li>

        </ul><!-- #sidebar-menu -->


    </div>
</div>