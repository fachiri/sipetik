<x-guest-layout>
	<div class="bg-gradient-to-b from-[#CB004A] to-[#32187D] pt-14">
		<div class="flex flex-col text-white md:flex-row md:space-x-10 w-5/6 mx-auto">
			<div class="mx-auto basis-3/5 pb-5">
				<h1 class="mb-4 text-2xl font-bold leading-10 leading-normal md:text-5xl">Layanan Pengaduan UPT TIK Universitas Negeri Gorontalo</h1>
				<p class="font-base mb-4 text-sm md:text-lg">Sistem Informasi Layanan Pengaduan UPT TIK Universitas Negeri Gorontalo adalah sebuah platform yang dirancang untuk memfasilitasi pengaduan terkait layanan teknologi informasi dan komunikasi (TIK) di lingkungan Universitas Negeri Gorontalo.</p>
				<a href="{{ route('report') }}" class="rounded-lg border-2 bg-[#FC2947] px-4 py-1 text-center font-semibold md:mb-0">
					Lapor
				</a>
			</div>
			<div class="basis-2/5 flex justify-center">
				<img src="{{ asset('assets/img10.png') }}" alt="Ilustrasi" class="hidden md:block" style="height: 80%">
			</div>
		</div>
	</div>
	<img src="{{ asset('assets/bg4.svg') }}" alt="">
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
