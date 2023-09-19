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
                            $count = 0;
                            foreach ($report->chat as $chat) {
                                if ($chat->read_status === 0) {
                                    $count++;
                                }
                            }
                            $status = $report->history[count($report->history)-1]->status;
                            if ($report->kategori && $status === 'Tulis Laporan') {
                                $status = 'Disposisi';
                            }
                            $textColor = '';

                            switch ($status) {
                                case 'Disposisi':
                                    $bgColor = 'bg-[#173D7A]';
                                    $textColor = 'text-slate-100';
                                    break;
                                case 'Tulis Laporan':
                                    $bgColor = 'bg-indigo-500';
                                    $textColor = 'text-slate-100';
                                    break;
                                case 'Verifikasi':
                                    $bgColor = 'bg-stone-400';
                                    $textColor = 'text-slate-100';
                                    break;
                                case 'Proses':
                                    $bgColor = 'bg-orange-500';
                                    $textColor = 'text-slate-100';
                                    break;
                                case 'Selesai':
                                    $bgColor = 'bg-green-600';
                                    $textColor = 'text-slate-100';
                                    break;
                                case 'Proses Gagal':
                                case 'Verifikasi Gagal':
                                    $status = '&#10060; ' . explode(' ', $status)[0];
                                    $bgColor = 'bg-red-500';
                                    $textColor = 'text-slate-100';
                                    break;
                                default:
                                    $textColor = 'text-gray-500';
                                    break;
                            }
                        @endphp
                        <small class="{{ $textColor }} {{ $bgColor }} px-2 py-1 rounded font-semibold">
                            {!! $status !!}
                        </small>
                    </td>
                    <td class="whitespace-nowrap row-action--icon flex space-x-2">
                        @if (auth()->user()->role != 'KABID')
                            <a role="button" href="{{ route('saran.edit', $report->report_id) }}" class="w-6"><img src="{{ asset('assets/edit.svg') }}" alt="Icon"></a>
                        @endif
                        <a role="button" href="{{ route('saran.detail', $report->report_id) }}" class="w-6 relative">
                            <img src="{{ asset('assets/detail.svg') }}" alt="Icon">
                            @if ($count > 0)
                                <div class="absolute inline-flex items-center justify-center w-5 h-5 text-[.6rem] font-bold text-white bg-red-500 border-2 border-white rounded-full -top-2 -right-2 dark:border-gray-900">{{ $count }}</div>
                            @endif
                        </a>
                    </td>
                </tr>
            @endforeach
        </x-slot>
    </x-data-table>
</div>
