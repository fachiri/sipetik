<x-app-layout>
  <x-slot name="header_content">
      <h1>Detail {{ $report->jenis }} {{ $report->report_id }}</h1>
      <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active">Monitoring</div>
          <div class="breadcrumb-item"><a href="{{ route('pengaduan') }}">Pengaduan</a></div>
          <div class="breadcrumb-item">Detail {{ $report->report_id }}</div>
      </div>
  </x-slot>

  <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg py-4 px-5 mb-4">
    <h4 class="text-lg font-bold pb-3">Kategori - {{ $report->kategori }}</h4>
    <div class="flex items-start space-x-2 mb-3">
        <img src="{{ asset('assets/img8.png') }}" alt="Profile">
        <div class="flex flex-col justify-between">
            <h5 class="font-semibold text-[#605C5C] text-base">{{ $report->user->name }}</h5>
            <span class="text-[#605C5C]"><span class="text-[#173D7A]">2 Menit yang lalu</span> &#x2022; {{ $report->history[0]->status }}</span>
        </div>
    </div>
    <div class="border rounded-xl px-4 py-3 ">
        <h5 class="text-lg font-bold mb-2 pb-2 border-b-2">{{ $report->judul }}</h5>
        {{ $report->isi }}
    </div>
  </div>

  <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg py-4 px-5 mb-4">
    <h4 class="text-lg font-bold pb-3">Riwayat</h4>

  </div>
</x-app-layout>
