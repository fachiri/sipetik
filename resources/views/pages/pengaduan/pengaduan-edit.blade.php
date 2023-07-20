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
        <div class="flex items-start space-x-3 mb-3">
            <img src="{{ $report->user->profile_photo_url }}" alt="Profile" width="48" height="48" class="border-2 border-blue-100 rounded-md">
            <div class="flex flex-col justify-between">
                <h5 class="font-bold text-[#605C5C] text-lg">{{ $report->judul }}</h5>
                <span class="text-[#605C5C] text-xs font-semibold">{{ $report->user->name }} &#x2022; <span class="text-[#173D7A]">{{ $report->created_at }}</span></span>
            </div>
        </div>
        @php
            $status = $report->history[count($report->history)-1]->status;
            switch ($status) {
                case 'Tulis Laporan':
                    $textColor = 'text-slate-500';
                    $borderColor = 'border-slate-500';
                    break;
                case 'Verifikasi':
                    $textColor = 'text-orange-500';
                    $borderColor = 'border-orange-500';
                    break;
                case 'Proses':
                    $textColor = 'text-blue-500';
                    $borderColor = 'border-blue-500';
                    break;
                case 'Selesai':
                    $textColor = 'text-green-500';
                    $borderColor = 'border-green-500';
                    break;
                case 'Proses Gagal':
                case 'Verifikasi Gagal':
                    $status = '&#10060; ' . explode(' ', $status)[0];
                    $textColor = 'text-red-500';
                    $borderColor = 'border-red-500';
                    break;
                default:
                    $textColor = 'text-gray-500';
                    $borderColor = 'border-gray-500';
                    break;
            }
        @endphp
        <span class="border-2 {{$borderColor}} rounded-xl {{$textColor}} font-bold px-3 py-1">
            {!! $status !!}
        </span>
    </div>
    <div>
        <p class="font-semibold mb-2">Pengaduan untuk Bidang {{ $report->kategori }}</p>
        @if ($report->lampiran)
          <div class="mb-3">
            <a href="{{ asset('storage/lampiran/'.$report->lampiran) }}" class="border-2 border-slate-300 px-2 py-1 rounded-xl text-xs">
              <i class="fas fa-file-image"></i>
              {{ $report->lampiran }}
            </a>
          </div>
        @endif
        {{ $report->isi }}
    </div>
</div>
@if ($status == 'Verifikasi' || $status == 'Proses' || $status == '&#10060; Proses' || $status == 'Selesai')
    @if (auth()->user()->role == 'KABID' || auth()->user()->role == 'ADMIN')
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg py-4 px-5 mb-4">
            <h4 class="text-lg font-bold pb-3">Daftar Teknisi</h4>
            <div class="row">
                @foreach ($report->teknisi as $teknisi)
                    <div class="col-4">
                        <div class="border-2 border-b-4 border-r-4 rounded-md p-3 flex space-x-3">
                            <img src="{{ $teknisi->user->profile_photo_url }}" alt="Profile" width="48" height="48" class="border-2 border-blue-100 rounded-md">
                            <div>
                                <div class="font-bold text-base">{{ $teknisi->user->name }}</div>
                                <div>{{ $teknisi->pivot->status }}</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
@endif
@if ($status == 'Tulis Laporan')
    @if (auth()->user()->role == 'KABID' || auth()->user()->role == 'ADMIN')
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg py-4 px-5 mb-4">
            <div class="flex justify-between space-x-3">
                <a href="{{ route('pengaduan') }}" class="btn btn-secondary">Kembali</a>
                <div>
                    <button class="btn btn-danger mr-2" data-toggle="modal" data-target="#tolakVerifikasiModal">Tolak</button>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#verifikasiModal">Verifikasi</button>
                </div>
            </div>
        </div>
    @endif
@endif
@if ($status == 'Verifikasi')
    @if (auth()->user()->role == 'ADMIN' || auth()->user()->role == 'TEKNISI')
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg py-4 px-5 mb-4">
            <div class="flex justify-between space-x-3">
                <a href="{{ route('pengaduan') }}" class="btn btn-secondary">Kembali</a>
                <div>
                    <button class="btn btn-danger mr-2" data-toggle="modal" data-target="#tolakProsesModal">Tolak</button>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#prosesModal">Proses</button>
                </div>
            </div>
        </div>
    @endif
@endif
@if ($status == 'Proses')
    @if (auth()->user()->role == 'ADMIN' || auth()->user()->role == 'TEKNISI')
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg py-4 px-5 mb-4">
            <div class="flex justify-between space-x-3">
                <a href="{{ route('pengaduan') }}" class="btn btn-secondary">Kembali</a>
                <button class="btn btn-success" data-toggle="modal" data-target="#selesaiModal">Selesai</button>
            </div>
        </div>
    @endif
@endif
</x-app-layout>

{{-- modal --}}
@if ($status == 'Tulis Laporan')
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
                @if (auth()->user()->role == 'ADMIN')
                    <input type="hidden" name="status" value="Tulis Laporan">
                    <div class="flex flex-column mb-3">
                        <div class="flex justify-between">
                            <label class="font-semibold">Pilih Bidang</label>
                            @error('category')
                                <span class="text-[#FC2947] float-right">{{ $message }}</span>
                            @enderror
                        </div>
                        <select name="category" class="form-select select2">
                            @foreach ($categories as $category)
                            <option value="{{ $category->name }}">
                                {{ $category->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                @endif
                @if (auth()->user()->role == 'KABID')
                    <input type="hidden" name="status" value="Verifikasi">
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
                @endif
                @error('tanggapan')
                    <span class="text-[#FC2947] float-right">{{ $message }}</span>
                @enderror
                <label class="font-semibold">Tulis Tanggapan</label>
                @if (auth()->user()->role == 'ADMIN')
                    <textarea name="tanggapan" class="form-control w-full h-30 rounded py-3 px-6 mb-4" placeholder="Tulis Tanggapan">{{ old('tanggapan') ?? 'Laporan anda telah kami terima. Selanjutnya akan ditangani oleh Kepala Bidang. ' }}</textarea>
                @endif
                @if (auth()->user()->role == 'KABID')
                    <textarea name="tanggapan" class="form-control w-full h-30 rounded py-3 px-6 mb-4" placeholder="Tulis Tanggapan">{{ old('tanggapan') ?? 'Laporan anda telah kami verifikasi. Selanjutnya akan ditangani oleh teknisi kami 🙏. ' }}</textarea>
                @endif
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button class="btn btn-primary">Submit</button>
            </div>
        </form>
      </div>
    </div>
</div>
<div class="modal fade" id="tolakVerifikasiModal" tabindex="-1" aria-labelledby="tolakVerifikasiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title text-lg font-bold" id="tolakVerifikasiModalLabel">Tolak Pengaduan</h1>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>  
        </div>
        <form method="POST" action="{{ route('report.verified', $report->id) }}">
            @csrf
            <input type="hidden" name="status" value="Verifikasi Gagal">
            <div class="modal-body">
                @error('tanggapan')
                    <span class="text-[#FC2947] float-right">{{ $message }}</span>
                @enderror
                <label class="font-semibold">Tulis Alasan Penolakan</label>
                <textarea name="tanggapan" class="form-control w-full h-30 rounded py-3 px-6 mb-4" placeholder="Tulis Alasan Penolakan">{{ old('tanggapan') ? old('tanggapan') : 'Maaf laporan anda tidak dapat kami proses 🙏.' }}</textarea>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button class="btn btn-primary">Submit</button>
            </div>
        </form>
      </div>
    </div>
</div>
@endif

@if ($status == 'Verifikasi')
<div class="modal fade" id="prosesModal" tabindex="-1" aria-labelledby="prosesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title text-lg font-bold" id="prosesModalLabel">Proses Pengaduan</h1>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>  
        </div>
        <form method="POST" action="{{ route('report.process', $report->id) }}">
            @csrf
            <input type="hidden" name="status" value="Proses">
            <div class="modal-body">
                @error('tanggapan')
                    <span class="text-[#FC2947] float-right">{{ $message }}</span>
                @enderror
                <label class="font-semibold">Tulis Tanggapan</label>
                <textarea name="tanggapan" class="form-control w-full h-30 rounded py-3 px-6 mb-4" placeholder="Tulis Tanggapan">{{ old('tanggapan', 'Terima kasih, laporan anda akan segera kami proses 🙏. ') }}</textarea>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button class="btn btn-primary">Submit</button>
            </div>
        </form>
      </div>
    </div>
</div>
<div class="modal fade" id="tolakProsesModal" tabindex="-1" aria-labelledby="tolakProsesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title text-lg font-bold" id="tolakProsesModalLabel">Tolak Pengaduan</h1>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>  
        </div>
        <form method="POST" action="{{ route('report.process', $report->id) }}">
            @csrf
            <input type="hidden" name="status" value="Proses Gagal">
            <div class="modal-body">
                @error('tanggapan')
                    <span class="text-[#FC2947] float-right">{{ $message }}</span>
                @enderror
                <label class="font-semibold">Tulis Alasan Penolakan</label>
                <textarea name="tanggapan" class="form-control w-full h-30 rounded py-3 px-6 mb-4" placeholder="Tulis Tanggapan">{{ old('tanggapan', 'Maaf, laporan anda tidak dapat kami proses 🙏. ') }}</textarea>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button class="btn btn-primary">Submit</button>
            </div>
        </form>
      </div>
    </div>
</div>
@endif

@if ($status == 'Proses')
<div class="modal fade" id="selesaiModal" tabindex="-1" aria-labelledby="selesaiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title text-lg font-bold" id="selesaiModalLabel">Finalisasi Pengaduan</h1>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>  
        </div>
        <form method="POST" action="{{ route('report.finish', $report->id) }}">
            @csrf
            <input type="hidden" name="status" value="Selesai">
            <div class="modal-body">
                @error('tanggapan')
                    <span class="text-[#FC2947] float-right">{{ $message }}</span>
                @enderror
                <label class="font-semibold">Tulis Tanggapan</label>
                <textarea name="tanggapan" class="form-control w-full h-30 rounded py-3 px-6 mb-4" placeholder="Tulis Tanggapan">{{ old('tanggapan', 'Laporan anda telah selesai kami kerjakan, terima kasih telah menunggu dan semoga hari anda menyenangkan 🙏. ') }}</textarea>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button class="btn btn-primary">Submit</button>
            </div>
        </form>
      </div>
    </div>
</div>
@endif
