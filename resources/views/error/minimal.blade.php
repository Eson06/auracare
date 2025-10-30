<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{ asset('dist/css/tabler.min.css') }}" rel="stylesheet" />
        <title>@yield('title')</title>
        <style>
            @import url('https://rsms.me/inter/inter.css');
            :root {
                --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
            }
            body {
                font-feature-settings: "cv03", "cv04", "cv11";
            }
          </style>
    </head>


   <body  class=" border-top-wide border-primary d-flex flex-column" style="background-image: url({{asset('images/erb.png')}});background-size: cover; background-repeat: no-repeat; background-position: center center;">
    <div class="page page-center">
      <div class="py-4">
        <div class="empty">
          @yield('message')
          @if(auth('web')->check())
            <div class="empty-action">
                <a href="{{ route('dashboard') }}" class="btn btn-primary">
                <svg  class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l14 0" /><path d="M5 12l6 6" /><path d="M5 12l6 -6" /></svg>
                Go to Dashboard
                </a>
            </div>
          @endif
        </div>
      </div>
    </div>

  </body>
</html>
