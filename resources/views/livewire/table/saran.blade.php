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
                        Status
                        @include('components.sort-icon', ['field' => 'created_at'])
                    </a>
                </th>
                <th>Aksi</th>
            </tr>
        </x-slot>
        <x-slot name="body">
            @foreach ($reports as $report)
                <tr x-data="window.__controller.dataTableController({{ $report->id }})">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $report->user->name }}</td>
                    <td>{{ $report->judul }}</td>
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
                    <td class="whitespace-nowrap row-action--icon flex space-x-2">
                        @if (auth()->user()->role != 'KABID')
                            <a role="button" href="{{ route('saran.edit', $report->report_id) }}" class="w-6"><img src="{{ asset('assets/edit.svg') }}" alt="Icon"></a>
                        @endif
                        <a role="button" href="{{ route('saran.detail', $report->report_id) }}" class="w-6"><img src="{{ asset('assets/detail.svg') }}" alt="Icon"></a>
                    </td>
                </tr>
            @endforeach
        </x-slot>
    </x-data-table>
</div>
