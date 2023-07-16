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
    <div class="flex justify-between items-start">
      <div class="flex items-start space-x-2 mb-3">
          <img src="{{ $report->user->profile_photo_url }}" alt="Profile" width="48" height="48" class="border-2 border-blue-100 rounded-md">
          <div class="flex flex-col justify-between">
              <h5 class="font-semibold text-[#605C5C] text-base">{{ $report->user->name }}</h5>
              <span class="text-[#605C5C]"><span class="text-[#173D7A]">{{ $report->created_at }}</span></span>
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
    <div class="border-2 border-b-8 rounded-bl-xl rounded-tr-xl px-4 py-3">
        <h5 class="text-lg font-bold mb-2">{{ $report->judul }}</h5>
        {{ $report->isi }}
    </div>
  </div>

  @if ($status == 'Verifikasi' || $status == 'Proses' || $status == '&#10060; Proses' || $status == 'Selesai')
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

  <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg py-4 px-5 mb-4">
    <h4 class="text-lg font-bold pb-3">Tanggapan</h4>
    <div id-report="{{$report->id}}" class="chats-container text-sm flex flex-col mb-2">
      @foreach ($report->chat as $chat)
          @if ($chat->user_id == auth()->user()->id)
              <div class="bg-[#173D7A] bg-opacity-10 p-3 rounded-md max-w-[90%] mb-3 self-end border-r-4 border-r-slate-300">
                  {{ $chat->isi }}
              </div>
          @else
              <div>
                  <div class="flex items-start space-x-2 mb-1 max-w-[90%]">
                      <img src="{{ asset('assets/img8.png') }}" alt="Profile" width="30" height="30" class="rounded-full">
                      <div class="border-2 border-l-4 border-slate-300 px-3 py-2 rounded-md mb-3 flex-grow-1">
                        <div class="mb-1">
                          <span class="font-semibold text-[#605C5C] mr-2">{{ $chat->user->name }}</span>
                          <small class="text-slate-500 rounded-lg font-semibold text-[.5rem]">{{ $chat->user->role }} </small>
                        </div>
                        <div>
                          {{ $chat->isi }}
                        </div>
                        <small class="text-slate-400 float-right">{{ $chat->created_at }}</small>
                      </div>
                  </div>
              </div>
          @endif
      @endforeach
    </div>
    <div class="flex space-x-3 mb-5">
        <textarea id-report="{{ $report->id }}" class="reply form-control flex-grow h-10 placeholder:italic placeholder:text-slate-400 block bg-white border-2 border-slate-300 rounded-md py-2 pl-3 pr-3 shadow-sm focus:outline-none focus:border-[#173D7A] focus:ring-[#173D7A] focus:ring-1 sm:text-sm resize-none" placeholder="Kirim Tanggapan"></textarea>
        <button id-report="{{ $report->id }}" class="replyBtn w-10 h-10 rounded-md bg-[#173D7A] text-white">
            <i class="fas fa-paper-plane"></i>
        </button>
    </div>
  </div>
</x-app-layout>
<script>const user_id = @json(auth()->user()->id);</script>
<script src="{{ asset('js/custom/handleChat.js') }}"></script>
