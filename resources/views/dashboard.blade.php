<x-app-layout>
    <x-slot name="header_content">
        <h1>Dashboard</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active">Dashboard</div>
        </div>
    </x-slot>

    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
        <div class="row mb-5">
            <div class="col-3">
                <div class="border-2 rounded-md shadow-md p-3 flex space-x-3">
                    <div class="bg-blue-500 text-white w-12 h-12 rounded-lg flex justify-center items-center">
                        <i class="fas fa-bullhorn text-xl"></i>
                    </div>
                    <div>
                        <div>Total Pengaduan</div>
                        <div class="font-semibold text-xl">{{ $total_pengaduan }}</div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="border-2 rounded-md shadow-md p-3 flex space-x-3">
                    <div class="bg-red-500 text-white w-12 h-12 rounded-lg flex justify-center items-center">
                        <i class="fas fa-hand-paper text-xl"></i>
                    </div>
                    <div>
                        <div>Total Permintaan</div>
                        <div class="font-semibold text-xl">{{ $total_permintaan }}</div>
                    </div>
                </div>
                
            </div>
            <div class="col-3">
                <div class="border-2 rounded-md shadow-md p-3 flex space-x-3">
                    <div class="bg-yellow-500 text-white w-12 h-12 rounded-lg flex justify-center items-center">
                        <i class="fas fa-envelope-open-text text-xl"></i>
                    </div>
                    <div>
                        <div>Total Saran</div>
                        <div class="font-semibold text-xl">{{ $total_saran }}</div>
                    </div>
                </div>
                
            </div>
            <div class="col-3">
                <div class="border-2 rounded-md shadow-md p-3 flex space-x-3">
                    <div class="bg-green-500 text-white w-12 h-12 rounded-lg flex justify-center items-center">
                        <i class="fas fa-user text-xl"></i>
                    </div>
                    <div>
                        <div>Total Teknisi</div>
                        <div class="font-semibold text-xl">{{ $total_teknisi }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <h4 class="font-semibold text-lg">Tabel Prioritas</h4>
            </div>
            <div class="col-12">
                <livewire:table.main name="dashboard" :model="$reports" :categories="$categories" />
            </div>
        </div>
    </div>
</x-app-layout>
