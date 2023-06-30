<x-guest-layout> 
    <div class="w-screen bg-[url('/assets/bg3.png')] mb-20">
        <div class="container mx-auto flex space-x-10 items-start">
            <div class="basis-9/12 bg-white p-5 shadow-xl rounded">
                <div class="flex justify-between items-start text-[#173D7A]">
                    <div class="flex items-center space-x-3">
                        <span class="bg-[#D4ECFF] rounded-full p-2">
                            <img src="{{ asset('assets/img9.png') }}" alt="Profile Image" class="w-10">
                        </span>
                        <div>
                            <h5 class="font-semibold">Amirudin Paneo</h5>
                            <span class="text-sm">&#64;username</span>
                        </div>
                    </div>
                    <div class="flex space-x-20">
                        <div class="flex flex-col items-center">
                            <span class="text-sm">Terverifikasi</span>
                            <span class="text-3xl font-semibold">10</span>
                        </div>
                        <div class="flex flex-col items-center">
                            <span class="text-sm">Proses</span>
                            <span class="text-3xl font-semibold">2</span>
                        </div>
                        <div class="flex flex-col items-center">
                            <span class="text-sm">Selesai</span>
                            <span class="text-3xl font-semibold">0</span>
                        </div>
                    </div>
                    <img src="{{ asset('assets/img7.png') }}" alt="Image">
                </div>
            </div>
            <div class="basis-3/12 bg-white p-5 shadow-xl rounded">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nesciunt distinctio rem corporis optio laboriosam voluptates beatae, illum voluptatibus cumque consequuntur repellendus eaque quisquam vel ad veniam soluta. Odio, culpa sint.</p>
            </div>
        </div>
    </div>
</x-guest-layout> 
