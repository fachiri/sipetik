<x-guest-layout>
    <div class="bg-[#173D7A] text-white pb-10">
        <h1 class="text-center text-2xl mx-5 md:text-3xl font-bold mb-5 leading-normal">Layanan Pengaduan <br> UPT TIK Universitas Negeri Gorontalo</h1>
        <p class="text-center text-sm md:text-lg mx-5 font-base">Sampaikan keluhan anda terkait masalah layanan UPT TIK Universitas Negeri Gorontalo</p>
    </div>
    <section class="flex justify-center items-start bg-[url('/assets/bg1.png')] bg-no-repeat bg-top bg-100-auto">
        <div class="w-11/12 md:w-2/5 2xl:mt-20 border p-7 bg-white rounded shadow-xl">
            <div class="bg-[#002979] mb-3">
                <h3 class="text-center text-white py-3 text-lg font-semibold rounded-sm">Sampaikan Keluhan Anda</h3>
            </div>
            <div class="flex justify-between space-x-2 mb-4 text-sm md:text-base">
                <button id="tab1" class="tab-btn tab-btn-landing basis-1/3 text-[#FC2947] font-semibold py-2 border-2 border-[#FC2947] rounded">Permintaan</button>
                <button id="tab2" class="tab-btn tab-btn-landing active basis-1/3 text-[#FC2947] font-semibold py-2 border-2 border-[#FC2947] rounded">Pengaduan</button>
                <button id="tab3" class="tab-btn tab-btn-landing basis-1/3 text-[#FC2947] font-semibold py-2 border-2 border-[#FC2947] rounded">Saran</button>
            </div>
            <div id="content1" class="tab-content hidden">
                <form method="POST" action="{{ route('report.store') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="jenis" value="Permintaan">
                    <small class="text-[#FC2947] float-left text-xs">(Wajib diisi)</small>
                    <input type="text" name="judul" class="w-full rounded border-2 border-[#D9D9D9] text-xs py-3 px-6 font-medium placeholder:text-[#B1A6A6] placeholder:font-semibold mb-2" placeholder="Judul Permintaan">
                    <small class="text-[#FC2947] float-left text-xs">(Wajib diisi)</small>
                    <textarea name="isi" id="isi_permintaan" cols="30" rows="10" class="w-full rounded border-2 border-[#D9D9D9] text-xs py-3 px-6 font-medium placeholder:text-[#B1A6A6] placeholder:font-semibold mb-2" placeholder="Isi Permintaan"></textarea>
                    <small class="text-[#FC2947] float-left text-xs">(Wajib diisi)</small>
                    <input type="text" name="tanggal" class="w-full rounded border-2 border-[#D9D9D9] text-xs py-3 px-6 placeholder:text-[#B1A6A6] placeholder:font-semibold font-medium mb-2" placeholder="Masukkan Tanggal Acara" onfocus="(this.type='date')" onblur="(this.type='text')" value="{{ old('tanggal') }}">
                    @error('lampiran_permintaan')
                        <small class="text-[#FC2947] float-right">{{ $message }}</small>
                    @enderror
                    <small class="text-[#FC2947] float-left text-xs">(Wajib diisi)</small>
                    <label for="lampiran_permintaan" class="w-full flex rounded border-2 border-[#D9D9D9] text-xs py-3 px-6 mb-3 text-[#B1A6A6] font-semibold cursor-pointer" id="lampiran_permintaan_label">
                        Upload Lampiran
                    </label>
                    <input type="file" name="lampiran" id="lampiran_permintaan" class="hidden" />
                    <div class="text-center">
                        <button type="submit" class="bg-[#FC2947] px-8 py-2 rounded-xl font-semibold text-white">
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
                        <small class="text-[#FC2947] float-right">{{ $message }}</small>
                    @enderror
                    <small class="text-[#FC2947] float-left text-xs">(Wajib diisi)</small>
                    <input type="text" name="judul" class="w-full rounded border-2 border-[#D9D9D9] text-xs py-3 px-6 font-medium placeholder:text-[#B1A6A6] placeholder:font-semibold mb-2" placeholder="Judul Pengaduan" value="{{ old('judul') }}">
                    @error('isi')
                        <small class="text-[#FC2947] float-right">{{ $message }}</small>
                    @enderror
                    <small class="text-[#FC2947] float-left text-xs">(Wajib diisi)</small>
                    <textarea name="isi" cols="30" rows="10" class="w-full rounded border-2 border-[#D9D9D9] text-xs py-3 px-6 font-medium placeholder:text-[#B1A6A6] placeholder:font-semibold mb-2" placeholder="Isi Aduan">{{ old('isi') }}</textarea>
                    @error('tanggal')
                        <small class="text-[#FC2947] float-right">{{ $message }}</small>
                    @enderror
                    <small class="text-[#FC2947] float-left text-xs">(Wajib diisi)</small>
                    <input type="text" name="tanggal" class="w-full rounded border-2 border-[#D9D9D9] text-xs py-3 px-6 placeholder:text-[#B1A6A6] placeholder:font-semibold font-medium mb-2" placeholder="Masukkan Deadline Pengaduan" onfocus="(this.type='date')" onblur="(this.type='text')" value="{{ old('tanggal') }}">
                    <label for="lampiran_pengaduan" class="flex rounded border-2 border-[#D9D9D9] text-xs py-3 px-6 mb-3 text-[#B1A6A6] font-semibold cursor-pointer" id="lampiran_pengaduan_label">
                        Upload Lampiran
                    </label>
                    <input type="file" name="lampiran" id="lampiran_pengaduan" class="hidden" />
                    <div class="text-center">
                        @auth
                            <button type="submit" class="bg-[#FC2947] px-8 py-2 rounded-xl font-semibold text-white">
                                LAPOR
                            </button>
                        @endauth
                        @guest
                            <div class="mt-5">
                                <a href="{{ route('login', ['from' => 'home']) }}" class="bg-[#FC2947] px-8 py-2 rounded-xl font-semibold text-white">
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
                    <small class="text-[#FC2947] float-left text-xs">(Wajib diisi)</small>
                    <input type="text" name="judul" class="w-full rounded border-2 border-[#D9D9D9] text-xs py-3 px-6 font-medium placeholder:text-[#B1A6A6] placeholder:font-semibold mb-2" placeholder="Judul Saran">
                    <small class="text-[#FC2947] float-left text-xs">(Wajib diisi)</small>
                    <textarea name="isi" id="isi_saran" cols="30" rows="10" class="w-full rounded border-2 border-[#D9D9D9] text-xs py-3 px-6 font-medium placeholder:text-[#B1A6A6] placeholder:font-semibold mb-2" placeholder="Isi Saran">{{ old('isi') }}</textarea>
                    <input type="hidden" name="tanggal" value="{{ now()->addDay()->format('Y-m-d') }}">
                    {{-- <label for="lampiran_saran" class="flex rounded border-2 border-[#D9D9D9] text-xs py-3 px-6 mb-3 text-[#B1A6A6] font-semibold cursor-pointer" id="lampiran_saran_label">
                        Upload Lampiran
                    </label>
                    <input type="file" name="lampiran" id="lampiran_saran" class="hidden" /> --}}
                    <div class="text-center">
                        <button type="submit" class="bg-[#FC2947] px-8 py-2 rounded-xl font-semibold text-white">
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
        </div>
    </section>
    <section class="my-20 md:my-36">
        <div class="container mx-auto px-20 hidden md:flex justify-between text-[#092E63]">
            <div class="basis-1/6 flex flex-col items-center">
                <img src="{{ asset('assets/img1.png') }}" alt="Tulis Laporan" width="50" class="mb-3">
                <h5 class="text-base font-semibold">Tulis Laporan</h5>
                <p class="text-center text-sm">Sampaikan aduan, permintaan, dan saran anda secara jelas dan lengkap</p>
            </div>
            <div class="basis-1/6 flex flex-col items-center">
                <img src="{{ asset('assets/img2.png') }}" alt="Proses Verifikasi" width="50" class="mb-3">
                <h5 class="text-base font-semibold">Proses Verifikasi</h5>
                <p class="text-center text-sm">Admin akan memverifikasi laporan Anda dan akan meneruskan ke unit yang bersangkutan</p>
            </div>
            <div class="basis-1/6 flex flex-col items-center">
                <img src="{{ asset('assets/img3.png') }}" alt="Proses Tindak Lanjut" width="50" class="mb-3">
                <h5 class="text-base font-semibold">Proses Tindak Lanjut</h5>
                <p class="text-center text-sm">Unit yang bersangkutan akan menindaklanjuti dan membalas laporan Anda</p>
            </div>
            <div class="basis-1/6 flex flex-col items-center">
                <img src="{{ asset('assets/img4.png') }}" alt="Beri Tanggapan" width="50" class="mb-3">
                <h5 class="text-base font-semibold">Beri Tanggapan</h5>
                <p class="text-center text-sm">Anda bisa menanggapi kembali balasan dari unit yang bersangkutan</p>
            </div>
            <div class="basis-1/6 flex flex-col items-center">
                <img src="{{ asset('assets/img5.png') }}" alt="Selesai" width="50" class="mb-3">
                <h5 class="text-base font-semibold">Selesai</h5>
                <p class="text-center text-sm">Laporan Anda akan ditindaklanjuti hingga terselesaikan</p>
            </div>
        </div>
        <div class="md:hidden px-5">
            <div class="flex space-x-3 items-center">
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
            <div class="flex space-x-3 items-center">
                <div>
                    <h5 class="text-base font-semibold text-right">Proses Verifikasi</h5>
                    <p class="text-sm text-right">Admin akan memverifikasi laporan Anda dan akan meneruskan ke unit yang bersangkutan</p>
                </div>
                <img src="{{ asset('assets/img2.png') }}" alt="Proses Verifikasi" width="50">
            </div>
            <div class="mx-6">
                <div class="h-5 border-r-4 border-[#173D7A]"></div>
                <div class="w-full border-b-4 border-[#173D7A]"></div>
                <div class="h-5 border-l-4 border-[#173D7A]"></div>
            </div>
            <div class="flex space-x-3 items-center">
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
            <div class="flex space-x-3 items-center">
                <div>
                    <h5 class="text-base font-semibold text-right">Beri Tanggapan</h5>
                    <p class="text-sm text-right">Anda bisa menanggapi kembali balasan dari unit yang bersangkutan</p>
                </div>
                <img src="{{ asset('assets/img4.png') }}" alt="Beri Tanggapan" width="50">
            </div>
            <div class="mx-6">
                <div class="h-5 border-r-4 border-[#173D7A]"></div>
                <div class="w-full border-b-4 border-[#173D7A]"></div>
                <div class="h-5 border-l-4 border-[#173D7A]"></div>
            </div>
            <div class="flex space-x-3 items-center">
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


