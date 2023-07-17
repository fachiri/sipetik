<x-app-layout>
  <x-slot name="header_content">
      <h1>Laporan</h1>
      <div class="section-header-breadcrumb">
          <div class="breadcrumb-item">Lainnya</div>
          <div class="breadcrumb-item active">Laporan</div>
      </div>
  </x-slot>

  <div>
        <livewire:table.main name="laporan" :model="$reports" :categories="$categories" />
    </div>
</x-app-layout>
