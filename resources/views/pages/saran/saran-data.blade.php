<x-app-layout>
    <x-slot name="header_content">
        <h1>Saran</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active">Monitoring</div>
            <div class="breadcrumb-item">Saran</div>
        </div>
    </x-slot>
  
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
          <h4 class="text-lg font-bold pb-3 border-b-2">Tabel Saran</h4>
          <div>
              <livewire:table.main name="saran" :model="$reports" :categories="$categories" />
          </div>
    </div>
  </x-app-layout>
  