<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @vite(['resources/js/app.js'])
        <title>SIPETIK</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
        <style>
            body {
                font-family: 'Poppins', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        <header class="bg-[#173D7A] text-white py-5">
            <nav class="container mx-auto flex justify-between mb-14">
                <span class="flex space-x-8">
                    <a href="#"><img src="" alt="SIPETIK"></a>
                    <a href="#">BERANDA</a>
                    <a href="#">TENTANG PETIK</a>
                    <a href="#">LAPORAN</a>
                </span>
                <span class="flex space-x-8 items-center">
                    <a href="{{ route('login') }}" class="font-semibold">MASUK</a>
                    <a href="{{ route('register') }}" class="bg-[#FC2947] px-5 py-1 border-2 rounded-lg font-semibold">DAFTAR</a>
                </span>
            </nav>
            <h1 class="text-center text-3xl font-bold mb-5 leading-normal">Layanan Pengaduan <br> UPT TIK Universitas Negeri Gorontalo</h1>
            <p class="text-center text-lg font-base mb-10">Sampaikan keluhan anda terkait masalah layanan UPT TIK Universitas Negeri Gorontalo</p>
        </header>
        <section class="flex justify-center bg-[url('/assets/bg1.png')] bg-no-repeat bg-top bg-contain">
            <div class="w-2/5 border p-7 bg-white rounded-sm shadow-xl">
                <div class="bg-[#002979] mb-3">
                    <h3 class="text-center text-white py-3 text-lg font-semibold rounded-sm">Sampaikan Keluhan Anda</h3>
                </div>
                <div class="flex justify-between space-x-2 mb-4">
                    <button class="basis-1/3 text-[#FC2947] font-semibold py-2 border-2 border-[#FC2947] rounded">Permintaan</button>
                    <button class="basis-1/3 text-white font-semibold py-2 border-2 border-[#FC2947] rounded bg-[#FC2947]">Pengaduan</button>
                    <button class="basis-1/3 text-[#FC2947] font-semibold py-2 border-2 border-[#FC2947] rounded">Saran</button>
                </div>
                <div class="text-center">
                    <input type="text" class="w-full rounded border-2 border-[#D9D9D9] text-xs py-3 px-6 font-semibold placeholder:text-[#B1A6A6] mb-2" placeholder="Judul Pengaduan">
                    <select name="kategori_pengaduan" id="kategori_pengaduan" class="w-full rounded border-2 border-[#D9D9D9] text-xs py-3 px-6 font-semibold mb-2">
                        <option class="text-[#B1A6A6]" hidden>Kategori Pengaduan</option>
                        <option value="Kategori A">Kategori A</option>
                        <option value="Kategori B">Kategori B</option>
                        <option value="Kategori C">Kategori C</option>
                    </select>
                    <textarea name="isi_pengaduan" id="isi_pengaduan" cols="30" rows="10" class="w-full rounded border-2 border-[#D9D9D9] text-xs py-3 px-6 font-semibold placeholder:text-[#B1A6A6] mb-2" placeholder="Isi Aduan"></textarea>
                    <input type="date" class="w-full rounded border-2 border-[#D9D9D9] text-xs py-3 px-6 font-semibold placeholder:text-[#B1A6A6] mb-2" placeholder="Tanggal Aduan">
                    <input type="file" class="w-full rounded border-2 border-[#D9D9D9] text-xs py-3 px-6 font-semibold placeholder:text-[#B1A6A6] mb-2
                        file:mr-4
                        file:border-0
                        file:bg-white
                        file:text-sm file:font-semibold
                    ">
                    <button class="bg-[#FC2947] px-5 py-2 rounded-xl font-semibold text-white">LAPOR!!!</button>
                </div>
            </div>
        </section>
        <section class="mt-40"></section>
    </body>
</html>
