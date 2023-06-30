<x-guest-layout> 
    <div class="bg-[#173D7A] text-white pb-10">
        <h1 class="text-center text-3xl font-bold mb-5 leading-normal">Layanan Saran <br> UPT TIK Universitas Negeri Gorontalo</h1>
        <p class="text-center text-lg font-base">Sampaikan keluhan anda terkait masalah layanan UPT TIK Universitas Negeri Gorontalo</p>
    </div>
    <section class="flex justify-center bg-[url('/assets/bg1.png')] bg-no-repeat bg-top bg-contain">
        <div class="w-2/5 border p-7 bg-white rounded-sm shadow-xl">
            <div class="bg-[#002979] mb-3">
                <h3 class="text-center text-white py-3 text-lg font-semibold rounded-sm">Sampaikan Keluhan Anda</h3>
            </div>
            <div class="flex justify-between space-x-2 mb-4">
                <button id="tab1" class="tab-btn basis-1/3 text-[#FC2947] font-semibold py-2 border-2 border-[#FC2947] rounded">Permintaan</button>
                <button id="tab2" class="tab-btn active basis-1/3 text-[#FC2947] font-semibold py-2 border-2 border-[#FC2947] rounded">Pengaduan</button>
                <button id="tab3" class="tab-btn basis-1/3 text-[#FC2947] font-semibold py-2 border-2 border-[#FC2947] rounded">Saran</button>
            </div>
            <div id="content1" class="tab-content hidden">
                <input type="text" class="w-full rounded border-2 border-[#D9D9D9] text-xs py-3 px-6 font-semibold placeholder:text-[#B1A6A6] mb-2" placeholder="Judul Permintaan">
                <select name="kategori_permintaan" id="kategori_permintaan" class="w-full rounded border-2 border-[#D9D9D9] text-xs py-3 px-6 mb-2">
                    <option hidden>Kategori Permintaan</option>
                    <option value="Kategori A">Kategori A</option>
                    <option value="Kategori B">Kategori B</option>
                    <option value="Kategori C">Kategori C</option>
                </select>
                <textarea name="isi_permintaan" id="isi_permintaan" cols="30" rows="10" class="w-full rounded border-2 border-[#D9D9D9] text-xs py-3 px-6 font-semibold placeholder:text-[#B1A6A6] mb-2" placeholder="Isi Permintaan"></textarea>
                <input type="date" class="w-full rounded border-2 border-[#D9D9D9] text-xs py-3 px-6 placeholder:text-[#B1A6A6] mb-2" placeholder="Tanggal Permintaan">
                <input type="file" class="w-full rounded border-2 border-[#D9D9D9] text-xs py-3 px-6 placeholder:text-[#B1A6A6] mb-3
                    file:mr-4
                    file:border-0
                    file:bg-white
                    file:text-sm
                ">
                <div class="text-center">
                    <button class="bg-[#FC2947] px-8 py-2 rounded-xl font-semibold text-white">KIRIM PERMINTAAN</button>
                </div>
            </div>
            <div id="content2" class="tab-content">
                <input type="text" class="w-full rounded border-2 border-[#D9D9D9] text-xs py-3 px-6 font-semibold placeholder:text-[#B1A6A6] mb-2" placeholder="Judul Pengaduan">
                <select name="kategori_pengaduan" id="kategori_pengaduan" class="w-full rounded border-2 border-[#D9D9D9] text-xs py-3 px-6 mb-2">
                    <option hidden>Kategori Pengaduan</option>
                    <option value="Kategori A">Kategori A</option>
                    <option value="Kategori B">Kategori B</option>
                    <option value="Kategori C">Kategori C</option>
                </select>
                <textarea name="isi_pengaduan" id="isi_pengaduan" cols="30" rows="10" class="w-full rounded border-2 border-[#D9D9D9] text-xs py-3 px-6 font-semibold placeholder:text-[#B1A6A6] mb-2" placeholder="Isi Aduan"></textarea>
                <input type="text" class="w-full rounded border-2 border-[#D9D9D9] text-xs py-3 px-6 placeholder:text-[#B1A6A6] font-semibold mb-2" placeholder="Masukkan Deadline Pengaduan" onfocus="(this.type='date')" onblur="(this.type='text')">
                <label for="lampiran_pengaduan" class="flex rounded border-2 border-[#D9D9D9] text-xs py-3 px-6 mb-3 text-[#B1A6A6] font-semibold cursor-pointer">
                    Upload Lampiran
                    <input type="file" id="lampiran_pengaduan" class="hidden" />
                </label>
                <div class="text-center">
                    <button class="bg-[#FC2947] px-8 py-2 rounded-xl font-semibold text-white">LAPOR!!!</button>
                </div>
            </div>
            <div id="content3" class="tab-content hidden">
                <input type="text" class="w-full rounded border-2 border-[#D9D9D9] text-xs py-3 px-6 font-semibold placeholder:text-[#B1A6A6] mb-2" placeholder="Judul Saran">
                <select name="kategori_saran" id="kategori_saran" class="w-full rounded border-2 border-[#D9D9D9] text-xs py-3 px-6 mb-2">
                    <option hidden>Kategori Saran</option>
                    <option value="Kategori A">Kategori A</option>
                    <option value="Kategori B">Kategori B</option>
                    <option value="Kategori C">Kategori C</option>
                </select>
                <textarea name="isi_saran" id="isi_saran" cols="30" rows="10" class="w-full rounded border-2 border-[#D9D9D9] text-xs py-3 px-6 font-semibold placeholder:text-[#B1A6A6] mb-2" placeholder="Isi Saran"></textarea>
                <input type="date" class="w-full rounded border-2 border-[#D9D9D9] text-xs py-3 px-6 placeholder:text-[#B1A6A6] mb-2" placeholder="Tanggal Saran">
                <input type="file" class="w-full rounded border-2 border-[#D9D9D9] text-xs py-3 px-6 placeholder:text-[#B1A6A6] mb-3
                    file:mr-4
                    file:border-0
                    file:bg-white
                    file:text-sm
                ">
                <div class="text-center">
                    <button class="bg-[#FC2947] px-8 py-2 rounded-xl font-semibold text-white">KIRIM SARAN</button>
                </div>
            </div>
        </div>
    </section>
    <section class="my-36">
        <div class="container mx-auto px-20 flex justify-between text-[#092E63]">
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
    </section>
</x-guest-layout> 
