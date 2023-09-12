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
                <img src="{{ $report->user->profile_photo_url }}" alt="Profile" width="48" height="48"
                    class="border-2 border-blue-100 rounded-md">
                <div class="flex flex-col justify-between">
                    <h5 class="font-semibold text-[#605C5C] text-base">{{ $report->user->name }}</h5>
                    <span class="text-[#605C5C]"><span class="text-[#173D7A]">{{ $report->created_at }}</span></span>
                </div>
            </div>
            @php
                $count = 0;
                foreach ($report->chat as $chat) {
                    if ($chat->read_status === 0) {
                        $count++;
                    }
                }
                $status = $report->history[count($report->history)-1]->status;
                if (!$report->kategori) {
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
            <span class="{{$bgColor}} rounded-xl {{$textColor}} font-bold px-3 py-1">
                {!! $status !!}
            </span>
        </div>
        <div class="border-2 border-b-8 rounded-bl-xl rounded-tr-xl px-4 py-3">
            <h5 class="text-lg font-bold mb-2">{{ $report->judul }}</h5>
            <div class="flex space-x-3">
                @if ($report->lampiran)
                <div class="mb-3">
                    <a href="{{ asset('storage/lampiran/'.$report->lampiran) }}"
                        class="border-2 border-slate-300 px-2 py-1 rounded-xl text-xs">
                        <i class="fas fa-file-image"></i>
                        Lampiran -
                        {{ $report->lampiran }}
                    </a>
                </div>
                @endif
                @if ($report->bukti)
                <div class="mb-3">
                    <a href="{{ asset('storage/bukti/'.$report->bukti) }}"
                        class="border-2 border-slate-300 px-2 py-1 rounded-xl text-xs">
                        <i class="fas fa-file-image"></i>
                        Bukti -
                        {{ $report->bukti }}
                    </a>
                </div>
                @endif
            </div>
            <div>
                {{ $report->isi }}
            </div>
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
                    <img src="{{ $teknisi->user->profile_photo_url }}" alt="Profile" width="48" height="48"
                        class="border-2 border-blue-100 rounded-md">
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

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg py-4 px-5 mb-4">
        <div class="flex justify-between items-center mb-3">
            <h4 class="text-lg font-bold pb-3">Tanggapan</h4>
            <a role="button" href="{{ route('chat.read', $report->id) }}" class="btn btn-primary relative">
                @if ($count > 0)
                    <div class="absolute inline-flex items-center justify-center w-5 h-5 text-[.6rem] font-bold text-white bg-red-500 border-2 border-white rounded-full -top-2 -right-2 dark:border-gray-900">{{ $count }}</div>
                    <i class="fas fa-envelope"></i>
                @else
                    <i class="fas fa-envelope-open"></i>
                @endif
            </a>
        </div>
        <div id-report="{{$report->id}}" class="chats-container text-sm flex flex-col mb-2"></div>
        <div class="flex space-x-3 mb-5">
            <textarea id-report="{{ $report->id }}"
                class="reply form-control flex-grow h-10 placeholder:italic placeholder:text-slate-400 block bg-white border-2 border-slate-300 rounded-md py-2 pl-3 pr-3 shadow-sm focus:outline-none focus:border-[#173D7A] focus:ring-[#173D7A] focus:ring-1 sm:text-sm resize-none"
                placeholder="Kirim Tanggapan"></textarea>
            <button id-report="{{ $report->id }}" class="replyBtn w-10 h-10 rounded-md bg-[#173D7A] text-white">
                <i class="fas fa-paper-plane"></i>
            </button>
        </div>
    </div>
</x-app-layout>
<script>
    const user_id = @json(auth()->user()->id);
</script>
<script src="{{ asset('js/custom/handleChat.js') }}"></script>
<script>
    const chatsContainer = document.querySelector('.chats-container');
  const lastReportId = chatsContainer.getAttribute('id-report');

  const eventSource = new EventSource(`/get-chats/${lastReportId}`);

  eventSource.addEventListener('chat', event => {
      const chatData = JSON.parse(event.data);
      const existingChatDiv = document.querySelector(`.chat-entry[data-chat-id="${chatData.id}"]`); // Ganti dengan atribut yang sesuai

      // Jika chat belum ada, tambahkan ke chatsContainer
      if (!existingChatDiv) {
          const chatDiv = document.createElement('div');
          chatDiv.classList.add('chat-entry', 'flex', 'flex-col');
          chatDiv.setAttribute('data-chat-id', chatData.id);

          if (user_id != chatData.user.id) {
              chatDiv.innerHTML = `
                <div>
                    <div class="flex items-start space-x-2 mb-1 max-w-[90%]">
                        <img src="${chatData.user.profile_photo_url}" alt="Profile" width="30" height="30" class="rounded-full">
                        <div class="border-2 border-l-4 border-slate-300 px-3 py-2 rounded-md mb-3 flex-grow-1">
                          <div class="mb-1">
                            <span class="font-semibold text-[#605C5C] mr-2">${chatData.user.name}</span>
                            <small class="text-slate-500 rounded-lg font-semibold text-[.5rem]">${chatData.user.role} </small>
                          </div>
                          <div>
                            ${chatData.isi}
                          </div>
                          <small class="text-slate-400 float-right">${chatData.created_at}</small>
                        </div>
                    </div>
                </div>
              `;
          } else {
              chatDiv.innerHTML = `
                  <div class="bg-[#173D7A] bg-opacity-10 p-3 rounded-md max-w-[90%] mb-3 self-end border-r-4 border-r-slate-300">
                      ${chatData.isi}
                  </div>
              `;
          }

          chatsContainer.appendChild(chatDiv);
      }
  });
</script>
