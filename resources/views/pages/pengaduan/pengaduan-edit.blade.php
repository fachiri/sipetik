<x-app-layout>
  <x-slot name="header_content">
      <h1>Edit {{ $report->jenis }} {{ $report->report_id }}</h1>
      <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active">Monitoring</div>
          <div class="breadcrumb-item"><a href="{{ route('pengaduan') }}">Pengaduan</a></div>
          <div class="breadcrumb-item">Edit {{ $report->report_id }}</div>
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
    <div class="border rounded-xl px-4 py-3 mb-4">
        <h5 class="text-lg font-bold mb-2 pb-2 border-b-2">{{ $report->judul }}</h5>
        {{ $report->isi }}
    </div>
</div>
@if ($report->history[0]->status == 'Tulis Laporan')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg py-4 px-5 mb-4">
    <form method="POST" action="{{ route('report.verified', $report->id) }}">
        @error('tanggapan')
            <span class="text-[#FC2947] float-right">{{ $message }}</span>
        @enderror
        <textarea name="tanggapan" class="w-full h-20 rounded border-2 border-[#D9D9D9] py-3 px-6 font-medium placeholder:text-[#B1A6A6] placeholder:font-semibold mb-4" placeholder="Ketik Tanggapan">{{ old('tanggapan') }}</textarea>
        @csrf
        <button class="btn btn-primary float-right">Verifikasi</button>
    </form>
</div>
@endif

</x-app-layout>
