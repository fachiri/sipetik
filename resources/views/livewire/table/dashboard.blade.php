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
                    <a wire:click.prevent="sortBy('email')" role="button" href="#">
                        Nama
                        @include('components.sort-icon', ['field' => 'email'])
                    </a>
                </th>
                <th>
                    <a wire:click.prevent="sortBy('created_at')" role="button" href="#">
                        Judul
                        @include('components.sort-icon', ['field' => 'created_at'])
                    </a>
                </th>
                <th>
                    <a wire:click.prevent="sortBy('created_at')" role="button" href="#">
                        Jenis
                        @include('components.sort-icon', ['field' => 'created_at'])
                    </a>
                </th>
                <th>
                    <a wire:click.prevent="sortBy('created_at')" role="button" href="#">
                        Kategori
                        @include('components.sort-icon', ['field' => 'created_at'])
                    </a>
                </th>
                <th>
                    <a wire:click.prevent="sortBy('created_at')" role="button" href="#">
                        Deadline
                        @include('components.sort-icon', ['field' => 'created_at'])
                    </a>
                </th>
                <th>
                    <a wire:click.prevent="sortBy('created_at')" role="button" href="#">
                        Prioritas
                        @include('components.sort-icon', ['field' => 'created_at'])
                    </a>
                </th>
                <th>
                    <a wire:click.prevent="sortBy('created_at')" role="button" href="#">
                        Status
                        @include('components.sort-icon', ['field' => 'created_at'])
                    </a>
                </th>
            </tr>
        </x-slot>
        <x-slot name="body">
            @foreach ($reports as $report)
                <tr x-data="window.__controller.dataTableController({{ $report->id }})">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $report->user->name }}</td>
                    <td>{{ $report->judul }}</td>
                    <td>{{ $report->jenis }}</td>
                    <td>{{ $report->kategori }}</td>
                    <td>{{ $report->tanggal }}</td>
                    <td class="whitespace-nowrap">
                        @php
                            switch ($report->prioritas) {
                                case 'Sangat Urgen':
                                    $bgColor = 'bg-red-700';
                                    $textColor = 'text-red-100';
                                    break;

                                case 'Urgen':
                                    $bgColor = 'bg-red-500';
                                    $textColor = 'text-red-100';
                                    break;
                                    
                                case 'Cukup Urgen':
                                    $bgColor = 'bg-red-300';
                                    $textColor = 'text-red-100';
                                    break;
                                    
                                case 'Kurang Urgen':
                                    $bgColor = 'bg-red-200';
                                    $textColor = 'text-red-400';
                                    break;
                                    
                                case 'Tidak Urgen':
                                    $bgColor = 'bg-red-50';
                                    $textColor = 'text-red-400';
                                    break;
                                
                                default:
                                    # code...
                                    break;
                            }
                        @endphp
                        <small class="{{ $bgColor }} {{ $textColor }} px-2 py-1 rounded font-semibold">
                            {{ $report->prioritas }}
                        </small>
                    </td>
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
                            {!! $status !!}
                        </small>
                    </td>
                </tr>
            @endforeach
        </x-slot>
    </x-data-table>
</div>
