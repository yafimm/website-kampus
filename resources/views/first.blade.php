<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
    <title> Sistem Inventory Online | STMIK AMIKBANDUNG </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Favicons -->

    <link rel="apple-touch-icon-precomposed" sizes="144x144"
        href="{{ asset('assets/images/icons/apple-touch-icon-144-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114"
        href="{{ asset('assets/images/icons/apple-touch-icon-114-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72"
        href="{{ asset('assets/images/icons/apple-touch-icon-72-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed"
        href="{{ asset('assets/images/icons/apple-touch-icon-57-precomposed.png') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images-resource/favicon.ico') }}">



    <!-- HELPERS -->

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/helpers/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/helpers/backgrounds.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/helpers/boilerplate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/helpers/border-radius.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/helpers/grid.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/helpers/page-transitions.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/helpers/spacing.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/helpers/typography.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/helpers/utils.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/helpers/colors.css') }}">

    <!-- ELEMENTS -->

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/elements/badges.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/elements/buttons.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/elements/content-box.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/elements/dashboard-box.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/elements/forms.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/elements/images.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/elements/info-box.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/elements/invoice.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/elements/loading-indicators.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/elements/menus.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/elements/panel-box.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/elements/response-messages.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/elements/responsive-tables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/elements/ribbon.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/elements/social-box.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/elements/tables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/elements/tile-box.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/elements/timeline.css') }}">

    <!-- FRONTEND ELEMENTS -->

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend-elements/blog.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend-elements/cta-box.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend-elements/feature-box.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend-elements/footer.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend-elements/hero-box.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend-elements/icon-box.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend-elements/portfolio-navigation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend-elements/pricing-table.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend-elements/sliders.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend-elements/testimonial-box.css') }}">

    <!-- ICONS -->

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/icons/fontawesome/fontawesome.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/icons/linecons/linecons.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/icons/spinnericon/spinnericon.css') }}">

    <!-- WIDGETS -->

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/widgets/accordion-ui/accordion.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/widgets/calendar/calendar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/widgets/carousel/carousel.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/widgets/charts/justgage/justgage.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/widgets/charts/morris/morris.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/widgets/charts/piegage/piegage.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/widgets/charts/xcharts/xcharts.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/widgets/chosen/chosen.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/widgets/colorpicker/colorpicker.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/widgets/datatable/datatable.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/widgets/datepicker/datepicker.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/widgets/datepicker-ui/datepicker.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/widgets/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/widgets/dialog/dialog.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/widgets/dropdown/dropdown.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/widgets/dropzone/dropzone.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/widgets/file-input/fileinput.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/widgets/input-switch/inputswitch.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/widgets/input-switch/inputswitch-alt.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/widgets/ionrangeslider/ionrangeslider.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/widgets/jcrop/jcrop.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/widgets/jgrowl-notifications/jgrowl.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/widgets/loading-bar/loadingbar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/widgets/maps/vector-maps/vectormaps.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/widgets/markdown/markdown.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/widgets/modal/modal.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/widgets/multi-select/multiselect.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/widgets/multi-upload/fileupload.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/widgets/nestable/nestable.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/widgets/noty-notifications/noty.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/widgets/popover/popover.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/widgets/pretty-photo/prettyphoto.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/widgets/progressbar/progressbar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/widgets/range-slider/rangeslider.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/widgets/slider-ui/slider.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/widgets/summernote-wysiwyg/summernote-wysiwyg.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/widgets/tabs-ui/tabs.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/widgets/theme-switcher/themeswitcher.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/widgets/timepicker/timepicker.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/widgets/tocify/tocify.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/widgets/tooltip/tooltip.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/widgets/touchspin/touchspin.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/widgets/uniform/uniform.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/widgets/wizard/wizard.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/widgets/xeditable/xeditable.css') }}">

    <!-- FRONTEND WIDGETS -->

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/widgets/layerslider/layerslider.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/widgets/owlcarousel/owlcarousel.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/widgets/fullpage/fullpage.css') }}">

    <!-- SNIPPETS -->

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/snippets/chat.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/snippets/files-box.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/snippets/login-box.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/snippets/notification-box.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/snippets/progress-box.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/snippets/todo.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/snippets/user-profile.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/snippets/mobile-navigation.css') }}">

    <!-- Frontend theme -->

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/themes/frontend/layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/themes/frontend/color-schemes/default.css') }}">

    <!-- Components theme -->

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/themes/components/default.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/themes/components/border-radius.css') }}">

    <!-- Frontend responsive -->

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/helpers/responsive-elements.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/helpers/frontend-responsive.css') }}">

    <!-- JS Core -->

    <script type="text/javascript" src="{{ asset('assets/js-core/jquery-core.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js-core/jquery-ui-core.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js-core/jquery-ui-widget.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js-core/jquery-ui-mouse.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js-core/jquery-ui-position.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js-core/transition.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js-core/modernizr.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js-core/jquery-cookie.js') }}"></script>



    <script type="text/javascript">
        $(window).load(function () {
            setTimeout(function () {
                $('#loading').fadeOut(400, "linear");
            }, 300);
        });

    </script>

    <!-- Calendar -->

    <script type="text/javascript" src="{{ asset('assets/widgets/interactions-ui/resizable.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/widgets/interactions-ui/draggable.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/widgets/interactions-ui/sortable.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/widgets/interactions-ui/selectable.js') }}"></script>

    <script type="text/javascript" src="{{ asset('assets/widgets/daterangepicker/moment.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/widgets/calendar/calendar.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function () {

            $('#calendar-peminjaman-1').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                defaultDate: '{{$today}}',
                editable: false,
                events: [
                    @foreach($data_peminjaman_sukses as $peminjaman_sukses) {
                        title: '| Peminjam : {{$peminjaman_sukses->name}} | Kegiatan : {{$peminjaman_sukses->p_nama_event}}',
                        start: '{{$peminjaman_sukses->p_date}}T{{$peminjaman_sukses->p_time_start}}',
                        end: '{{$peminjaman_sukses->p_date_end}}T{{$peminjaman_sukses->p_time_end}}'
                    },
                    @endforeach
                ]
            });

        });

    </script>
</head>

<body>
    <div id="loading">
        <div class="spinner">
            <div class="bounce1"></div>
            <div class="bounce2"></div>
            <div class="bounce3"></div>
        </div>
    </div>
    <div id="page-wrapper">
        {{-- <div class="top-bar bg-topbar">
            <div class="container">
                <div class="float-left">
                </div>
                <div class="float-right user-account-btn dropdown mt-sm-5">
                    <a href="{{ url('/login') }}" title="Sistem Inventory Online"
        class="btn btn-sm float-left btn-alt btn-hover mrg10R btn-default">
        <span>Login</span>
        <i class="glyph-icon icon-arrow-right"></i>
        </a>
    </div>
    </div><!-- .container -->
    </div><!-- .top-bar --> --}}
    {{-- <nav class="navbar navbar-light bg-light">
            <div class="container">
                <div class="user-account-btn dropdown mt-5 mb-5 ">
                    <a href="{{ url('/login') }}" title="Sistem Inventory Online"
    class="btn btn-sm btn-alt btn-hover mrg10R btn-default">
    <span>Login</span>
    <i class="glyph-icon icon-arrow-right"></i>
    </a>
    <form class="form-inline my-2 my-lg-0">
        <a href="{{ url('/login') }}" title="Sistem Inventory Online"
            class="btn btn-sm btn-alt btn-hover mrg10R btn-default">
            <span>Login</span>
            <i class="glyph-icon icon-arrow-right"></i>
        </a>
    </form>
    </div>
    </div><!-- .container -->
    </nav><!-- .top-bar --> --}}

    {{-- navbar --}}
    <div class="container">
        <nav class="row navbar navbar-expand-lg navbar-light bg-white">
            <a href="{{ url('/login') }}" title="Sistem Inventory Online"
                class="btn btn-sm navbar-brand ml-auto mt-4 btn-hover mrg10R btn-default">
                <span>Login</span>
                <i class="glyph-icon icon-arrow-right"></i>
            </a>
        </nav>
    </div>

    <hr>

    {{-- <div class="main-header bg-header wow fadeInDown">
            <div class="container">
                <a href="{{ url('/') }}" class="header-logo" title="Sistem Inventory Online | STMIK AMIKBANDUNG"></a>
    <!-- .header-logo -->
    <ul class="header-nav collapse">
        <li>
            <a href="{{ url('/login') }}" title="Pinjam Barang">
                Pinjam Barang
            </a>
        </li>
    </ul><!-- .header-nav -->
    </div><!-- .container -->
    </div><!-- .main-header --> --}}

    <section class="main-header">
        <div class="container">
            <div class="row">
                <div class="col">
                    <a href="{{ url('/') }}" class="header-logo"
                        title="Sistem Inventory Online | STMIK AMIKBANDUNG"></a>
                </div>
                <div class="col pt-sm-4 align-self-center">
                    <div class="alert text-right" role="alert">
                        <a href="{{ url('/login') }}" class="alert-link" title="Pinjam Barang">Pinjam Barang</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="hero-box hero-box-smaller full-bg-13 font-inverse" data-top-bottom="background-position: 50% 0px;"
        data-bottom-top="background-position: 50% -600px;">
        <div class="container">
            <h1 class="hero-heading wow fadeInDown" data-wow-duration="0.6s">Sistem Inventory Online | STMIK
                AMIKBANDUNG</h1>
            <p class="hero-text wow bounceInUp" data-wow-duration="0.9s" data-wow-delay="0.2s">Cara mudah dan cepat
                meminjam inventaris</p>
        </div>
        <div class="hero-overlay bg-black"></div>
    </div>

    <div id="page-content" class="col-md-10 center-margin frontend-components mrg25T">
        <div class="panel">
            <div class="panel-body">
                <h3 class="title-hero">
                    Data Peminjaman Sudah Disetujui
                </h3>
                <div class="example-box-wrapper row">
                    <div id="calendar-peminjaman-1" class="col-md-10 center-margin"></div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="col-md-10">

        <!-- Sparklines charts -->

        <script type="text/javascript" src="{{ asset('assets/widgets/charts/sparklines/sparklines.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/widgets/charts/sparklines/sparklines-demo.js') }}">
        </script>

        <!-- Flot charts -->

        <script type="text/javascript" src="{{ asset('assets/widgets/charts/flot/flot.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/widgets/charts/flot/flot-resize.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/widgets/charts/flot/flot-stack.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/widgets/charts/flot/flot-pie.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/widgets/charts/flot/flot-tooltip.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/widgets/charts/flot/flot-demo-1.js') }}"></script>

        <!-- PieGage charts -->

        <script type="text/javascript" src="{{ asset('assets/widgets/charts/piegage/piegage.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/widgets/charts/piegage/piegage-demo.js') }}"></script>
    </div>
    </div>
    </div>

    <br><br>

    <div class="main-footer bg-blue clearfix">
        <div class="container clearfix">
            <div class="col-md-3 pad25R">
                <div class="header">About us</div>
                <p class="about-us">
                    Aplikasi Sistem Inventory Online
                </p>
                <div class="divider"></div>
            </div>
            <div class="col-md-4">
                <div class="header">Sitemap</div>
                <p class="about-us">
                    <a href="{{ url('/register/mahasiswa') }}">
                        Daftar Sebagai Mahasiswa
                    </a>
                </p>
                <div class="divider"></div>
                <p class="about-us">
                    <a href="{{ url('/register/oramwa') }}">
                        Daftar Sebagai ORMAWA
                    </a>
                </p>
                <div class="divider"></div>
                <p class="about-us">
                    <a href="{{ url('/register/dosen') }}">
                        Daftar Sebagai Dosen
                    </a>
                </p>
                <div class="divider"></div>
                <p class="about-us">
                    <a href="{{ url('/register/bagumum') }}">
                        Daftar Sebagai Bagian Umum
                    </a>
                </p>
                <br>
            </div>
            <div class="col-md-2">

            </div>
            <div class="col-md-3">
                <h3 class="header">Kontak kami</h3>
                <ul class="footer-contact">
                    <li>
                        <i class="glyph-icon icon-home"></i>
                        Jl Jakarta No.28, Kecamatan Batununggal Kelurahan Kebonwaru Kota Bandung </li>
                    <li>
                        <i class="glyph-icon icon-phone"></i>
                        -
                    </li>
                    <li>
                        <i class="glyph-icon icon-envelope-o"></i>
                        <a href="#" title="">info@stmik-amikbandung.ac.od</a>
                    </li>
                    <li>
                        <i class="glyph-icon icon-sites"></i>
                        <a href="#" title="">stmik-amikbandung.ac.od</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="footer-pane">
            <div class="container clearfix">
                <div class="logo">&copy; 2019</div>
                <div class="footer-nav-bottom">
                </div>
            </div>
        </div>
    </div>
    </div>


    <!-- FRONTEND ELEMENTS -->

    <!-- Skrollr -->

    <script type="text/javascript" src="{{ asset('assets/widgets/skrollr/skrollr.js') }}"></script>

    <!-- Owl carousel -->

    <script type="text/javascript" src="{{ asset('assets/widgets/owlcarousel/owlcarousel.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/widgets/owlcarousel/owlcarousel-demo.js') }}"></script>

    <!-- HG sticky -->

    <script type="text/javascript" src="{{ asset('assets/widgets/sticky/sticky.js') }}"></script>

    <!-- WOW -->

    <script type="text/javascript" src="{{ asset('assets/widgets/wow/wow.js') }}"></script>

    <!-- VideoBG -->

    <script type="text/javascript" src="{{ asset('assets/widgets/videobg/videobg.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/widgets/videobg/videobg-demo.js') }}"></script>

    <!-- Mixitup -->

    <script type="text/javascript" src="{{ asset('assets/widgets/mixitup/mixitup.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/widgets/mixitup/isotope.js') }}"></script>

    <!-- WIDGETS -->

    <!-- Bootstrap Dropdown -->

    <script type="text/javascript" src="{{ asset('assets/widgets/dropdown/dropdown.js') }}"></script>

    <!-- Bootstrap Tooltip -->

    <script type="text/javascript" src="{{ asset('assets/widgets/tooltip/tooltip.js') }}"></script>

    <!-- Bootstrap Popover -->

    <script type="text/javascript" src="{{ asset('assets/widgets/popover/popover.js') }}"></script>

    <!-- Bootstrap Progress Bar -->

    <script type="text/javascript" src="{{ asset('assets/widgets/progressbar/progressbar.js') }}"></script>

    <!-- Bootstrap Buttons -->

    <script type="text/javascript" src="{{ asset('assets/widgets/button/button.js') }}"></script>

    <!-- Bootstrap Collapse -->

    <script type="text/javascript" src="{{ asset('assets/widgets/collapse/collapse.js') }}"></script>

    <!-- Superclick -->

    <script type="text/javascript" src="{{ asset('assets/widgets/superclick/superclick.js') }}"></script>

    <!-- Input switch alternate -->

    <script type="text/javascript" src="{{ asset('assets/widgets/input-switch/inputswitch-alt.js') }}"></script>

    <!-- Slim scroll -->

    <script type="text/javascript" src="{{ asset('assets/widgets/slimscroll/slimscroll.js') }}"></script>

    <!-- Content box -->

    <script type="text/javascript" src="{{ asset('assets/widgets/content-box/contentbox.js') }}"></script>

    <!-- Overlay -->

    <script type="text/javascript" src="{{ asset('assets/widgets/overlay/overlay.js') }}"></script>

    <!-- Widgets init for demo -->

    <script type="text/javascript" src="{{ asset('assets/js-init/widgets-init.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js-init/frontend-init.js') }}"></script>

    <!-- Theme layout -->

    <script type="text/javascript" src="{{ asset('assets/themes/frontend/layout.js') }}"></script>

    <!-- Theme switcher -->

    <script type="text/javascript" src="{{ asset('assets/widgets/theme-switcher/themeswitcher.js') }}"></script>

</body>

</html>