<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<title>{{ config('app.name', 'Laravel') }}</title>
		<link rel="shortcut icon" href="{{ asset('assets/icon.png') }}" type="image/x-icon">
		@vite(['resources/js/app.js'])
		<!-- Fonts -->
		<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
		{{-- Noty --}}
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noty/3.1.4/noty.min.css" integrity="sha512-0p3K0H3S6Q4bEWZ/WmC94Tgit2ular2/n0ESdfEX8l172YyQj8re1Wu9s/HT9T/T2osUw5Gx/6pAZNk3UKbESw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
		<script src="https://cdnjs.cloudflare.com/ajax/libs/noty/3.1.4/noty.min.js" integrity="sha512-lOrm9FgT1LKOJRUXF3tp6QaMorJftUjowOWiDcG5GFZ/q7ukof19V0HKx/GWzXCdt9zYju3/KhBNdCLzK8b90Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
		{{-- Fontowesome --}}
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
		{{-- jquery --}}
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
		<style>
			body {
				font-family: 'Poppins', sans-serif;
			}

			.tab-btn-landing.active {
				background-color: #FC2947;
				color: #fff;
			}

			.tab-btn-report.active {
				background-color: #fff;
				color: #173D7A;
				border-bottom: none;
				border-bottom-left-radius: 0;
				border-bottom-right-radius: 0;
			}
		</style>
	</head>

	<body class="antialiased">
		@if (session('showFeedback'))
			<x-rate />
		@endif

		<header class="relative bg-[#CB004A] py-3 text-white">
			<nav class="container mx-auto flex items-center justify-between px-5 md:px-20">
				<div class="flex space-x-8">
					<a href="{{ route('home') }}" class="font-medium"><img src="{{ asset('assets/logo-putih.png') }}" alt="SIPETIK" class="h-10"></a>
					<span id="nav-content" class="hidden items-center space-x-8 md:flex">
						<a href="{{ route('home') }}" class="text-reset {{ request()->routeIs('home') ? 'font-bold' : '' }} font-medium">BERANDA</a>
						<a href="{{ route('about') }}" class="text-reset {{ request()->routeIs('about') ? 'font-bold' : '' }} font-medium">TENTANG PETIK</a>
						<a href="{{ route('report') }}" class="text-reset {{ request()->routeIs('report') ? 'font-bold' : '' }} font-medium">
							MONITORING
							<span id="total-chat"></span>
						</a>
						<span class="flex items-center justify-between space-x-5 pb-3 pt-2 md:hidden">
							@guest
								<a href="{{ route('login') }}" class="text-reset basis-1/2 rounded-lg border-2 py-1 text-center font-semibold">MASUK</a>
								<a href="{{ route('register') }}" class="text-reset basis-1/2 rounded-lg border-2 bg-[#FC2947] py-1 text-center font-semibold">DAFTAR</a>
							@endguest
							@auth
								@if (auth()->user()->role == 'PENGGUNA')
									<form method="POST" action="{{ route('logout') }}" class="basis-full">
										@csrf
										<a href="{{ route('logout') }}" class="text-reset rounded-lg border-2 px-5 py-1 font-semibold" onclick="event.preventDefault();this.closest('form').submit();">
											<i class="fas fa-sign-out-alt"></i> Logout
										</a>
									</form>
								@else
									<a href="{{ route('dashboard') }}" class="text-reset rounded-lg border-2 px-5 py-1 font-semibold">
										Dashboard
									</a>
								@endif
							@endauth
						</span>
					</span>
				</div>
				@auth
					<div class="hidden md:block">
						@if (auth()->user()->role == 'PENGGUNA')
							<form method="POST" action="{{ route('logout') }}">
								@csrf
								<a href="{{ route('logout') }}" class="text-reset rounded-lg border-2 px-5 py-1 font-semibold" onclick="event.preventDefault();this.closest('form').submit();">
									<i class="fas fa-sign-out-alt"></i>
									Logout
								</a>
							</form>
						@else
							<a href="{{ route('dashboard') }}" class="text-reset rounded-lg border-2 px-5 py-1 font-semibold">
								Dashboard
							</a>
						@endif
					</div>
				@endauth
				@guest
					<span class="hidden items-center space-x-8 md:flex">
						<a href="{{ route('login') }}" class="text-reset font-semibold">MASUK</a>
						<a href="{{ route('register') }}" class="text-reset rounded-lg border-2 bg-[#FC2947] px-5 py-1 font-semibold">DAFTAR</a>
					</span>
				@endguest
				<button id="nav-btn" class="md:hidden">
					<img src="{{ asset('assets/icon-bar.svg') }}" alt="Icon Bar">
				</button>
			</nav>
		</header>

		{{ $slot }}

		<footer>
			<div class="h-5 bg-[#FC2947]"></div>
			<div class="bg-[#173D7A] py-8 text-center">
				<p class="text-white">Copyright &#169; 2023 <a href="#" class="font-bold">SIPETIK V.1</a></p>
			</div>
		</footer>

		<script src="{{ asset('stisla/js/modules/bootstrap.min.js') }}"></script>

		@if (session('success'))
			<script>
				new Noty({
					type: 'success',
					text: @json(session('success')),
					timeout: 2000,
				}).show();
			</script>
		@endif

		@if (session('error'))
			<script>
				new Noty({
					type: 'error',
					text: @json(session('error')),
					timeout: 2000,
				}).show();
			</script>
		@endif

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

		@if (auth()->user() !== null)
			<script>
				fetch(`${@json(route('chat.total', ['userId' => auth()->user()->id]))}`, {
						method: 'GET',
					})
					.then((response) => {
						if (!response.ok) {
							throw new Error('Network response was not ok');
						}
						return response.json();
					})
					.then((data) => {
						let count = 0
						data.forEach(report => {
							report.chat.forEach(chat => {
								if (chat.read_status === 0) count++
							});
						});
						if (count > 0) {
							$('#total-chat').html(`<span class="bg-white text-red-500 px-1 text-sm rounded ml-1">${count}</span>`)
						}
					})
					.catch((error) => {
						console.error('There was a problem with the fetch operation:', error);
					});
			</script>
		@endif

	</body>

</html>
