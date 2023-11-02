<x-app-layout>
	<x-slot name="header_content">
        <h1>Saran</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active">Monitoring</div>
            <div class="breadcrumb-item">Saran</div>
        </div>
    </x-slot>

	<div class="overflow-hidden bg-white p-3 sm:p-4 shadow-xl sm:rounded-lg">
		@if ($categories && auth()->user()->role == 'ADMIN')
			<div class="mb-4 flex flex-col space-y-2 text-center md:flex-row md:space-x-3 md:space-y-0">
				@foreach ($categories as $category)
					<a href="?kategori={{ $category->name }}" class="tab-btn tab-btn-saran {{ request('kategori') == $category->name ? 'active' : '' }} rounded-lg border-2 border-[#002979] px-3 py-2 font-bold text-[#002979]">{{ $category->name }}</a>
				@endforeach
			</div>
		@endif
		<div class="table-responsive hidden sm:block">
			<table class="table-striped table" id="table">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama</th>
						<th>Judul</th>
						<th>Status</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($reports as $report)
						<tr>
							<td>{{ $loop->iteration }}</td>
							<td>{{ $report->user->name }}</td>
							<td>{{ $report->judul }}</td>
							<td class="whitespace-nowrap">
								@php
									$count = 0;
									foreach ($report->chat as $chat) {
									    if ($chat->read_status === 0) {
									        $count++;
									    }
									}
									$status = $report->history[count($report->history) - 1]->status;
									if ($report->kategori && $status === 'Tulis Laporan') {
									    $status = 'Disposisi';
									}
									$textColor = '';

									switch ($status) {
									    case 'Disposisi':
									        $bgColor = 'bg-[#173D7A]';
									        $textColor = 'text-slate-100';
									        break;
									    case 'Tulis Laporan':
									        $bgColor = 'bg-indigo-500';
									        $textColor = 'text-slate-100';
									        break;
									    case 'Verifikasi':
									        $bgColor = 'bg-stone-400';
									        $textColor = 'text-slate-100';
									        break;
									    case 'Proses':
									        $bgColor = 'bg-orange-500';
									        $textColor = 'text-slate-100';
									        break;
									    case 'Selesai':
									        $bgColor = 'bg-green-600';
									        $textColor = 'text-slate-100';
									        break;
									    case 'Proses Gagal':
									    case 'Verifikasi Gagal':
									        $status = '&#10060; ' . explode(' ', $status)[0];
									        $bgColor = 'bg-red-500';
									        $textColor = 'text-slate-100';
									        break;
									    default:
									        $textColor = 'text-gray-500';
									        break;
									}
								@endphp
								<small class="{{ $textColor }} {{ $bgColor }} rounded px-2 py-1 font-semibold">
									{!! $status !!}
								</small>
							</td>
							<td class="row-action--icon flex space-x-2 whitespace-nowrap">
								<a role="button" href="{{ route('saran.edit', $report->report_id) }}" class="w-6"><img src="{{ asset('assets/edit.svg') }}" alt="Icon"></a>
								<a role="button" href="{{ route('saran.detail', $report->report_id) }}" class="relative w-6">
									<img src="{{ asset('assets/detail.svg') }}" alt="Icon">
									@if ($count > 0)
										<div class="absolute -right-2 -top-2 inline-flex h-5 w-5 items-center justify-center rounded-full border-2 border-white bg-red-500 text-[.6rem] font-bold text-white dark:border-gray-900">{{ $count }}</div>
									@endif
								</a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		<div class="flex flex-col space-y-3 sm:hidden">
			@foreach ($reports as $report)
				<div class="rounded border bg-white p-3 shadow-sm">
					<div class="flex items-start justify-between">
						<div class="w-full">
							<h5 class="line-clamp-1 text-lg font-bold">{{ $report->judul }}</h5>
						</div>
						<div>
                            @php
                              $count = 0;
                              foreach ($report->chat as $chat) {
                                  if ($chat->read_status === 0) {
                                      $count++;
                                  }
                              }
                              $status = $report->history[count($report->history) - 1]->status;
                              if ($report->kategori && $status === 'Tulis Laporan') {
                                  $status = 'Disposisi';
                              }
                              $textColor = '';
              
                              switch ($status) {
                                  case 'Disposisi':
                                      $bgColor = 'bg-[#173D7A]';
                                      $textColor = 'text-slate-100';
                                      break;
                                  case 'Tulis Laporan':
                                      $bgColor = 'bg-indigo-500';
                                      $textColor = 'text-slate-100';
                                      break;
                                  case 'Verifikasi':
                                      $bgColor = 'bg-stone-400';
                                      $textColor = 'text-slate-100';
                                      break;
                                  case 'Proses':
                                      $bgColor = 'bg-orange-500';
                                      $textColor = 'text-slate-100';
                                      break;
                                  case 'Selesai':
                                      $bgColor = 'bg-green-600';
                                      $textColor = 'text-slate-100';
                                      break;
                                  case 'Proses Gagal':
                                  case 'Verifikasi Gagal':
                                      $status = '&#10060; ' . explode(' ', $status)[0];
                                      $bgColor = 'bg-red-500';
                                      $textColor = 'text-slate-100';
                                      break;
                                  default:
                                      $textColor = 'text-gray-500';
                                      break;
                              }
                            @endphp
                            <small class="{{ $textColor }} {{ $bgColor }} whitespace-nowrap rounded px-2 py-1 font-semibold">
                              {!! $status !!}
                            </small>
                          </div>
					</div>
					<small>{{ $report->user->name }}</small>
					<p class="line-clamp-3 my-2 mb-3">{{ $report->isi }}</p>
          <div class="flex justify-between">
            <div class="flex space-x-2 whitespace-nowrap">
              <a role="button" href="{{ route('saran.edit', $report->report_id) }}" class="w-6"><img src="{{ asset('assets/edit.svg') }}" alt="Icon"></a>
              <a role="button" href="{{ route('saran.detail', $report->report_id) }}" class="relative w-6">
                <img src="{{ asset('assets/detail.svg') }}" alt="Icon">
                @if ($count > 0)
                  <div class="absolute -right-2 -top-2 inline-flex h-5 w-5 items-center justify-center rounded-full border-2 border-white bg-red-500 text-[.6rem] font-bold text-white dark:border-gray-900">{{ $count }}</div>
                @endif
              </a>
            </div>
          </div>
				</div>
			@endforeach
		</div>
	</div>
</x-app-layout>
