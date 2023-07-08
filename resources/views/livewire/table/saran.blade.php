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
                    <td>
                        <small class="bg-red-100 px-2 py-1 rounded font-semibold text-red-500">Urgen</small>
                    </td>
                    <td>
                        <small class="font-bold text-blue-500">
                            {{ $report->history[0]->status }}
                        </small>
                    </td>
                    <td class="whitespace-nowrap row-action--icon flex space-x-2">
                        <a role="button" href="/saran/edit/{{ $report->id }}" class="w-6"><img src="{{ asset('assets/edit.svg') }}" alt="Icon"></a>
                        <a role="button" href="" class="w-6"><img src="{{ asset('assets/detail.svg') }}" alt="Icon"></a>
                    </td>
                </tr>
            @endforeach
        </x-slot>
    </x-data-table>
</div>
