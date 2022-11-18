<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
        <link rel="icon" href="/favicon.ico" type="image/x-icon">
        
        
        <title>{{ config('app.name', 'Laravel') }}</title>
        
        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
        
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @livewireStyles
    </head>
    <body>
        <div class="mt-5 grid grid-cols-7 place-content-center min-h-screen bg-gray-50 place-items-center">
            <div class="col-start-4 col-span-1 ">
                <span>
                    <x-jet-application-logo></x-jet-application-logo>
                </span>
            </div>
            <div class="col-start-2 col-span-5">
              <span class="z-10 leading-snug font-normal absolute text-center text-blueGray-300 bg-transparent rounded text-base items-center justify-center w-8 pl-2 py-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
              </span>
              <div class="flex justify-between">
                <input type="search" name="search" id="search" v-model="searchTerm" placeholder="Encuentra tu documento..." class="px-2 text-md border-gray-400 rounded-l text-lg pl-11 py-1 shadow-sm float-left w-full border" />
                <button type="submit" class="w-24 flex items-center justify-center bg-gray-100 text-lg py-1 border-t border-r border-b border-gray-400 rounded-r text-gray-600">Buscar</button>
              </div>
            </div>
          </div>



        @stack('modals')

        @livewireScripts
    </body>
</html>
