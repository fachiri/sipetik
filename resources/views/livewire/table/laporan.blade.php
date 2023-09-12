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
                    <a wire:click.prevent="sortBy('isi')" role="button" href="#">
                        Status
                        @include('components.sort-icon', ['field' => 'isi'])
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
                    <td>{{ $report->kategori ?? '-' }}</td>
                    <td class="whitespace-nowrap">
                        @php
                            $status = $report->history[count($report->history)-1]->status;
                            $textColor = '';

                            switch ($status) {
                                case 'Tulis Laporan':
                                    $textColor = 'text-slate-500';
                                    break;
                                case 'Verifikasi':
                                    $textColor = 'text-orange-500';
                                    break;
                                case 'Proses':
                                    $textColor = 'text-blue-500';
                                    break;
                                case 'Selesai':
                                    $textColor = 'text-green-500';
                                    break;
                                case 'Proses Gagal':
                                case 'Verifikasi Gagal':
                                    $status = '&#10060; ' . explode(' ', $status)[0];
                                    $textColor = 'text-red-500';
                                    break;
                                default:
                                    $textColor = 'text-gray-500';
                                    break;
                            }
                        @endphp
                        <small class="font-bold {{ $textColor }}">
                            {!! $report->kategori ? $status : 'Disposisi' !!}
                        </small>
                    </td>
                    <td>{{ $report->judul }}</td>
                    <td>{{ $report->isi }}</td>
                </tr>
            @endforeach
        </x-slot>
    </x-data-table>
</div>
