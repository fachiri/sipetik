<x-guest-layout>
	<div class="mb-20 min-h-screen w-full bg-[url('/assets/bg5.png')] bg-100-auto bg-top bg-no-repeat">
		<div class="container mx-auto flex flex-col space-y-10 px-5 md:flex-row md:items-start md:space-x-10 md:space-y-0 md:px-0">
			<div class="basis-full rounded bg-white p-5 shadow-xl md:basis-9/12">
				<div class="mb-8 flex flex-col items-start justify-between space-y-5 border-b-2 pb-5 text-[#173D7A] md:mb-10 md:flex-row md:space-y-0 md:border-0 md:pb-0">
					<div class="flex items-center space-x-3">
						<img src="{{ auth()->user()->profile_photo_url }}" alt="Profile Image" class="w-15 rounded-full border-2 border-blue-100">
						<div>
							<h5 class="font-semibold">{{ auth()->user()->name }}</h5>
							<span class="text-center text-xs md:text-sm">{{ auth()->user()->email }}</span>
						</div>
					</div>
					<div class="flex w-full justify-between md:w-auto md:space-x-20">
						<div class="flex basis-1/3 flex-col items-center">
							<span class="text-center text-xs md:text-sm">Terverifikasi</span>
							<span class="text-3xl font-semibold">{{ $total['verifikasi'] }}</span>
						</div>
						<div class="flex basis-1/3 flex-col items-center">
							<span class="text-center text-xs md:text-sm">Proses</span>
							<span class="text-3xl font-semibold">{{ $total['proses'] }}</span>
						</div>
						<div class="flex basis-1/3 flex-col items-center">
							<span class="text-center text-xs md:text-sm">Selesai</span>
							<span class="text-3xl font-semibold">{{ $total['selesai'] }}</span>
						</div>
					</div>
					<img src="{{ asset('assets/img7.png') }}" alt="Image" class="hidden md:block">
				</div>
        <div class="w-full mb-3 sm:hidden">
					<button class="w-full rounded border-2 border-[#CB004A] bg-[#CB004A] px-5 py-2 text-sm font-semibold text-white" data-modal-target="defaultModal" data-modal-toggle="defaultModal">Buat Laporan</button>
				</div>
				<x-buat-laporan/>
				<div class="mb-1 flex justify-between">
					<div class="flex space-x-1 w-full sm:w-auto">
						<button id="tab1" class="basis-1/3 sm:basis-auto tab-btn tab-btn-report active rounded border-2 border-[#173D7A] bg-[#173D7A] px-5 py-2 text-sm font-semibold text-white">Laporan Saya</button>
						<button id="tab2" class="basis-1/3 sm:basis-auto tab-btn tab-btn-report rounded border-2 border-[#173D7A] bg-[#173D7A] px-5 py-2 text-sm font-semibold text-white">Riwayat Laporan</button>
						<button id="tab3" class="basis-1/3 sm:basis-auto tab-btn tab-btn-report rounded border-2 border-[#173D7A] bg-[#173D7A] px-5 py-2 text-sm font-semibold text-white">Semua</button>
					</div>
          <div class="hidden sm:inline">
            <button class="w-full rounded border-2 border-[#CB004A] bg-[#CB004A] px-5 py-2 text-sm font-semibold text-white" data-modal-target="defaultModal" data-modal-toggle="defaultModal">Buat Laporan</button>
          </div>
				</div>
				<div id="content1" class="tab-content rounded border-2 border-[#173D7A] p-5">
					@if ($myreports->isEmpty())
						<p class="text-center font-semibold">Anda belum memiliki laporan</p>
					@else
						@php
							$lastReport = $myreports[count($myreports) - 1];
							$status = $lastReport->history[count($lastReport->history) - 1]->status;
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
						<div class="mb-5 border-b-2">
							<div class="flex items-start justify-between">
								<div class="mb-2 flex items-start space-x-2">
									<img src="{{ $lastReport->user->profile_photo_url }}" alt="Profile" width="45" height="45" class="rounded-md border-2 border-blue-100">
									<div>
										<h5 class="font-semibold text-[#605C5C]">{{ $lastReport->judul }}</h5>
										<small class="text-[#605C5C]"><span class="text-[#173D7A]">{{ $lastReport->created_at }}</span> &#x2022; {{ $lastReport->jenis }} - {{ $lastReport->kategori }}</small>
									</div>
								</div>
								<a role="button" href="{{ route('chat.read', $lastReport->id) }}" class="relative rounded bg-[#173D7A] px-2 py-1 text-white">
									<i class="fas fa-envelope"></i>
								</a>
							</div>
							<div class="flex space-x-3">
								@if ($lastReport->lampiran)
									<div class="mb-3">
										<a href="{{ asset('storage/lampiran/' . $lastReport->lampiran) }}" class="rounded-xl border-2 border-slate-300 px-2 py-1 text-xs">
											<i class="fas fa-file-image"></i>
											Lampiran
										</a>
									</div>
								@endif
								@if ($lastReport->bukti)
									<div class="mb-3">
										<a href="{{ asset('storage/bukti/' . $lastReport->bukti) }}" class="rounded-xl border-2 border-slate-300 px-2 py-1 text-xs">
											<i class="fas fa-file-image"></i>
											Bukti
										</a>
									</div>
								@endif
							</div>
							<div class="mb-5 text-sm">
								<p>{{ $lastReport->isi }}</p>
							</div>
							<div class="relative mb-8 flex justify-between rounded border p-3 shadow-xl">
								<div class="z-10 flex basis-1/4 flex-col items-center">
									<img src="{{ asset('assets/img1.png') }}" alt="Image" class="mb-2 w-8">
									<span class="text-center text-xs md:text-sm">Tulis <span class="hidden md:inline">Laporan</span></span>
								</div>
								<div class="z-10 flex basis-1/4 flex-col items-center">
									<img src="{{ asset('assets/img2.png') }}" alt="Image" class="mb-2 w-8">
									<span class="text-center text-xs md:text-sm">{!! $statusVerified !!}</span>
								</div>
								<div class="z-10 flex basis-1/4 flex-col items-center">
									<img src="{{ asset('assets/img3.png') }}" alt="Image" class="mb-2 w-8">
									<span class="text-center text-xs md:text-sm">{!! $statusProcessed !!}</span>
								</div>
								<div class="z-10 flex basis-1/4 flex-col items-center">
									<img src="{{ asset('assets/img5.png') }}" alt="Image" class="mb-2 w-8">
									<span class="text-center text-xs md:text-sm">Selesai</span>
								</div>
								<div class="absolute left-1/2 top-6 z-0 flex h-2 w-9/12 -translate-x-1/2 transform overflow-hidden rounded-full bg-[#D9D9D9]">
									<div class="flex flex-col justify-center overflow-hidden bg-[#173D7A]" role="progressbar" style="width: {{ $progress }}%" aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
							</div>
							<div id-report="{{ $lastReport->id }}" class="chats-container mb-2 flex flex-col text-sm"></div>
							<div class="mb-5 flex space-x-3">
								<textarea id-report="{{ $lastReport->id }}" class="reply block flex-grow resize-none rounded-md border border-slate-300 bg-white py-2 pl-3 pr-3 shadow-sm placeholder:italic placeholder:text-slate-400 focus:border-[#173D7A] focus:outline-none focus:ring-1 focus:ring-[#173D7A] sm:text-sm" placeholder="Kirim Tanggapan"></textarea>
								<button id-report="{{ $lastReport->id }}" class="replyBtn h-10 w-10 rounded-md bg-[#173D7A] text-white">
									<i class="fa-solid fa-paper-plane"></i>
								</button>
							</div>
						</div>
						<p class="text-center font-semibold">Kami akan mengirimkan tanggapan terkait laporan anda</p>
					@endif
				</div>
				<div id="content2" class="tab-content hidden rounded border-2 border-[#173D7A] p-5">
					@if ($myreports->isEmpty())
						<p class="text-center font-semibold">Anda belum memiliki laporan</p>
					@else
						@foreach ($myreports as $myreport)
							@php
								$status = $myreport->history[count($myreport->history) - 1]->status;
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
							<div class="mb-8 border-b-2">
								<div class="mb-5 flex items-start space-x-2">
									<img src="{{ $myreport->user->profile_photo_url }}" alt="Profile" width="35" height="35" class="rounded-md border-2 border-blue-100">
									<div>
										<h5 class="font-semibold text-[#605C5C]">{{ $myreport->judul }}</h5>
										<small class="text-[#605C5C]"><span class="text-[#173D7A]">{{ $myreport->created_at }}</span> &#x2022; {{ $myreport->jenis }} - {{ $myreport->kategori }}</small>
									</div>
								</div>
								<div class="flex space-x-3">
									@if ($myreport->lampiran)
										<div class="mb-3">
											<a href="{{ asset('storage/lampiran/' . $myreport->lampiran) }}" class="rounded-xl border-2 border-slate-300 px-2 py-1 text-xs">
												<i class="fas fa-file-image"></i>
												Lampiran -
												{{ $myreport->lampiran }}
											</a>
										</div>
									@endif
									@if ($myreport->bukti)
										<div class="mb-3">
											<a href="{{ asset('storage/bukti/' . $myreport->bukti) }}" class="rounded-xl border-2 border-slate-300 px-2 py-1 text-xs">
												<i class="fas fa-file-image"></i>
												Bukti -
												{{ $myreport->bukti }}
											</a>
										</div>
									@endif
								</div>
								<div class="mb-5 text-sm">
									<p>{{ $myreport->isi }}</p>
								</div>
								<div class="relative mb-8 flex justify-between rounded border p-3 shadow-xl">
									<div class="z-10 flex basis-1/4 flex-col items-center">
										<img src="{{ asset('assets/img1.png') }}" alt="Image" class="mb-2 w-8">
										<span class="text-center text-xs md:text-sm">Tulis <span class="hidden md:inline">Laporan</span></span>
									</div>
									<div class="z-10 flex basis-1/4 flex-col items-center">
										<img src="{{ asset('assets/img2.png') }}" alt="Image" class="mb-2 w-8">
										<span class="text-center text-xs md:text-sm">{!! $statusVerified !!}</span>
									</div>
									<div class="z-10 flex basis-1/4 flex-col items-center">
										<img src="{{ asset('assets/img3.png') }}" alt="Image" class="mb-2 w-8">
										<span class="text-center text-xs md:text-sm">{!! $statusProcessed !!}</span>
									</div>
									<div class="z-10 flex basis-1/4 flex-col items-center">
										<img src="{{ asset('assets/img5.png') }}" alt="Image" class="mb-2 w-8">
										<span class="text-center text-xs md:text-sm">Selesai</span>
									</div>
									<div class="absolute left-1/2 top-6 z-0 flex h-2 w-9/12 -translate-x-1/2 transform overflow-hidden rounded-full bg-[#D9D9D9]">
										<div class="flex flex-col justify-center overflow-hidden bg-[#173D7A]" role="progressbar" style="width: {{ $progress }}%" aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
								</div>
								<div id-report="{{ $myreport->id }}" class="chats-container mb-2 flex flex-col text-sm">
									@foreach ($myreport->chat as $chat)
										@if ($chat->user_id == auth()->user()->id)
											<div class="mb-3 max-w-[90%] self-end rounded-md border-r-4 border-r-slate-300 bg-[#173D7A] bg-opacity-10 p-3">
												{{ $chat->isi }}
											</div>
										@else
											<div>
												<div class="mb-1 flex items-start space-x-2">
													<img src="{{ $chat->user->profile_photo_url }}" alt="Profile" width="35" height="35" class="rounded-md border-2 border-blue-100">
													<div>
														<h6 class="font-semibold text-[#605C5C]">{{ $chat->user->name }}</h6>
														<small class="text-[#605C5C]"><span class="text-[#173D7A]">{{ $chat->created_at }}</span> &#x2022; {{ $chat->user->role }} </small>
													</div>
												</div>
												<div class="mb-3 max-w-[90%] rounded-md border-2 border-l-4 p-3">
													{{ $chat->isi }}
												</div>
											</div>
										@endif
									@endforeach
								</div>
								<div class="mb-5 flex space-x-3">
									<textarea id-report="{{ $myreport->id }}" class="reply block flex-grow resize-none rounded-md border border-slate-300 bg-white py-2 pl-3 pr-3 shadow-sm placeholder:italic placeholder:text-slate-400 focus:border-[#173D7A] focus:outline-none focus:ring-1 focus:ring-[#173D7A] sm:text-sm" placeholder="Kirim Tanggapan"></textarea>
									<button id-report="{{ $myreport->id }}" class="replyBtn h-10 w-10 rounded-md bg-[#173D7A] text-white">
										<i class="fa-solid fa-paper-plane"></i>
									</button>
								</div>
							</div>
						@endforeach
					@endif
				</div>
				<div id="content3" class="tab-content hidden rounded border-2 border-[#173D7A] md:p-5">
					@if ($allreports->isEmpty())
						<p class="text-center font-semibold">Laporan tidak ditemukan</p>
					@else
						@foreach ($allreports as $report)
							<div class="mb-5 rounded border p-4 shadow-xl">
								<div class="mb-5 flex items-start space-x-2">
									<img src="{{ $report->user->profile_photo_url }}" alt="Profile" width="43" height="43" class="rounded-md border-2 border-blue-100">
									<div>
										<h5 class="font-semibold text-[#605C5C]">{{ $report->user->name }}</h5>
										<small class="text-[#605C5C]"><span class="text-[#173D7A]">{{ $report->created_at }}</span> &#x2022; {{ $report->jenis }} - {{ $report->kategori }}</small>
									</div>
								</div>
								<div class="mb-1 text-sm">
									<h5 class="mb-2 font-medium text-[#173D7A]">{{ $report->judul }}</h5>
									<p>{{ $report->isi }}</p>
								</div>
							</div>
						@endforeach
					@endif
				</div>
			</div>
			<div class="rounded bg-white p-5 shadow-xl md:basis-3/12">
				<h4 class="mb-3 text-lg font-semibold">Laporan Terbaru</h4>
				@if ($allreports->isEmpty())
					<p class="rounded-md border-2 border-[#173D7A] py-3 text-center font-semibold">Laporan tidak ditemukan</p>
				@else
					@php
						if ($allreports->count() >= 3) {
						    $length = 3;
						} else {
						    $length = $allreports->count();
						}
					@endphp
					@for ($i = 0; $i < $length; $i++)
						<div class="mb-4 rounded border p-4 shadow-lg">
							<div class="mb-2 flex items-start space-x-2">
								<img src="{{ $allreports[$i]->user->profile_photo_url }}" alt="Profile" width="30" height="30" class="rounded-md border-2 border-blue-100">
								<div>
									<h5 class="text-[#605C5C]">{{ $allreports[$i]->user->name }}</h5>
								</div>
							</div>
							<div class="mb-1 text-sm">
								<h5 class="mb-2 font-medium text-[#173D7A]">{{ $allreports[$i]->judul }}</h5>
								<p>
									{{ mb_strlen($allreports[$i]->isi) > 100 ? mb_substr($allreports[$i]->isi, 0, 100) . '...' : $allreports[$i]->isi }}
								</p>
							</div>
						</div>
					@endfor
				@endif
			</div>
		</div>
	</div>
</x-guest-layout>
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
