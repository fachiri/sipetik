<x-app-layout>
  <x-slot name="header_content">
      <h1>Detail {{ $report->jenis }} {{ $report->report_id }}</h1>
      <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active">Monitoring</div>
          <div class="breadcrumb-item"><a href="{{ route('pengaduan') }}">Pengaduan</a></div>
          <div class="breadcrumb-item">Detail {{ $report->report_id }}</div>
      </div>
  </x-slot>

  <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg py-4 px-5">
    <h4 class="text-lg font-bold pb-3">{{ $report->kategori }}</h4>
    <div class="flex items-start space-x-2 mb-3">
        <img src="{{ asset('assets/img8.png') }}" alt="Profile">
        <div class="flex flex-col justify-between">
            <h5 class="font-semibold text-[#605C5C] text-base">{{ $report->user->name }}</h5>
            <span class="text-[#605C5C]"><span class="text-[#173D7A]">2 Menit yang lalu</span> &#x2022; {{ $report->history[0]->status }}</span>
        </div>
    </div>
    <div>
        {{ $report->isi }}
    </div>
  </div>
</x-app-layout>
