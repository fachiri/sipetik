<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/js/app.js'])
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="shortcut icon" href="{{ asset('assets/icon.png') }}" type="image/x-icon">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
      body {
        font-family: 'Poppins', sans-serif;
      }

      .tab-btn-landing.active{
        background-color: #FC2947;
        color: #fff;
      }

      .tab-btn-report.active{
        background-color: #fff;
        color: #173D7A;
        border-bottom: none;
        border-bottom-left-radius: 0;
        border-bottom-right-radius: 0;
      }
    </style>
  </head>
  <body class="antialiased">
    <header class="bg-[#173D7A] text-white py-5 pb-14 relative">
      <nav class="container mx-auto px-5 md:px-20 flex justify-between items-center">
        <div class="flex space-x-8">
          <a href="{{ route('home') }}" class="font-medium"><img src="{{ asset('assets/logo-putih.png') }}" alt="SIPETIK" class="h-10"></a>
          <span id="nav-content" class="hidden md:flex space-x-8 items-center">
            <a href="{{ route('home') }}" class="font-medium">BERANDA</a>
            <a href="{{ route('about') }}" class="font-medium">TENTANG PETIK</a>
            <a href="{{ route('report') }}" class="font-medium">LAPORAN</a>
            <span class="flex md:hidden space-x-5 items-center justify-between pt-2 pb-3">
              <a href="{{ route('login') }}" class="basis-1/2 text-center font-semibold py-1 border-2 rounded-lg">MASUK</a>
              <a href="{{ route('register') }}" class="basis-1/2 text-center bg-[#FC2947] py-1 border-2 rounded-lg font-semibold">DAFTAR</a>
            </span>
          </span>
        </div>
        <span class="hidden md:flex space-x-8 items-center">
          <a href="{{ route('login') }}" class="font-semibold">MASUK</a>
          <a href="{{ route('register') }}" class="bg-[#FC2947] px-5 py-1 border-2 rounded-lg font-semibold">DAFTAR</a>
        </span>
        <button id="nav-btn" class="md:hidden">
          <img src="{{ asset('assets/icon-bar.svg') }}" alt="Icon Bar">
        </button>
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
      const navBtn = document.getElementById("nav-btn");
      const navContent = document.getElementById("nav-content");
    
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

      navBtn.addEventListener('click', () => {
        navContent.classList.toggle("hidden");
        navContent.classList.toggle("absolute");
        navContent.classList.toggle("flex");
        navContent.classList.toggle("flex-col");
        navContent.classList.toggle("space-x-8");
        navContent.classList.toggle("space-y-3");
        navContent.classList.toggle("items-center");
        navContent.classList.toggle("w-full");
        navContent.classList.toggle("top-20");
        navContent.classList.toggle("-left-8");
        navContent.classList.toggle("px-5");
        navContent.classList.toggle("py-3");
        navContent.classList.toggle("bg-[#173D7A]");
        navContent.classList.toggle("border-b-2");
      })
    </script>          
  </body>
</html>
