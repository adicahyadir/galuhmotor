<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()"  lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name') }}</title>

        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="{{ asset('assets/css/tailwind.output.css') }}" />
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
        <script src="{{ asset('assets/js/init-alpine.js') }}"></script>
        <style>
            #loader {
              transition: all 0.3s ease-in-out;
              opacity: 1;
              visibility: visible;
              position: fixed;
              height: 100vh;
              width: 100%;
              background: #fff;
              z-index: 90000;
            }
      
            #loader.fadeOut {
              opacity: 0;
              visibility: hidden;
            }
      
            .spinner {
              width: 40px;
              height: 40px;
              position: absolute;
              top: calc(50% - 20px);
              left: calc(50% - 20px);
              background-color: #333;
              border-radius: 100%;
              -webkit-animation: sk-scaleout 1.0s infinite ease-in-out;
              animation: sk-scaleout 1.0s infinite ease-in-out;
            }
      
            @-webkit-keyframes sk-scaleout {
              0% { -webkit-transform: scale(0) }
              100% {
                -webkit-transform: scale(1.0);
                opacity: 0;
              }
            }
      
            @keyframes sk-scaleout {
              0% {
                -webkit-transform: scale(0);
                transform: scale(0);
              } 100% {
                -webkit-transform: scale(1.0);
                transform: scale(1.0);
                opacity: 0;
              }
            }
        </style>

        <!-- Fonts -->
        {{-- <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap"> --}}

        <!-- Styles -->
        {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body>
        <div id='loader'>
            <div class="spinner"></div>
        </div>
        <script>
            window.addEventListener('load', function load() {
                const loader = document.getElementById('loader');
                setTimeout(function() {
                    loader.classList.add('fadeOut');
                }, 300);
            });
        </script>
        <div class="flex items-center min-h-screen p-6 bg-gray-50 dark:bg-gray-900">
			<div class="flex-1 h-full max-w-4xl mx-auto overflow-hidden bg-white rounded-lg shadow-xl dark:bg-gray-800">
                <div class="flex flex-col overflow-y-auto md:flex-row">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>
