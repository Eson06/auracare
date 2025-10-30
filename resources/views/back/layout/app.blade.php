<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" /> 
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title> @yield('pageTitle') | CNHS PORTAL</title>
    <link rel="icon" href="{{asset('images/cnhs_logo.png')}}" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <link href="{{ asset('dist/css/tabler.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('dist/css/tabler-vendors.min.css') }}" rel="stylesheet" />
    <script data-navigate-once src="{{ asset('dist/js/tabler.min.js') }}"></script>
    <link rel="manifest" href="{{ asset('/manifest.json') }}">
    <script src="{{ asset('/sw.js') }}"></script>

    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.css') }}">
    <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>

    <link rel="manifest" href="/manifest.json">
<meta name="theme-color" content="#000000">

<!-- For iOS support -->
<link rel="apple-touch-icon" href="/images/cnhs_logo.png">
<meta name="apple-mobile-web-app-capable" content="yes">


    @livewireStyles
    @stack('stylesheets')
    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }
        #btn-back-to-top {
            position: fixed;
            bottom: 65px;
            right: 15px;
            display: none;
        }

        .loading-page {
            background-color: #000;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 9999;
            display: flex;
            justify-content:  center;
            align-items: center;
            opacity: 50%;
        }



    </style>

</head>



<body class="layout-fluid" style="background-image: url({{asset('images/erb.png')}});background-size: cover; background-repeat: no-repeat; background-position: center center; background-attachment: fixed; ">


    <a href="#" class="bg-primary btn-floating p-2" aria-label="Button" id="btn-back-to-top">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-up text-white" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
            <path d="M6 15l6 -6l6 6"></path>
         </svg>
      </a>


    <div class="page">
        @if(auth('web')->check())
            @livewire('include.sidebar')
            @livewire('include.header')
        @endif
        <div class="page-wrapper">



            <div class="page-body">
                <div class="container-xl" >

                    {{$slot }}

                </div>
            </div>
            @include('back.layout.include.footer')
        </div>
    </div>


    <script data-navigate-once>
        if ("serviceWorker" in navigator) {
            navigator.serviceWorker.register("/sw.js").then(
                (registration) => {
                    console.log("PWA is now fully prepared for use!");
                },
                (error) => {
                    console.error(`Service worker registration failed: ${error}`);
                },
			);
		} else {
			 console.error("Service workers are not supported.");
		}
        document.addEventListener('livewire:navigated', () => {
            window.addEventListener('showToastr', function(){
                toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": true,
                    "onclick": null,
                    "showDuration": "600",
                    "hideDuration": "1500",
                    "timeOut": "2000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "slideDown",
                    "hideMethod": "slideUp"
                }

                if(event.detail.type === 'info') {
                    toastr.info(
                        event.detail.message
                    );
                }else if(event.detail.type === 'success') {
                    toastr.success(
                        event.detail.message
                    );
                }else if(event.detail.type === 'error') {
                    toastr.error(
                        event.detail.message
                    );
                }else if(event.detail.type === 'warning') {
                    toastr.warning(
                        event.detail.message
                    );
                }else {
                return false;
                }
            });

            let mybutton = document.getElementById("btn-back-to-top");

            window.onscroll = function () {
            scrollFunction();
            };

            function scrollFunction() {
                if (
                    document.body.scrollTop > 20 ||
                    document.documentElement.scrollTop > 20
                ) {
                    mybutton.style.display = "block";
                } else {
                    mybutton.style.display = "none";
                }
            }

            mybutton.addEventListener("click", backToTop);

            function backToTop() {
                document.body.scrollTop = 0;
                document.documentElement.scrollTop = 0;
            }
        })
    </script>
    @livewireScripts
    @stack('scripts')
</body>

</html>
