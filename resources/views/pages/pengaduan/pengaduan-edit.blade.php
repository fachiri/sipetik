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
    <div class="flex justify-between items-start">
        <div class="flex items-center space-x-3 mb-3">
            <img src="{{ asset('assets/img8.png') }}" alt="Profile">
            <div class="flex flex-col justify-between">
                <h5 class="font-bold text-[#605C5C] text-lg">{{ $report->judul }}</h5>
                <span class="text-[#605C5C] text-xs font-semibold">{{ $report->user->name }} &#x2022; <span class="text-[#173D7A]">2 menit yang lalu</span></span>
            </div>
        </div>
        @php
            $status = $report->history[count($report->history)-1]->status;
            $color = '';
            if ($status == 'Tulis Laporan') {
                $color = 'slate-500';
            } elseif ($status == 'Verifikasi') {
                $color = 'orange-500';
            } elseif ($status == 'Proses') {
                $color = 'blue-500';
            } elseif ($status == 'Selesai') {
                $color = 'green-500';
            }
        @endphp
        <span class="border-2 border-{{ $color }} rounded-xl text-{{ $color }} font-bold px-3 py-1">
            {{ $status }}
        </span>
    </div>
    <div>
        <p class="font-semibold">Pengaduan untuk Bidang {{ $report->kategori }}</p>
        {{ $report->isi }}
    </div>
</div>
@if ($status == 'Tulis Laporan')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg py-4 px-5 mb-4">
    <div class="flex justify-between space-x-3">
        <button class="btn btn-secondary">Kembali</button>
        <div>
            <button class="btn btn-danger mr-2">Tolak</button>
            <button class="btn btn-primary" data-toggle="modal" data-target="#verifikasiModal">Verifikasi</button>
        </div>
    </div>
</div>
@endif
</x-app-layout>
<div class="modal fade" id="verifikasiModal" tabindex="-1" aria-labelledby="verifikasiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title text-lg font-bold" id="verifikasiModalLabel">Verifikasi Pengaduan</h1>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>  
        </div>
        <form method="POST" action="{{ route('report.verified', $report->id) }}">
            @csrf
            <div class="modal-body">
                <div class="flex flex-column mb-3">
                    <div class="flex justify-between">
                        <label class="font-semibold">Pilih Teknisi</label>
                        @error('teknisi')
                            <span class="text-[#FC2947] float-right">{{ $message }}</span>
                        @enderror
                    </div>
                    <select name="teknisi[]" class="form-select select2" multiple="">
                        @foreach ($teknisi2 as $teknisi)
                            @if ($report->kategori == $teknisi->category->name)
                                <option value="{{ $teknisi->id }}">
                                    {{ $teknisi->user->name }}
                                </option>
                            @endif
                        @endforeach
                    </select>
                </div>
                @error('tanggapan')
                    <span class="text-[#FC2947] float-right">{{ $message }}</span>
                @enderror
                <label class="font-semibold">Tulis Tanggapan</label>
                <textarea name="tanggapan" class="form-control w-full h-30 rounded py-3 px-6 mb-4" placeholder="Tulis Tanggapan">{{ old('tanggapan') }}</textarea>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button class="btn btn-primary">Submit</button>
            </div>
        </form>
      </div>
    </div>
</div>
