<x-guest-layout>
<div class="bg-gradient-to-b from-[#173D7A] to-[#30207C] pb-10 text-white">
		<h1 class="mx-5 mb-5 text-center text-2xl font-bold leading-normal md:text-3xl">Layanan Pengaduan <br> UPT TIK Universitas Negeri Gorontalo</h1>
		<p class="font-base mx-5 text-center text-sm md:text-lg">Sampaikan keluhan anda terkait masalah layanan UPT TIK Universitas Negeri Gorontalo</p>
	</div>
	<section class="flex min-h-screen items-start justify-center bg-[url('/assets/bg1.png')] bg-100-auto bg-top bg-no-repeat">
		<div class="w-11/12 rounded border bg-white p-7 shadow-xl md:w-2/5 2xl:mt-20">
			<div class="mb-3 bg-[#002979]">
				<h3 class="rounded-sm py-3 text-center text-lg font-semibold text-white">Sampaikan Keluhan Anda</h3>
			</div>
			@auth
				<div class="mb-4 flex justify-between space-x-2 text-sm md:text-base">
					<button id="tab1" class="tab-btn tab-btn-landing basis-1/3 rounded border-2 border-[#FC2947] py-2 font-semibold text-[#FC2947]">Permintaan</button>
					<button id="tab2" class="tab-btn tab-btn-landing active basis-1/3 rounded border-2 border-[#FC2947] py-2 font-semibold text-[#FC2947]">Pengaduan</button>
					<button id="tab3" class="tab-btn tab-btn-landing basis-1/3 rounded border-2 border-[#FC2947] py-2 font-semibold text-[#FC2947]">Saran</button>
				</div>
				<div id="content1" class="tab-content hidden">
					<form method="POST" action="{{ route('report.store') }}" enctype="multipart/form-data">
						@csrf
						<input type="hidden" name="jenis" value="Permintaan">
						<small class="float-left text-xs text-[#FC2947]">(Wajib diisi)</small>
						<input type="text" name="judul" class="mb-2 w-full rounded border-2 border-[#D9D9D9] px-6 py-3 text-xs font-medium placeholder:font-semibold placeholder:text-[#B1A6A6]" placeholder="Judul Permintaan">
						<small class="float-left text-xs text-[#FC2947]">(Wajib diisi)</small>
						<textarea name="isi" id="isi_permintaan" cols="30" rows="10" class="mb-2 w-full rounded border-2 border-[#D9D9D9] px-6 py-3 text-xs font-medium placeholder:font-semibold placeholder:text-[#B1A6A6]" placeholder="Isi Permintaan"></textarea>
						<small class="float-left text-xs text-[#FC2947]">(Wajib diisi)</small>
						<input type="text" name="tanggal" class="mb-2 w-full rounded border-2 border-[#D9D9D9] px-6 py-3 text-xs font-medium placeholder:font-semibold placeholder:text-[#B1A6A6]" placeholder="Masukkan Tanggal Acara" onfocus="(this.type='date')" onblur="(this.type='text')" value="{{ old('tanggal') }}">
						@error('lampiran_permintaan')
							<small class="float-right text-[#FC2947]">{{ $message }}</small>
						@enderror
						<small class="float-left text-xs text-[#FC2947]">(Wajib diisi)</small>
						<label for="lampiran_permintaan" class="mb-3 flex w-full cursor-pointer rounded border-2 border-[#D9D9D9] px-6 py-3 text-xs font-semibold text-[#B1A6A6]" id="lampiran_permintaan_label">
							Upload Lampiran
						</label>
						<input type="file" name="lampiran" id="lampiran_permintaan" class="hidden" />
						<div class="text-center">
							<button type="submit" class="rounded-xl bg-[#FC2947] px-8 py-2 font-semibold text-white">
								@auth
									KIRIM PERMINTAAN
								@endauth
								@guest
									LOGIN DULU
								@endguest
							</button>
						</div>
					</form>
				</div>
				<div id="content2" class="tab-content">
					<form method="POST" action="{{ route('report.store') }}" enctype="multipart/form-data">
						@csrf
						<input type="hidden" name="jenis" value="Pengaduan">
						@error('judul')
							<small class="float-right text-[#FC2947]">{{ $message }}</small>
						@enderror
						<small class="float-left text-xs text-[#FC2947]">(Wajib diisi)</small>
						<input type="text" name="judul" class="mb-2 w-full rounded border-2 border-[#D9D9D9] px-6 py-3 text-xs font-medium placeholder:font-semibold placeholder:text-[#B1A6A6]" placeholder="Judul Pengaduan" value="{{ old('judul') }}">
						@error('isi')
							<small class="float-right text-[#FC2947]">{{ $message }}</small>
						@enderror
						<small class="float-left text-xs text-[#FC2947]">(Wajib diisi)</small>
						<textarea name="isi" cols="30" rows="10" class="mb-2 w-full rounded border-2 border-[#D9D9D9] px-6 py-3 text-xs font-medium placeholder:font-semibold placeholder:text-[#B1A6A6]" placeholder="Isi Aduan">{{ old('isi') }}</textarea>
						@error('tanggal')
							<small class="float-right text-[#FC2947]">{{ $message }}</small>
						@enderror
						<small class="float-left text-xs text-[#FC2947]">(Wajib diisi)</small>
						<input type="text" name="tanggal" class="mb-2 w-full rounded border-2 border-[#D9D9D9] px-6 py-3 text-xs font-medium placeholder:font-semibold placeholder:text-[#B1A6A6]" placeholder="Masukkan Deadline Pengaduan" onfocus="(this.type='date')" onblur="(this.type='text')" value="{{ old('tanggal') }}">
						<label for="lampiran_pengaduan" class="mb-3 flex cursor-pointer rounded border-2 border-[#D9D9D9] px-6 py-3 text-xs font-semibold text-[#B1A6A6]" id="lampiran_pengaduan_label">
							Upload Lampiran
						</label>
						<input type="file" name="lampiran" id="lampiran_pengaduan" class="hidden" />
						<div class="text-center">
							@auth
								<button type="submit" class="rounded-xl bg-[#FC2947] px-8 py-2 font-semibold text-white">
									LAPOR
								</button>
							@endauth
							@guest
								<div class="mt-5">
									<a href="{{ route('login', ['from' => 'home']) }}" class="rounded-xl bg-[#FC2947] px-8 py-2 font-semibold text-white">
										LOGIN DULU
									</a>
								</div>
							@endguest
						</div>
					</form>
				</div>
				<div id="content3" class="tab-content hidden">
					<form method="POST" action="{{ route('report.store') }}" enctype="multipart/form-data">
						@csrf
						<input type="hidden" name="jenis" value="Saran">
						<small class="float-left text-xs text-[#FC2947]">(Wajib diisi)</small>
						<input type="text" name="judul" class="mb-2 w-full rounded border-2 border-[#D9D9D9] px-6 py-3 text-xs font-medium placeholder:font-semibold placeholder:text-[#B1A6A6]" placeholder="Judul Saran">
						<small class="float-left text-xs text-[#FC2947]">(Wajib diisi)</small>
						<textarea name="isi" id="isi_saran" cols="30" rows="10" class="mb-2 w-full rounded border-2 border-[#D9D9D9] px-6 py-3 text-xs font-medium placeholder:font-semibold placeholder:text-[#B1A6A6]" placeholder="Isi Saran">{{ old('isi') }}</textarea>
						<input type="hidden" name="tanggal" value="{{ now()->addDay()->format('Y-m-d') }}">
						{{-- <label for="lampiran_saran" class="flex rounded border-2 border-[#D9D9D9] text-xs py-3 px-6 mb-3 text-[#B1A6A6] font-semibold cursor-pointer" id="lampiran_saran_label">
                        Upload Lampiran
                    </label>
                    <input type="file" name="lampiran" id="lampiran_saran" class="hidden" /> --}}
						<div class="text-center">
							<button type="submit" class="rounded-xl bg-[#FC2947] px-8 py-2 font-semibold text-white">
								@auth
									KIRIM SARAN
								@endauth
								@guest
									LOGIN DULU
								@endguest
							</button>
						</div>
					</form>
				</div>
			@endauth
			@guest
				<div class="flex mt-5">
					<a href="{{ route('login') }}" class="w-full rounded-lg bg-[#FC2947] px-8 py-2 font-semibold text-white text-center">
						LOGIN
					</a>
				</div>
			@endguest
		</div>
	</section>
	<section class="my-20 md:my-36">
		<div class="container mx-auto hidden justify-between px-20 text-[#092E63] md:flex">
			<div class="flex basis-1/6 flex-col items-center">
				<img src="{{ asset('assets/img1.png') }}" alt="Tulis Laporan" width="50" class="mb-3">
				<h5 class="text-base font-semibold">Tulis Laporan</h5>
				<p class="text-center text-sm">Sampaikan aduan, permintaan, dan saran anda secara jelas dan lengkap</p>
			</div>
			<div class="flex basis-1/6 flex-col items-center">
				<img src="{{ asset('assets/img2.png') }}" alt="Proses Verifikasi" width="50" class="mb-3">
				<h5 class="text-base font-semibold">Proses Verifikasi</h5>
				<p class="text-center text-sm">Admin akan memverifikasi laporan Anda dan akan meneruskan ke unit yang bersangkutan</p>
			</div>
			<div class="flex basis-1/6 flex-col items-center">
				<img src="{{ asset('assets/img3.png') }}" alt="Proses Tindak Lanjut" width="50" class="mb-3">
				<h5 class="text-base font-semibold">Proses Tindak Lanjut</h5>
				<p class="text-center text-sm">Unit yang bersangkutan akan menindaklanjuti dan membalas laporan Anda</p>
			</div>
			<div class="flex basis-1/6 flex-col items-center">
				<img src="{{ asset('assets/img4.png') }}" alt="Beri Tanggapan" width="50" class="mb-3">
				<h5 class="text-base font-semibold">Beri Tanggapan</h5>
				<p class="text-center text-sm">Anda bisa menanggapi kembali balasan dari unit yang bersangkutan</p>
			</div>
			<div class="flex basis-1/6 flex-col items-center">
				<img src="{{ asset('assets/img5.png') }}" alt="Selesai" width="50" class="mb-3">
				<h5 class="text-base font-semibold">Selesai</h5>
				<p class="text-center text-sm">Laporan Anda akan ditindaklanjuti hingga terselesaikan</p>
			</div>
		</div>
		<div class="px-5 md:hidden">
			<div class="flex items-center space-x-3">
				<img src="{{ asset('assets/img1.png') }}" alt="Tulis Laporan" width="50">
				<div>
					<h5 class="text-base font-semibold">Tulis Laporan</h5>
					<p class="text-sm">Sampaikan aduan, permintaan, dan saran anda secara jelas dan lengkap</p>
				</div>
			</div>
			<div class="mx-6">
				<div class="h-5 border-l-4 border-[#173D7A]"></div>
				<div class="w-full border-b-4 border-[#173D7A]"></div>
				<div class="h-5 border-r-4 border-[#173D7A]"></div>
			</div>
			<div class="flex items-center space-x-3">
				<div>
					<h5 class="text-right text-base font-semibold">Proses Verifikasi</h5>
					<p class="text-right text-sm">Admin akan memverifikasi laporan Anda dan akan meneruskan ke unit yang bersangkutan</p>
				</div>
				<img src="{{ asset('assets/img2.png') }}" alt="Proses Verifikasi" width="50">
			</div>
			<div class="mx-6">
				<div class="h-5 border-r-4 border-[#173D7A]"></div>
				<div class="w-full border-b-4 border-[#173D7A]"></div>
				<div class="h-5 border-l-4 border-[#173D7A]"></div>
			</div>
			<div class="flex items-center space-x-3">
				<img src="{{ asset('assets/img3.png') }}" alt="Proses Tindak Lanjut" width="50">
				<div>
					<h5 class="text-base font-semibold">Proses Tindak Lanjut</h5>
					<p class="text-sm">Unit yang bersangkutan akan menindaklanjuti dan membalas laporan Anda</p>
				</div>
			</div>
			<div class="mx-6">
				<div class="h-5 border-l-4 border-[#173D7A]"></div>
				<div class="w-full border-b-4 border-[#173D7A]"></div>
				<div class="h-5 border-r-4 border-[#173D7A]"></div>
			</div>
			<div class="flex items-center space-x-3">
				<div>
					<h5 class="text-right text-base font-semibold">Beri Tanggapan</h5>
					<p class="text-right text-sm">Anda bisa menanggapi kembali balasan dari unit yang bersangkutan</p>
				</div>
				<img src="{{ asset('assets/img4.png') }}" alt="Beri Tanggapan" width="50">
			</div>
			<div class="mx-6">
				<div class="h-5 border-r-4 border-[#173D7A]"></div>
				<div class="w-full border-b-4 border-[#173D7A]"></div>
				<div class="h-5 border-l-4 border-[#173D7A]"></div>
			</div>
			<div class="flex items-center space-x-3">
				<img src="{{ asset('assets/img5.png') }}" alt="Selesai" width="50">
				<div>
					<h5 class="text-base font-semibold">Selesai</h5>
					<p class="text-sm">Laporan Anda akan ditindaklanjuti hingga terselesaikan</p>
				</div>
			</div>
		</div>
	</section>
	<script>
		// Add event listeners to the file inputs to update the label text with the selected file names

		document.getElementById('lampiran_saran').addEventListener('change', function() {
			updateLabel('lampiran_saran', 'lampiran_saran_label');
		});

		document.getElementById('lampiran_permintaan').addEventListener('change', function() {
			updateLabel('lampiran_permintaan', 'lampiran_permintaan_label');
		});

		document.getElementById('lampiran_pengaduan').addEventListener('change', function() {
			updateLabel('lampiran_pengaduan', 'lampiran_pengaduan_label');
		});

		function updateLabel(inputId, labelId) {
			const input = document.getElementById(inputId);
			const label = document.getElementById(labelId);

			if (input.files && input.files.length > 0) {
				label.textContent = input.files[0].name;
			} else {
				label.textContent = 'Upload Lampiran';
			}
		}
	</script>
</x-guest-layout>
