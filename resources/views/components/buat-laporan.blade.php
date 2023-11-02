<button class="{{ $class }}" data-modal-target="defaultModal" data-modal-toggle="defaultModal">Buat Laporan</button>
<!-- Modal -->
<div id="defaultModal" tabindex="-1" aria-hidden="true" class="fixed left-0 right-0 top-0 z-50 hidden h-[calc(100%-1rem)] max-h-full w-full overflow-y-auto overflow-x-hidden p-4 md:inset-0 text-gray-700">
  <div class="relative max-h-full w-full max-w-2xl">
    <!-- Modal content -->
    <div class="relative rounded-lg bg-white shadow dark:bg-gray-700">
      <!-- Modal header -->
      <div class="flex items-start justify-between rounded-t border-b p-4 dark:border-gray-600">
        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
          Buat Laporan
        </h3>
        <button type="button" class="ml-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="defaultModal">
          <svg class="h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
          </svg>
          <span class="sr-only">Close modal</span>
        </button>
      </div>
      <!-- Modal body -->
      <div class="p-6">
        <div class="bg-[#002979]">
          <h3 class="rounded-sm py-3 text-center text-lg font-semibold text-white">Sampaikan Keluhan Anda</h3>
        </div>
        @auth
          <div class="mb-4 flex justify-between space-x-2 text-sm md:text-base mt-5">
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
          <div class="mt-5 flex">
            <a href="{{ route('login') }}" class="w-full rounded-lg bg-[#FC2947] px-8 py-2 text-center font-semibold text-white">
              LOGIN
            </a>
          </div>
        @endguest
      </div>
    </div>
  </div>
</div>