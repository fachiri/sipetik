<x-guest-layout> 
    <div class="w-screen min-h-screen bg-[url('/assets/bg3.png')] bg-top mb-20 bg-no-repeat bg-100-auto">
        <div class="container mx-auto flex flex-col md:flex-row space-y-10 md:space-y-0 md:space-x-10 md:items-start px-5 md:px-0">
            <div class="basis-full md:basis-9/12 bg-white p-5 shadow-xl rounded">
                <div class="flex flex-col md:flex-row justify-between items-start text-[#173D7A] mb-8 md:mb-10 pb-5 md:pb-0 space-y-5 md:space-y-0 border-b-2 md:border-0">
                    <div class="flex items-center space-x-3">
                        <span class="bg-[#D4ECFF] rounded-full p-2">
                            <img src="{{ asset('assets/img9.png') }}" alt="Profile Image" class="w-10">
                        </span>
                        <div>
                            <h5 class="font-semibold">{{ auth()->user()->name }}</h5>
                            <span class="text-xs md:text-sm text-center">{{ auth()->user()->email }}</span>
                        </div>
                    </div>
                    <div class="w-full md:w-auto flex justify-between md:space-x-20">
                        <div class="basis-1/3 flex flex-col items-center">
                            <span class="text-xs md:text-sm text-center">Terverifikasi</span>
                            <span class="text-3xl font-semibold">10</span>
                        </div>
                        <div class="basis-1/3 flex flex-col items-center">
                            <span class="text-xs md:text-sm text-center">Proses</span>
                            <span class="text-3xl font-semibold">2</span>
                        </div>
                        <div class="basis-1/3 flex flex-col items-center">
                            <span class="text-xs md:text-sm text-center">Selesai</span>
                            <span class="text-3xl font-semibold">0</span>
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
                        @foreach ($myreports as $myreport)
                        <div class="border-b-2 mb-5">
                            <div class="flex items-start space-x-2">
                                <img src="{{ asset('assets/img8.png') }}" alt="Profile">
                                <div>
                                    <h5 class="font-semibold text-[#605C5C]">{{ $myreport->judul }}</h5>
                                    <small class="text-[#605C5C]"><span class="text-[#173D7A]">2 Menit yang lalu</span> &#x2022; {{ $myreport->jenis }} - {{ $myreport->kategori }}</small>
                                </div>
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
                                    <span class="text-xs md:text-sm text-center">Verifikasi</span>
                                </div>
                                <div class="basis-1/4 flex flex-col items-center z-10">
                                    <img src="{{ asset('assets/img3.png') }}" alt="Image" class="w-8 mb-2">
                                    <span class="text-xs md:text-sm text-center">Proses</span>
                                </div>
                                <div class="basis-1/4 flex flex-col items-center z-10">
                                    <img src="{{ asset('assets/img5.png') }}" alt="Image" class="w-8 mb-2">
                                    <span class="text-xs md:text-sm text-center">Selesai</span>
                                </div>
                                <div class="flex w-9/12 h-2 bg-[#D9D9D9] rounded-full overflow-hidden absolute top-6 left-1/2 transform -translate-x-1/2 z-0">
                                    <div class="flex flex-col justify-center overflow-hidden bg-[#173D7A]" role="progressbar" style="width: 33%" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <p class="font-semibold text-center">Periksa whatsapp anda, karena sistem akan memberikan tanggapan terkait laporan anda di whatsapp</p>
                    @endif
                </div>
                <div id="content2" class="tab-content border-2 border-[#173D7A] p-5 rounded hidden">
                    <div class="border-b-2 mb-8">
                        <div class="flex items-start space-x-2 mb-5">
                            <img src="{{ asset('assets/img8.png') }}" alt="Profile">
                            <div>
                                <h5 class="font-semibold text-[#605C5C]">Wifi di area kampus satu dikasih free akses</h5>
                                <small class="text-[#605C5C]"><span class="text-[#173D7A]">2 Menit yang lalu</span> &#x2022; Pengaduan - Infrastruktur Jaringan</small>
                            </div>
                        </div>
                        <div class="text-sm mb-5">
                            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Commodi impedit provident inventore earum dignissimos ipsam tempora, vitae facilis omnis, fugit tempore expedita ex. Vel corporis ipsum inventore corrupti blanditiis impedit.</p>
                        </div>
                        <div class="flex justify-between relative shadow-xl p-3 mb-7 border rounded">
                            <div class="basis-1/4 flex flex-col items-center z-10">
                                <img src="{{ asset('assets/img1.png') }}" alt="Image" class="w-8 mb-2">
                                <span class="text-xs md:text-sm text-center">Tulis <span class="hidden md:inline">Laporan</span></span>
                            </div>
                            <div class="basis-1/4 flex flex-col items-center z-10">
                                <img src="{{ asset('assets/img2.png') }}" alt="Image" class="w-8 mb-2">
                                <span class="text-xs md:text-sm text-center">Verifikasi</span>
                            </div>
                            <div class="basis-1/4 flex flex-col items-center z-10">
                                <img src="{{ asset('assets/img3.png') }}" alt="Image" class="w-8 mb-2">
                                <span class="text-xs md:text-sm text-center">Proses</span>
                            </div>
                            <div class="basis-1/4 flex flex-col items-center z-10">
                                <img src="{{ asset('assets/img5.png') }}" alt="Image" class="w-8 mb-2">
                                <span class="text-xs md:text-sm text-center">Selesai</span>
                            </div>
                            <div class="flex w-9/12 h-2 bg-[#D9D9D9] rounded-full overflow-hidden absolute top-6 left-1/2 transform -translate-x-1/2 z-0">
                                <div class="flex flex-col justify-center overflow-hidden bg-[#173D7A]" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="text-sm flex flex-col">
                            <div class="border-2 p-3 rounded-md max-w-[90%] mb-3">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Similique natus eius consequuntur saepe quidem alias consectetur accusamus aperiam, nesciunt ratione.
                            </div>
                            <div class="bg-[#173D7A] bg-opacity-10 p-3 rounded-md max-w-[90%] mb-3 self-end">
                                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Mollitia, tenetur.
                            </div>
                            <div class="border-2 p-3 rounded-md max-w-[90%] mb-3">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur consequuntur pariatur vero dignissimos, sed labore similique tempore maxime natus facere inventore quia doloribus eum nobis consectetur qui cupiditate optio laboriosam!
                            </div>
                            <div class="bg-[#173D7A] bg-opacity-10 p-3 rounded-md max-w-[90%] mb-3 self-end">
                                Lorem ipsum dolor sit amet 🙏
                            </div>
                        </div>
                        <div class="flex space-x-3 mb-5">
                            <textarea class="flex-grow h-10 placeholder:italic placeholder:text-slate-400 block bg-white border border-slate-300 rounded-md py-2 pl-9 pr-3 shadow-sm focus:outline-none focus:border-[#173D7A] focus:ring-[#173D7A] focus:ring-1 sm:text-sm resize-none" placeholder="Kirim Tanggapan"></textarea>
                            <button class="w-10 h-10 rounded-md bg-[#173D7A] text-white">
                                <i class="fa-solid fa-paper-plane"></i>
                            </button>
                        </div>
                    </div>
                    <div class="border-b-2 mb-8">
                        <div class="flex items-start space-x-2 mb-5">
                            <img src="{{ asset('assets/img8.png') }}" alt="Profile">
                            <div>
                                <h5 class="font-semibold text-[#605C5C]">Wifi di area kampus satu dikasih free akses</h5>
                                <small class="text-[#605C5C]"><span class="text-[#173D7A]">2 Menit yang lalu</span> &#x2022; Pengaduan - Infrastruktur Jaringan</small>
                            </div>
                        </div>
                        <div class="text-sm mb-5">
                            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Commodi impedit provident inventore earum dignissimos ipsam tempora, vitae facilis omnis, fugit tempore expedita ex. Vel corporis ipsum inventore corrupti blanditiis impedit.</p>
                        </div>
                        <div class="flex justify-between relative shadow-xl p-3 mb-8 border rounded">
                            <div class="basis-1/4 flex flex-col items-center z-10">
                                <img src="{{ asset('assets/img1.png') }}" alt="Image" class="w-8 mb-2">
                                <span class="text-xs md:text-sm text-center">Tulis <span class="hidden md:inline">Laporan</span></span>
                            </div>
                            <div class="basis-1/4 flex flex-col items-center z-10">
                                <img src="{{ asset('assets/img2.png') }}" alt="Image" class="w-8 mb-2">
                                <span class="text-xs md:text-sm text-center">&#10060; Verifikasi</span>
                            </div>
                            <div class="basis-1/4 flex flex-col items-center z-10">
                                <img src="{{ asset('assets/img3.png') }}" alt="Image" class="w-8 mb-2">
                                <span class="text-xs md:text-sm text-center">Proses</span>
                            </div>
                            <div class="basis-1/4 flex flex-col items-center z-10">
                                <img src="{{ asset('assets/img5.png') }}" alt="Image" class="w-8 mb-2">
                                <span class="text-xs md:text-sm text-center">Selesai</span>
                            </div>
                            <div class="flex w-9/12 h-2 bg-[#D9D9D9] rounded-full overflow-hidden absolute top-6 left-1/2 transform -translate-x-1/2 z-0">
                                <div class="flex flex-col justify-center overflow-hidden bg-[#173D7A]" role="progressbar" style="width: 33%" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                    <div class="border-b-2 mb-8">
                        <div class="flex items-start space-x-2 mb-5">
                            <img src="{{ asset('assets/img8.png') }}" alt="Profile">
                            <div>
                                <h5 class="font-semibold text-[#605C5C]">Wifi di area kampus satu dikasih free akses</h5>
                                <small class="text-[#605C5C]"><span class="text-[#173D7A]">2 Menit yang lalu</span> &#x2022; Pengaduan - Infrastruktur Jaringan</small>
                            </div>
                        </div>
                        <div class="text-sm mb-5">
                            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Commodi impedit provident inventore earum dignissimos ipsam tempora, vitae facilis omnis, fugit tempore expedita ex. Vel corporis ipsum inventore corrupti blanditiis impedit.</p>
                        </div>
                        <div class="flex justify-between relative shadow-xl p-3 mb-8 border rounded">
                            <div class="basis-1/4 flex flex-col items-center z-10">
                                <img src="{{ asset('assets/img1.png') }}" alt="Image" class="w-8 mb-2">
                                <span class="text-xs md:text-sm text-center">Tulis <span class="hidden md:inline">Laporan</span></span>
                            </div>
                            <div class="basis-1/4 flex flex-col items-center z-10">
                                <img src="{{ asset('assets/img2.png') }}" alt="Image" class="w-8 mb-2">
                                <span class="text-xs md:text-sm text-center">&#10060; Verifikasi</span>
                            </div>
                            <div class="basis-1/4 flex flex-col items-center z-10">
                                <img src="{{ asset('assets/img3.png') }}" alt="Image" class="w-8 mb-2">
                                <span class="text-xs md:text-sm text-center">Proses</span>
                            </div>
                            <div class="basis-1/4 flex flex-col items-center z-10">
                                <img src="{{ asset('assets/img5.png') }}" alt="Image" class="w-8 mb-2">
                                <span class="text-xs md:text-sm text-center">Selesai</span>
                            </div>
                            <div class="flex w-9/12 h-2 bg-[#D9D9D9] rounded-full overflow-hidden absolute top-6 left-1/2 transform -translate-x-1/2 z-0">
                                <div class="flex flex-col justify-center overflow-hidden bg-[#173D7A]" role="progressbar" style="width: 33%" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                    <div class="border-b-2 mb-8">
                        <div class="flex items-start space-x-2 mb-5">
                            <img src="{{ asset('assets/img8.png') }}" alt="Profile">
                            <div>
                                <h5 class="font-semibold text-[#605C5C]">Wifi di area kampus satu dikasih free akses</h5>
                                <small class="text-[#605C5C]"><span class="text-[#173D7A]">2 Menit yang lalu</span> &#x2022; Pengaduan - Infrastruktur Jaringan</small>
                            </div>
                        </div>
                        <div class="text-sm mb-5">
                            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Commodi impedit provident inventore earum dignissimos ipsam tempora, vitae facilis omnis, fugit tempore expedita ex. Vel corporis ipsum inventore corrupti blanditiis impedit.</p>
                        </div>
                        <div class="flex justify-between relative shadow-xl p-3 mb-8 border rounded">
                            <div class="basis-1/4 flex flex-col items-center z-10">
                                <img src="{{ asset('assets/img1.png') }}" alt="Image" class="w-8 mb-2">
                                <span class="text-xs md:text-sm text-center">Tulis <span class="hidden md:inline">Laporan</span></span>
                            </div>
                            <div class="basis-1/4 flex flex-col items-center z-10">
                                <img src="{{ asset('assets/img2.png') }}" alt="Image" class="w-8 mb-2">
                                <span class="text-xs md:text-sm text-center">&#10060; Verifikasi</span>
                            </div>
                            <div class="basis-1/4 flex flex-col items-center z-10">
                                <img src="{{ asset('assets/img3.png') }}" alt="Image" class="w-8 mb-2">
                                <span class="text-xs md:text-sm text-center">Proses</span>
                            </div>
                            <div class="basis-1/4 flex flex-col items-center z-10">
                                <img src="{{ asset('assets/img5.png') }}" alt="Image" class="w-8 mb-2">
                                <span class="text-xs md:text-sm text-center">Selesai</span>
                            </div>
                            <div class="flex w-9/12 h-2 bg-[#D9D9D9] rounded-full overflow-hidden absolute top-6 left-1/2 transform -translate-x-1/2 z-0">
                                <div class="flex flex-col justify-center overflow-hidden bg-[#173D7A]" role="progressbar" style="width: 33%" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="content3" class="tab-content border-2 border-[#173D7A] md:p-5 rounded hidden">
                    <div class="shadow-xl rounded p-4 border mb-5">
                        <div class="flex items-start space-x-2 mb-5">
                            <img src="{{ asset('assets/img8.png') }}" alt="Profile">
                            <div>
                                <h5 class="font-semibold text-[#605C5C]">Joko Purnomo</h5>
                                <small class="text-[#605C5C]"><span class="text-[#173D7A]">2 Menit yang lalu</span> &#x2022; Pengaduan - Infrastruktur Jaringan &#x2022; Belum diproses</small>
                            </div>
                        </div>
                        <div class="text-sm mb-1">
                            <h5 class="font-medium mb-2 text-[#173D7A]">Pemasangan Jaringan Internet</h5>
                            <p>Assalamuailkum Wr. Wb.  Beberapa ruang kelas atau laboratorium tidak memiliki jaringan internet yang memadai, sehingga menyulitkan kami untuk  menggunakan teknologi dalam.</p>
                        </div>
                    </div>
                    <div class="shadow-xl rounded p-4 border mb-5">
                        <div class="flex items-start space-x-2 mb-5">
                            <img src="{{ asset('assets/img8.png') }}" alt="Profile">
                            <div>
                                <h5 class="font-semibold text-[#605C5C]">Joko Purnomo</h5>
                                <small class="text-[#605C5C]"><span class="text-[#173D7A]">2 Menit yang lalu</span> &#x2022; Pengaduan - Infrastruktur Jaringan &#x2022; Belum diproses</small>
                            </div>
                        </div>
                        <div class="text-sm mb-1">
                            <h5 class="font-medium mb-2 text-[#173D7A]">Pemasangan Jaringan Internet</h5>
                            <p>Assalamuailkum Wr. Wb.  Beberapa ruang kelas atau laboratorium tidak memiliki jaringan internet yang memadai, sehingga menyulitkan kami untuk  menggunakan teknologi dalam.</p>
                        </div>
                    </div>
                    <div class="shadow-xl rounded p-4 border mb-5">
                        <div class="flex items-start space-x-2 mb-5">
                            <img src="{{ asset('assets/img8.png') }}" alt="Profile">
                            <div>
                                <h5 class="font-semibold text-[#605C5C]">Joko Purnomo</h5>
                                <small class="text-[#605C5C]"><span class="text-[#173D7A]">2 Menit yang lalu</span> &#x2022; Pengaduan - Infrastruktur Jaringan &#x2022; Belum diproses</small>
                            </div>
                        </div>
                        <div class="text-sm mb-1">
                            <h5 class="font-medium mb-2 text-[#173D7A]">Pemasangan Jaringan Internet</h5>
                            <p>Assalamuailkum Wr. Wb.  Beberapa ruang kelas atau laboratorium tidak memiliki jaringan internet yang memadai, sehingga menyulitkan kami untuk  menggunakan teknologi dalam.</p>
                        </div>
                    </div>
                    <div class="shadow-xl rounded p-4 border mb-5">
                        <div class="flex items-start space-x-2 mb-5">
                            <img src="{{ asset('assets/img8.png') }}" alt="Profile">
                            <div>
                                <h5 class="font-semibold text-[#605C5C]">Joko Purnomo</h5>
                                <small class="text-[#605C5C]"><span class="text-[#173D7A]">2 Menit yang lalu</span> &#x2022; Pengaduan - Infrastruktur Jaringan &#x2022; Belum diproses</small>
                            </div>
                        </div>
                        <div class="text-sm mb-1">
                            <h5 class="font-medium mb-2 text-[#173D7A]">Pemasangan Jaringan Internet</h5>
                            <p>Assalamuailkum Wr. Wb.  Beberapa ruang kelas atau laboratorium tidak memiliki jaringan internet yang memadai, sehingga menyulitkan kami untuk  menggunakan teknologi dalam.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="md:basis-3/12 bg-white p-5 shadow-xl rounded">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nesciunt distinctio rem corporis optio laboriosam voluptates beatae, illum voluptatibus cumque consequuntur repellendus eaque quisquam vel ad veniam soluta. Odio, culpa sint.</p>
            </div>
        </div>
    </div>
</x-guest-layout> 
