<div id="page-sidebar">
    <div class="scroll-sidebar">

        <ul id="sidebar-menu">
            <li class="header"><span>Menu</span></li>
            <li>
                <a href="{{ url('/user/dashboard') }}" title="Dashboard">
                    <i class="glyph-icon icon-typicons-home-outline" style="color:#337ab7"></i>
                    <span>Beranda</span>
                </a>
            </li>
            <li class="divider"></li>
            <li class="no-menu">
                <a href="{{ url('/user/peminjaman') }}" title="Frontend template">
                    <i class="glyph-icon icon-typicons-popup" style="color:#337ab7"></i>
                    <span>Data Peminjaman</span>
                </a>    
            </li>
            <li class="header"><span>Shortcut</span></li>
            <li class="btn-primary">
                <a href="{{ url('/user/peminjaman/pinjam') }}" style="text-decoration: none;color:#fff">
                    <i class="glyph-icon icon-typicons-upload" style="color:#fff"></i>
                    <span>Pinjam Barang</span>
                </a>
            </li>

        </ul><!-- #sidebar-menu -->


    </div>
</div>