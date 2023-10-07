@php
	// $links = [
	// [
	// "href" => "dashboard",
	// "text" => "Dashboard",
	// "is_multi" => false,
	// ],
	// [
	// "href" => [
	// [
	// "section_text" => "User",
	// "section_list" => [
	// ["href" => "user", "text" => "Data User"],
	// ["href" => "user.new", "text" => "Buat User"]
	// ]
	// ]
	// ],
	// "text" => "User",
	// "is_multi" => true,
	// ],
	// ];
	// $navigation_links = array_to_object($links);
	$links = [
	    [
	        'href' => 'dashboard',
	        'text' => 'Dashboard',
	        'is_header' => false,
	    ],
	    [
	        'href' => 'pengaduan',
	        'text' => 'Pengaduan',
	        'is_header' => false,
	    ],
	];
	$navigation_links = array_to_object($links);
@endphp

<div class="main-sidebar z-40">
	<aside id="sidebar-wrapper">
		<div class="sidebar-brand">
			<a href="{{ route('dashboard') }}">SIPETIK</a>
		</div>
		<div class="sidebar-brand sidebar-brand-sm">
			<a href="{{ route('dashboard') }}">
				<img class="d-inline-block" width="32px" height="30.61px" src="" alt="">
			</a>
		</div>
		<ul class="sidebar-menu">
			<li class="menu-header">Dashboard</li>
			<li class="{{ Request::routeIs('dashboard') ? 'active' : '' }}">
				<a class="nav-link" href="{{ route('dashboard') }}"><i class="fas fa-home"></i><span>Dashboard</span></a>
			</li>
			<li class="menu-header">Monitoring</li>
			<li class="{{ Request::routeIs('pengaduan') ? 'active' : '' }}">
				<a class="nav-link" href="{{ route('pengaduan') }}"><i class="fas fa-bullhorn"></i><span>Pengaduan</span></a>
			</li>
			<li class="{{ Request::routeIs('permintaan') ? 'active' : '' }}">
				<a class="nav-link" href="{{ route('permintaan') }}"><i class="fas fa-hand-paper"></i><span>Permintaan</span></a>
			</li>
			@if (auth()->user()->role != 'TEKNISI')
				<li class="{{ Request::routeIs('saran') ? 'active' : '' }}">
					<a class="nav-link" href="{{ route('saran') }}"><i class="fas fa-envelope-open-text"></i><span>Saran</span></a>
				</li>
			@endif
			@if (auth()->user()->role == 'KABID' || auth()->user()->role == 'ADMIN')
				<li class="menu-header">Lainnya</li>
				<li class="{{ Request::routeIs('pengguna') ? 'active' : '' }}">
					<a class="nav-link" href="{{ route('user') }}"><i class="fas fa-user-plus"></i>
						<span>{{ auth()->user()->role == 'KABID' ? 'Teknisi' : 'Pengguna' }}</span>
					</a>
				</li>
				<li class="{{ Request::routeIs('laporan') ? 'active' : '' }}">
					<a class="nav-link" href="{{ route('laporan') }}"><i class="fas fa-file-alt"></i><span>Laporan</span></a>
				</li>
                <li class="{{ Request::routeIs('feedback') ? 'active' : '' }}">
					<a class="nav-link" href="{{ route('feedback.index') }}"><i class="fas fa-smile"></i><span>Feedback</span></a>
				</li>
			@endif
		</ul>
	</aside>
</div>
