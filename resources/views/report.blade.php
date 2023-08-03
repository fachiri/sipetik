<x-guest-layout> 
    <div class="w-screen min-h-screen bg-[url('/assets/bg3.png')] bg-top mb-20 bg-no-repeat bg-100-auto">
        <div class="container mx-auto flex flex-col md:flex-row space-y-10 md:space-y-0 md:space-x-10 md:items-start px-5 md:px-0">
            <div class="basis-full md:basis-9/12 bg-white p-5 shadow-xl rounded">
                <div class="flex flex-col md:flex-row justify-between items-start text-[#173D7A] mb-8 md:mb-10 pb-5 md:pb-0 space-y-5 md:space-y-0 border-b-2 md:border-0">
                    <div class="flex items-center space-x-3">
                        <img src="{{ auth()->user()->profile_photo_url }}" alt="Profile Image" class="w-15 rounded-full border-2 border-blue-100">
                        <div>
                            <h5 class="font-semibold">{{ auth()->user()->name }}</h5>
                            <span class="text-xs md:text-sm text-center">{{ auth()->user()->email }}</span>
                        </div>
                    </div>
                    <div class="w-full md:w-auto flex justify-between md:space-x-20">
                        <div class="basis-1/3 flex flex-col items-center">
                            <span class="text-xs md:text-sm text-center">Terverifikasi</span>
                            <span class="text-3xl font-semibold">{{ $total['verifikasi'] }}</span>
                        </div>
                        <div class="basis-1/3 flex flex-col items-center">
                            <span class="text-xs md:text-sm text-center">Proses</span>
                            <span class="text-3xl font-semibold">{{ $total['proses'] }}</span>
                        </div>
                        <div class="basis-1/3 flex flex-col items-center">
                            <span class="text-xs md:text-sm text-center">Selesai</span>
                            <span class="text-3xl font-semibold">{{ $total['selesai'] }}</span>
                        </div>
                    </div>
                    <img src="{{ asset('assets/img7.png') }}" alt="Image" class="hidden md:block">
                </div>
                <div class="mb-1 flex space-x-1">
                    <button id="tab1" class="tab-btn tab-btn-report active bg-[#173D7A] border-2 border-[#173D7A] text-white font-semibold px-5 py-2 rounded text-sm">Laporan Saya</button>
                    <button id="tab2" class="tab-btn tab-btn-report bg-[#173D7A] border-2 border-[#173D7A] text-white font-semibold px-5 py-2 rounded text-sm">Riwayat Laporan</button>
                    <button id="tab3" class="tab-btn tab-btn-report bg-[#173D7A] border-2 border-[#173D7A] text-white font-semibold px-5 py-2 rounded text-sm">Semua</button>
                </div>
                <div id="content1" class="tab-content border-2 border-[#173D7A] p-5 rounded">
                    @if ($myreports->isEmpty())
                        <p class="text-center font-semibold">Anda belum memiliki laporan</p>
                    @else
                        @php
                            $lastReport = $myreports[count($myreports)-1];
                            $status = $lastReport->history[count($lastReport->history)-1]->status;
                            $progress = 0;
                            $statusVerified = 'Verifikasi';
                            $statusProcessed = 'Proses';
                            if ($status == 'Verifikasi' || $status == 'Verifikasi Gagal') {
                                $statusVerified = $status == 'Verifikasi Gagal' ? '&#10060; Verifikasi' : $status;
                                $progress = 33;
                            } elseif ($status == 'Proses' || $status == 'Proses Gagal') {
                                $statusProcessed = $status == 'Proses Gagal' ? '&#10060; Proses' : $status;
                                $progress = 66;
                            } elseif ($status == 'Selesai') {
                                $progress = 100;
                            }
                        @endphp
                        <div class="border-b-2 mb-5">
                            <div class="flex items-start space-x-2 mb-2">
                                <img src="{{ $lastReport->user->profile_photo_url }}" alt="Profile" width="45" height="45" class="border-2 border-blue-100 rounded-md">
                                <div>
                                    <h5 class="font-semibold text-[#605C5C]">{{ $lastReport->judul }}</h5>
                                    <small class="text-[#605C5C]"><span class="text-[#173D7A]">{{ $lastReport->created_at }}</span> &#x2022; {{ $lastReport->jenis }} - {{ $lastReport->kategori }}</small>
                                </div>
                            </div>
                            <div class="flex space-x-3">
                                @if ($lastReport->lampiran)
                                    <div class="mb-3">
                                        <a href="{{ asset('storage/lampiran/'.$lastReport->lampiran) }}" class="border-2 border-slate-300 px-2 py-1 rounded-xl text-xs">
                                            <i class="fas fa-file-image"></i>
                                            Lampiran - 
                                            {{ $lastReport->lampiran }}
                                        </a>
                                    </div>
                                @endif
                                @if ($lastReport->bukti)
                                    <div class="mb-3">
                                        <a href="{{ asset('storage/bukti/'.$lastReport->bukti) }}" class="border-2 border-slate-300 px-2 py-1 rounded-xl text-xs">
                                            <i class="fas fa-file-image"></i>
                                            Bukti - 
                                            {{ $lastReport->bukti }}
                                        </a>
                                    </div>
                                @endif
                            </div>
                            <div class="text-sm mb-5">
                                <p>{{ $lastReport->isi }}</p>
                            </div>
                            <div class="flex justify-between relative shadow-xl p-3 mb-8 border rounded">
                                <div class="basis-1/4 flex flex-col items-center z-10">
                                    <img src="{{ asset('assets/img1.png') }}" alt="Image" class="w-8 mb-2">
                                    <span class="text-xs md:text-sm text-center">Tulis <span class="hidden md:inline">Laporan</span></span>
                                </div>
                                <div class="basis-1/4 flex flex-col items-center z-10">
                                    <img src="{{ asset('assets/img2.png') }}" alt="Image" class="w-8 mb-2">
                                    <span class="text-xs md:text-sm text-center">{!! $statusVerified !!}</span>
                                </div>
                                <div class="basis-1/4 flex flex-col items-center z-10">
                                    <img src="{{ asset('assets/img3.png') }}" alt="Image" class="w-8 mb-2">
                                    <span class="text-xs md:text-sm text-center">{!! $statusProcessed !!}</span>
                                </div>
                                <div class="basis-1/4 flex flex-col items-center z-10">
                                    <img src="{{ asset('assets/img5.png') }}" alt="Image" class="w-8 mb-2">
                                    <span class="text-xs md:text-sm text-center">Selesai</span>
                                </div>
                                <div class="flex w-9/12 h-2 bg-[#D9D9D9] rounded-full overflow-hidden absolute top-6 left-1/2 transform -translate-x-1/2 z-0">
                                    <div class="flex flex-col justify-center overflow-hidden bg-[#173D7A]" role="progressbar" style="width: {{ $progress }}%" aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div id-report="{{$lastReport->id}}" class="chats-container text-sm flex flex-col mb-2"></div>
                            <div class="flex space-x-3 mb-5">
                                <textarea id-report="{{$lastReport->id}}" class="reply flex-grow placeholder:italic placeholder:text-slate-400 block bg-white border border-slate-300 rounded-md py-2 pl-3 pr-3 shadow-sm focus:outline-none focus:border-[#173D7A] focus:ring-[#173D7A] focus:ring-1 sm:text-sm resize-none" placeholder="Kirim Tanggapan"></textarea>
                                <button id-report="{{$lastReport->id}}" class="replyBtn w-10 h-10 rounded-md bg-[#173D7A] text-white">
                                    <i class="fa-solid fa-paper-plane"></i>
                                </button>
                            </div>
                        </div>
                        <p class="font-semibold text-center">Periksa Email anda, karena sistem akan memberikan tanggapan terkait laporan anda di Email</p>
                    @endif
                </div>
                <div id="content2" class="tab-content border-2 border-[#173D7A] p-5 rounded hidden">
                    @if ($myreports->isEmpty())
                        <p class="text-center font-semibold">Anda belum memiliki laporan</p>
                    @else
                        @foreach ($myreports as $myreport)
                            @php
                                $status = $myreport->history[count($myreport->history)-1]->status;
                                $progress = 0;
                                $statusVerified = 'Verifikasi';
                                $statusProcessed = 'Proses';
                                if ($status == 'Verifikasi' || $status == 'Verifikasi Gagal') {
                                    $statusVerified = $status == 'Verifikasi Gagal' ? '&#10060; Verifikasi' : $status;
                                    $progress = 33;
                                } elseif ($status == 'Proses' || $status == 'Proses Gagal') {
                                    $statusProcessed = $status == 'Proses Gagal' ? '&#10060; Proses' : $status;
                                    $progress = 66;
                                } elseif ($status == 'Selesai') {
                                    $progress = 100;
                                }
                            @endphp
                            <div class="border-b-2 mb-8">
                                <div class="flex items-start space-x-2 mb-5">
                                    <img src="{{ $myreport->user->profile_photo_url }}" alt="Profile" width="35" height="35" class="border-2 border-blue-100 rounded-md">
                                    <div>
                                        <h5 class="font-semibold text-[#605C5C]">{{ $myreport->judul }}</h5>
                                        <small class="text-[#605C5C]"><span class="text-[#173D7A]">{{ $myreport->created_at }}</span> &#x2022; {{ $myreport->jenis }} - {{ $myreport->kategori }}</small>
                                    </div>
                                </div>
                                <div class="flex space-x-3">
                                    @if ($myreport->lampiran)
                                        <div class="mb-3">
                                            <a href="{{ asset('storage/lampiran/'.$myreport->lampiran) }}" class="border-2 border-slate-300 px-2 py-1 rounded-xl text-xs">
                                                <i class="fas fa-file-image"></i>
                                                Lampiran - 
                                                {{ $myreport->lampiran }}
                                            </a>
                                        </div>
                                    @endif
                                    @if ($myreport->bukti)
                                        <div class="mb-3">
                                            <a href="{{ asset('storage/bukti/'.$myreport->bukti) }}" class="border-2 border-slate-300 px-2 py-1 rounded-xl text-xs">
                                                <i class="fas fa-file-image"></i>
                                                Bukti - 
                                                {{ $myreport->bukti }}
                                            </a>
                                        </div>
                                    @endif
                                </div>
                                <div class="text-sm mb-5">
                                    <p>{{ $myreport->isi }}</p>
                                </div>
                                <div class="flex justify-between relative shadow-xl p-3 mb-8 border rounded">
                                    <div class="basis-1/4 flex flex-col items-center z-10">
                                        <img src="{{ asset('assets/img1.png') }}" alt="Image" class="w-8 mb-2">
                                        <span class="text-xs md:text-sm text-center">Tulis <span class="hidden md:inline">Laporan</span></span>
                                    </div>
                                    <div class="basis-1/4 flex flex-col items-center z-10">
                                        <img src="{{ asset('assets/img2.png') }}" alt="Image" class="w-8 mb-2">
                                        <span class="text-xs md:text-sm text-center">{!! $statusVerified !!}</span>
                                    </div>
                                    <div class="basis-1/4 flex flex-col items-center z-10">
                                        <img src="{{ asset('assets/img3.png') }}" alt="Image" class="w-8 mb-2">
                                        <span class="text-xs md:text-sm text-center">{!! $statusProcessed !!}</span>
                                    </div>
                                    <div class="basis-1/4 flex flex-col items-center z-10">
                                        <img src="{{ asset('assets/img5.png') }}" alt="Image" class="w-8 mb-2">
                                        <span class="text-xs md:text-sm text-center">Selesai</span>
                                    </div>
                                    <div class="flex w-9/12 h-2 bg-[#D9D9D9] rounded-full overflow-hidden absolute top-6 left-1/2 transform -translate-x-1/2 z-0">
                                        <div class="flex flex-col justify-center overflow-hidden bg-[#173D7A]" role="progressbar" style="width: {{ $progress }}%" aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div id-report="{{$myreport->id}}" class="chats-container text-sm flex flex-col mb-2">
                                    @foreach ($myreport->chat as $chat)
                                        @if ($chat->user_id == auth()->user()->id)
                                            <div class="bg-[#173D7A] bg-opacity-10 p-3 rounded-md max-w-[90%] mb-3 self-end border-r-4 border-r-slate-300">
                                                {{ $chat->isi }}
                                            </div>
                                        @else
                                            <div>
                                                <div class="flex items-start space-x-2 mb-1">
                                                    <img src="{{ $chat->user->profile_photo_url }}" alt="Profile" width="35" height="35" class="border-2 border-blue-100 rounded-md">
                                                    <div>
                                                        <h6 class="font-semibold text-[#605C5C]">{{ $chat->user->name }}</h6>
                                                        <small class="text-[#605C5C]"><span class="text-[#173D7A]">{{ $chat->created_at }}</span> &#x2022; {{ $chat->user->role }} </small>
                                                    </div>
                                                </div>
                                                <div class="border-2 border-l-4 p-3 rounded-md max-w-[90%] mb-3">
                                                    {{ $chat->isi }}
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                <div class="flex space-x-3 mb-5">
                                    <textarea id-report="{{$myreport->id}}" class="reply flex-grow placeholder:italic placeholder:text-slate-400 block bg-white border border-slate-300 rounded-md py-2 pl-3 pr-3 shadow-sm focus:outline-none focus:border-[#173D7A] focus:ring-[#173D7A] focus:ring-1 sm:text-sm resize-none" placeholder="Kirim Tanggapan"></textarea>
                                    <button id-report="{{$myreport->id}}" class="replyBtn w-10 h-10 rounded-md bg-[#173D7A] text-white">
                                        <i class="fa-solid fa-paper-plane"></i>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                <div id="content3" class="tab-content border-2 border-[#173D7A] md:p-5 rounded hidden">
                    @if ($allreports->isEmpty())
                        <p class="text-center font-semibold">Laporan tidak ditemukan</p>
                    @else
                        @foreach ($allreports as $report)
                            <div class="shadow-xl rounded p-4 border mb-5">
                                <div class="flex items-start space-x-2 mb-5">
                                    <img src="{{ $report->user->profile_photo_url }}" alt="Profile" width="43" height="43" class="border-2 border-blue-100 rounded-md">
                                    <div>
                                        <h5 class="font-semibold text-[#605C5C]">{{ $report->user->name }}</h5>
                                        <small class="text-[#605C5C]"><span class="text-[#173D7A]">{{ $report->created_at }}</span> &#x2022; {{ $report->jenis }} - {{ $report->kategori }}</small>
                                    </div>
                                </div>
                                <div class="text-sm mb-1">
                                    <h5 class="font-medium mb-2 text-[#173D7A]">{{ $report->judul }}</h5>
                                    <p>{{ $report->isi }}</p>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="md:basis-3/12 bg-white p-5 shadow-xl rounded">
                <h4 class="font-semibold text-lg mb-3">Laporan Terbaru</h4>
                @if ($allreports->isEmpty())
                    <p class="text-center font-semibold border-2 rounded-md py-3 border-[#173D7A]">Laporan tidak ditemukan</p>
                @else
                    @php
                        if ($allreports->count() >= 3) {
                            $length = 3;
                        } else {
                            $length = $allreports->count();
                        }
                    @endphp
                    @for ($i = 0; $i < $length; $i++)
                        <div class="shadow-lg rounded p-4 border mb-4">
                            <div class="flex items-start space-x-2 mb-2">
                                <img src="{{ $allreports[$i]->user->profile_photo_url }}" alt="Profile" width="30" height="30" class="border-2 border-blue-100 rounded-md">
                                <div>
                                    <h5 class="text-[#605C5C]">{{ $allreports[$i]->user->name }}</h5>
                                </div>
                            </div>
                            <div class="text-sm mb-1">
                                <h5 class="font-medium mb-2 text-[#173D7A]">{{ $allreports[$i]->judul }}</h5>
                                <p style="display: -webkit-box; display: -moz-box; -webkit-line-clamp: 3; -moz-box-orient: vertical; overflow: hidden; text-overflow: ellipsis;">
                                    {{ $allreports[$i]->isi . '...' }}
                                </p>
                            </div>
                        </div>
                    @endfor
                @endif
            </div>
        </div>
    </div>
</x-guest-layout> 
<script>const user_id = @json(auth()->user()->id);</script>
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
                        <div class="flex items-start space-x-2 mb-1">
                            <img src="${chatData.user.profile_photo_url}" alt="Profile" width="35" height="35" class="border-2 border-blue-100 rounded-md">
                            <div>
                                <h6 class="font-semibold text-[#605C5C]">${chatData.user.name}</h6>
                                <small class="text-[#605C5C]"><span class="text-[#173D7A]">${chatData.created_at}</span> &#x2022; ${chatData.user.role} </small>
                            </div>
                        </div>
                        <div class="border-2 border-l-4 p-3 rounded-md max-w-[90%] mb-3">
                            ${chatData.isi}
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
