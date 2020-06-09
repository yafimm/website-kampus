<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        /* Loading Spinner */
        .spinner {
            margin: 0;
            width: 70px;
            height: 18px;
            margin: -35px 0 0 -9px;
            position: absolute;
            top: 50%;
            left: 50%;
            text-align: center
        }

        .spinner>div {
            width: 18px;
            height: 18px;
            background-color: #333;
            border-radius: 100%;
            display: inline-block;
            -webkit-animation: bouncedelay 1.4s infinite ease-in-out;
            animation: bouncedelay 1.4s infinite ease-in-out;
            -webkit-animation-fill-mode: both;
            animation-fill-mode: both
        }

        .spinner .bounce1 {
            -webkit-animation-delay: -.32s;
            animation-delay: -.32s
        }

        .spinner .bounce2 {
            -webkit-animation-delay: -.16s;
            animation-delay: -.16s
        }

        @-webkit-keyframes bouncedelay {

            0%,
            80%,
            100% {
                -webkit-transform: scale(0.0)
            }

            40% {
                -webkit-transform: scale(1.0)
            }
        }

        @keyframes bouncedelay {

            0%,
            80%,
            100% {
                transform: scale(0.0);
                -webkit-transform: scale(0.0)
            }

            40% {
                transform: scale(1.0);
                -webkit-transform: scale(1.0)
            }
        }
    </style>

    <meta charset="UTF-8">
    <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
    <title> Sistem Inventory Online | STMIK AMIKBANDUNG </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <!-- Favicons -->
    <link rel="shortcut icon" href="{{ asset('assets/images-resource/favicon.ico') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/bootstrap/css/bootstrap.css') }}">

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



    <!-- ICONS -->

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/icons/fontawesome/fontawesome.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/icons/linecons/linecons.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/icons/typicons/typicons.css') }}">
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
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/widgets/slidebars/slidebars.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/widgets/slider-ui/slider.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/widgets/summernote-wysiwyg/summernote-wysiwyg.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/widgets/tabs-ui/tabs.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/widgets/theme-switcher/themeswitcher.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/widgets/timepicker/timepicker.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/widgets/tocify/tocify.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/widgets/tooltip/tooltip.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/widgets/touchspin/touchspin.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/widgets/uniform/uniform.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/widgets/wizard/wizard.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/widgets/xeditable/xeditable.css') }}">

    <!-- SNIPPETS -->

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/snippets/chat.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/snippets/files-box.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/snippets/login-box.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/snippets/notification-box.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/snippets/progress-box.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/snippets/todo.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/snippets/user-profile.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/snippets/mobile-navigation.css') }}">

    <!-- APPLICATIONS -->

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/applications/mailbox.css') }}">

    <!-- Admin theme -->

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/themes/admin/layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/themes/admin/color-schemes/default.css') }}">

    <!-- Components theme -->

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/themes/components/default.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/themes/components/border-radius.css') }}">

    <!-- Admin responsive -->

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/helpers/responsive-elements.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/helpers/admin-responsive.css') }}">

    <!-- JS Core -->
    <script type="text/javascript" src="{{ asset('assets/js-core/jquery-core.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js-core/jquery-ui-core.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js-core/jquery-ui-widget.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js-core/jquery-ui-mouse.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js-core/jquery-ui-position.js') }}"></script>
    <!--<script type="text/javascript" src="{{ asset('assets/js-core/transition.js') }}"></script>-->
    <script type="text/javascript" src="{{ asset('assets/js-core/modernizr.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js-core/jquery-cookie.js') }}"></script>


    <script type="text/javascript">
        $(window).load(function () {
            setTimeout(function () {
                $('#loading').fadeOut(400, "linear");
            }, 300);
        });
    </script>


</head>

<body>
    <div id="sb-site">

        <div id="loading">
            <div class="spinner">
                <div class="bounce1"></div>
                <div class="bounce2"></div>
                <div class="bounce3"></div>
            </div>
        </div>

        <div id="page-wrapper">
            <div id="page-header" class="bg-blue">
                <div id="mobile-navigation">
                    <button id="nav-toggle" class="collapsed" data-toggle="collapse"
                        data-target="#page-sidebar"><span></span></button>
                </div>
                <div id="header-logo" class="logo-bg">
                    <a href="#" class="logo-content-big" title="Sistem Inventory Online">
                    </a>
                    <a id="close-sidebar" href="#" title="Close sidebar">
                        <i class="glyph-icon icon-angle-left"></i>
                    </a>
                </div>
                <div id="header-nav-left">
                    <div class="user-account-btn dropdown">
                        <a href="#" title="My Account" class="user-profile clearfix" data-toggle="dropdown">
                            <img width="28" src="{{ asset('assets/images-resource/user.png') }}" alt="Profile image">
                            <span>{{Auth::user()->name}}</span>
                            <i class="glyph-icon icon-angle-down"></i>
                        </a>
                        <div class="dropdown-menu float-left">
                            <div class="box-sm">
                                <div class="login-box clearfix">
                                    <div class="user-img">
                                        <img src="{{ asset('assets/images-resource/user.png') }}" alt="">
                                    </div>
                                    <div class="user-info">
                                        <span style="color:#000">
                                            {{Auth::user()->name}}
                                            <i>{{Auth::user()->role}}</i>
                                        </span>
                                    </div>
                                </div>
                                <div class="pad5A button-pane button-pane-alt text-center">
                                    <a href="{{ url('/logout') }}" class="btn display-block font-normal btn-primary">
                                        <i class="glyph-icon icon-power-off"></i>
                                        Logout
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- #header-nav-left -->

                <div id="header-nav-right">

                </div><!-- #header-nav-right -->

            </div>
            @include('template.sidebar')
            <div id="page-content-wrapper">
              <div id="page-content">
                @include('_partial.flash_message')
                @yield('content')
              </div>
            </div>
        </div>


        <!-- WIDGETS -->

        <script type="text/javascript" src="{{ asset('assets/bootstrap/js/bootstrap.js') }}"></script>

        <!-- Bootstrap Dropdown -->

        <!-- <script type="text/javascript" src="{{ asset('assets/widgets/dropdown/dropdown.js') }}"></script> -->

        <!-- Bootstrap Tooltip -->

        <!-- <script type="text/javascript" src="{{ asset('assets/widgets/tooltip/tooltip.js') }}"></script> -->

        <!-- Bootstrap Popover -->

        <!-- <script type="text/javascript" src="{{ asset('assets/widgets/popover/popover.js') }}"></script> -->

        <!-- Bootstrap Progress Bar -->

        <script type="text/javascript" src="{{ asset('assets/widgets/progressbar/progressbar.js') }}"></script>

        <!-- Bootstrap Buttons -->

        <!-- <script type="text/javascript" src="{{ asset('assets/widgets/button/button.js') }}"></script> -->

        <!-- Bootstrap Collapse -->

        <!-- <script type="text/javascript" src="{{ asset('assets/widgets/collapse/collapse.js') }}"></script> -->

        <!-- Superclick -->

        <script type="text/javascript" src="{{ asset('assets/widgets/superclick/superclick.js') }}"></script>

        <!-- Input switch alternate -->

        <script type="text/javascript" src="{{ asset('assets/widgets/input-switch/inputswitch-alt.js') }}"></script>

        <!-- Slim scroll -->

        <script type="text/javascript" src="{{ asset('assets/widgets/slimscroll/slimscroll.js') }}"></script>

        <!-- Slidebars -->

        <script type="text/javascript" src="{{ asset('assets/widgets/slidebars/slidebars.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/widgets/slidebars/slidebars-demo.js') }}"></script>

        <!-- PieGage -->

        <script type="text/javascript" src="{{ asset('assets/widgets/charts/piegage/piegage.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/widgets/charts/piegage/piegage-demo.js') }}"></script>

        <!-- Screenfull -->

        <script type="text/javascript" src="{{ asset('assets/widgets/screenfull/screenfull.js') }}"></script>

        <!-- Content box -->

        <script type="text/javascript" src="{{ asset('assets/widgets/content-box/contentbox.js') }}"></script>

        <!-- Overlay -->

        <script type="text/javascript" src="{{ asset('assets/widgets/overlay/overlay.js') }}"></script>

        <!-- Widgets init for demo -->

        <script type="text/javascript" src="{{ asset('assets/js-init/widgets-init.js') }}"></script>

        <!-- Theme layout -->

        <script type="text/javascript" src="{{ asset('assets/themes/admin/layout.js') }}"></script>

        <!-- Theme switcher -->

        <script type="text/javascript" src="{{ asset('assets/widgets/theme-switcher/themeswitcher.js') }}"></script>

        <script type="text/javascript" src="{{ asset('js/yaff_helper.js') }}"></script>
    </div>
</body>

</html>
