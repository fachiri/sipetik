<x-app-layout>
    <x-slot name="header_content">
        <h1>Permintaan</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active">Monitoring</div>
            <div class="breadcrumb-item">Permintaan</div>
        </div>
    </x-slot>
  
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
          <h4 class="text-lg font-bold pb-3 border-b-2">Tabel Permintaan</h4>
          <div>
              <livewire:table.main name="permintaan" :model="$reports" :categories="$categories" />
          </div>
    </div>
  </x-app-layout>
  