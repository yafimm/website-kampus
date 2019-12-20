<div id="page-sidebar">
    <div class="scroll-sidebar">

        <ul id="sidebar-menu">
            <li class="header"><span>Menu</span></li>
            <li>
                <a href="{{ url('/bagumum/dashboard') }}" title="Admin Dashboard">
                    <i class="glyph-icon icon-typicons-home-outline" style="color:#337ab7"></i>
                    <span>Beranda</span>
                </a>
            </li>
            <li class="divider"></li>
            <li class="no-menu">
                <a href="{{ url('/bagumum/barang') }}" title="Frontend template">
                    <i class="glyph-icon icon-typicons-popup" style="color:#337ab7"></i>
                    <span>Data Barang</span>
                </a>
            </li>
            <li class="no-menu">
                <a href="{{ url('/bagumum/inventaris') }}" title="Frontend template">
                    <i class="glyph-icon icon-typicons-popup" style="color:#337ab7"></i>
                    <span>Data Inventaris</span>
                </a>    
            </li>
            <li class="no-menu">
                <a href="{{ url('/bagumum/peminjaman') }}" title="Frontend template">
                    <i class="glyph-icon icon-typicons-popup" style="color:#337ab7"></i>
                    <span>Data Peminjaman</span>
                </a>    
            </li>
            <li class="no-menu">
                <a href="{{ url('/bagumum/request') }}" title="Frontend template">
                    <i class="glyph-icon icon-typicons-popup" style="color:#337ab7"></i>
                    <span>Data Request Barang</span>
                </a>    
            </li>
            <li class="header"><span>Shortcut</span></li>
            <li class="btn-primary">
                <a href="{{ url('/bagumum/barang/tambah') }}" style="text-decoration: none;color:#fff">
                    <i class="glyph-icon icon-typicons-upload" style="color:#fff"></i>
                    <span>Tambah Data Barang</span>
                </a>
            </li>
            <li class="btn-primary">
                <a href="{{ url('/bagumum/inventaris/tambah') }}" style="text-decoration: none;color:#fff">
                    <i class="glyph-icon icon-typicons-upload" style="color:#fff"></i>
                    <span>Tambah Data Inventaris</span>
                </a>
            </li>

        </ul><!-- #sidebar-menu -->


    </div>
</div>