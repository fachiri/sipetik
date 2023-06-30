<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @vite(['resources/js/app.js'])
        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
        <style>
            body {
                font-family: 'Poppins', sans-serif;
            }

            .tab-btn.active{
                background-color: #FC2947;
                color: #fff;
            }
        </style>
    </head>
    <body class="antialiased">
      <header class="bg-[#173D7A] text-white py-5 pb-14">
          <nav class="container mx-auto px-20 flex justify-between">
              <span class="flex space-x-8 items-center">
                  <a href="{{ route('home') }}"><img src="{{ asset('assets/logo-putih.png') }}" alt="SIPETIK" class="h-10"></a>
                  <a href="{{ route('home') }}">BERANDA</a>
                  <a href="{{ route('about') }}">TENTANG PETIK</a>
                  <a href="{{ route('report') }}">LAPORAN</a>
              </span>
              <span class="flex space-x-8 items-center">
                  <a href="{{ route('login') }}" class="font-semibold">MASUK</a>
                  <a href="{{ route('register') }}" class="bg-[#FC2947] px-5 py-1 border-2 rounded-lg font-semibold">DAFTAR</a>
              </span>
          </nav>
      </header>
      {{ $slot }}
      <footer>
          <div class="h-5 bg-[#FC2947]"></div>
          <div class="bg-[#173D7A] text-center py-8">
              <p class="text-white">Copyright &#169; 2023 <a href="#" class="font-bold">JEJAKODE INDONESIA</a></p>
          </div>
      </footer>

      <script>
        const buttons = document.querySelectorAll('.tab-btn');
        const contents = document.querySelectorAll('.tab-content');
      
        buttons.forEach((button) => {
          button.addEventListener('click', () => {
            // Menghapus kelas 'active' dari semua tombol
            buttons.forEach((btn) => {
              btn.classList.remove('active');
            });
      
            // Menambahkan kelas 'active' ke tombol yang diklik
            button.classList.add('active');
      
            // Menampilkan konten yang sesuai dan menyembunyikan yang lainnya
            const targetContentId = button.id.replace('tab', 'content');
            contents.forEach((content) => {
              if (content.id === targetContentId) {
                content.classList.remove('hidden');
              } else {
                content.classList.add('hidden');
              }
            });
          });
        });
      </script>          
    </body>
</html>
