<div>
    <x-data-table :data="$data" :model="$reports" :categories="$categories">
        <x-slot name="head">
            <tr>
                <th>
                    <a wire:click.prevent="sortBy('id')" role="button" href="#">
                        No
                        @include('components.sort-icon', ['field' => 'id'])
                    </a>
                </th>
                <th>
                    <a wire:click.prevent="sortBy('report_id')" role="button" href="#">
                        ID Laporan
                        @include('components.sort-icon', ['field' => 'report_id'])
                    </a>
                </th>
                <th>
                    <a wire:click.prevent="sortBy('jenis')" role="button" href="#">
                        Jenis
                        @include('components.sort-icon', ['field' => 'jenis'])
                    </a>
                </th>
                <th>
                    <a wire:click.prevent="sortBy('kategori')" role="button" href="#">
                        Kategori
                        @include('components.sort-icon', ['field' => 'kategori'])
                    </a>
                </th>
                <th>
                    <a wire:click.prevent="sortBy('judul')" role="button" href="#">
                        Judul
                        @include('components.sort-icon', ['field' => 'judul'])
                    </a>
                </th>
                <th>
                    <a wire:click.prevent="sortBy('isi')" role="button" href="#">
                        Isi
                        @include('components.sort-icon', ['field' => 'isi'])
                    </a>
                </th>
            </tr>
        </x-slot>
        <x-slot name="body">
            @foreach ($reports as $report)
                <tr x-data="window.__controller.dataTableController({{ $report->id }})">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $report->report_id }}</td>
                    <td>{{ $report->jenis }}</td>
                    <td>{{ $report->kategori }}</td>
                    <td>{{ $report->judul }}</td>
                    <td>{{ $report->isi }}</td>
                </tr>
            @endforeach
        </x-slot>
    </x-data-table>
</div>
