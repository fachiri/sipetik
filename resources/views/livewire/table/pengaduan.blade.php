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
                    <a wire:click.prevent="sortBy('jenis')" role="button" href="#">
                        Kategori
                        @include('components.sort-icon', ['field' => 'jenis'])
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
                        Tanggal
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
                <th>Aksi</th>
            </tr>
        </x-slot>
        <x-slot name="body">
            @foreach ($reports as $report)
                <tr x-data="window.__controller.dataTableController({{ $report->id }})">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $report->user->name }}</td>
                    <td>{{ $report->kategori }}</td>
                    <td>{{ $report->judul }}</td>
                    <td>{{ $report->tanggal }}</td>
                    <td>
                        <small class="bg-red-100 px-2 py-1 rounded font-semibold text-red-500">Urgen</small>
                    </td>
                    <td>
                        @php
                            $status = $report->history[count($report->history)-1]->status;
                            $color = '';
                            if ($status == 'Tulis Laporan') {
                                $color = 'slate-500';
                            } elseif ($status == 'Verifikasi') {
                                $color = 'orange-500';
                            } elseif ($status == 'Proses') {
                                $color = 'blue-500';
                            } elseif ($status == 'Selesai') {
                                $color = 'green-500';
                            }
                        @endphp
                        <small class="font-bold text-{{ $color }}">
                            {{ $status }}
                        </small>
                    </td>
                    <td class="whitespace-nowrap row-action--icon flex space-x-2">
                        <a role="button" href="{{ route('pengaduan.edit', $report->report_id) }}" class="w-6"><img src="{{ asset('assets/edit.svg') }}" alt="Icon"></a>
                        <a role="button" href="{{ route('pengaduan.detail', $report->report_id) }}" class="w-6"><img src="{{ asset('assets/detail.svg') }}" alt="Icon"></a>
                    </td>
                </tr>
            @endforeach
        </x-slot>
    </x-data-table>
</div>
