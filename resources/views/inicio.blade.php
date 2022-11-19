@extends('layouts.app-public')

@section('content')
    

      <div class="relative overflow-hidden">
            <div class="bg-white pt-4 pb-14 sm:pt-16 lg:overflow-hidden lg:pt-24 lg:pb-24">
              <div class="mx-auto max-w-5xl lg:px-8">
                <div class="lg:grid lg:grid-cols-2 lg:gap-8">
                  <div class="mx-auto max-w-md px-4 text-center sm:max-w-2xl sm:px-6 lg:flex lg:items-center lg:px-0 lg:text-left">
                    <div class="lg:py-24">
                      <h1 class="mt-4 text-4xl font-bold tracking-tight text-black sm:mt-5 sm:text-6xl lg:mt-6 xl:text-6xl"><span class="block text-pink-500">Repositorio </span><span class="block text-black">de Documentos</span></h1>
                      <p class="mt-3 text-base text-gray-400 sm:mt-5 sm:text-xl lg:text-lg xl:text-xl">Tesis, seminarios, investigaciones, revistas y más, todo de la facultad de Ciencias Exactas de la UNSa</p>
                      <div class="mt-10 sm:mt-12">
          
                          <!-- This is a working waitlist form. Create your access key from https://web3forms.com/s to setup.  -->
                        <form class="sm:mx-auto sm:max-w-xl lg:mx-0">
                          <div class="sm:flex">
                            <div class="min-w-0 flex-1"><label for="search" class="sr-only">busqueda</label><input id="search" type="text" placeholder="Encuentra tu documento" class="block w-full rounded-md border-0 bg-gray-200 px-4 py-3 text-base text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-400" value="" autocomplete="off" /></div>
                            <div class="mt-3 sm:mt-0 sm:ml-3"><button type="submit" class="block w-full rounded-md bg-pink-500 py-3 px-4 font-medium text-white shadow hover:bg-pink-400 focus:outline-none focus:ring-2 focus:ring-blue-300 focus:ring-offset-2 focus:ring-offset-gray-900">Buscar</button></div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <div class="mt-12 hidden lg:block"><img class="" src="https://cdn.pixabay.com/photo/2018/04/24/11/32/book-3346785_640.png" alt="libros apilados" /></div>
                </div>
              </div>
            </div>
          </div>

@endsection