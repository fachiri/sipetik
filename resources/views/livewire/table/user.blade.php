<div>
    <x-data-table :data="$data" :model="$users" :categories="$categories">
        <x-slot name="head">
            <tr>
                <th>
                    <a wire:click.prevent="sortBy('id')" role="button" href="#">
                        ID
                        @include('components.sort-icon', ['field' => 'id'])
                    </a>
                </th>
                <th>
                    <a wire:click.prevent="sortBy('name')" role="button" href="#">
                        Name
                        @include('components.sort-icon', ['field' => 'name'])
                    </a>
                </th>
                <th>
                    <a wire:click.prevent="sortBy('role')" role="button" href="#">
                        Role
                        @include('components.sort-icon', ['field' => 'role'])
                    </a>
                </th>
                <th>
                    <a wire:click.prevent="sortBy('email')" role="button" href="#">
                        Email
                        @include('components.sort-icon', ['field' => 'email'])
                    </a>
                </th>
                <th>
                    <a wire:click.prevent="sortBy('created_at')" role="button" href="#">
                        Tanggal Dibuat
                        @include('components.sort-icon', ['field' => 'created_at'])
                    </a>
                </th>
                <th>Action</th>
            </tr>
        </x-slot>
        <x-slot name="body">
            @foreach ($users as $user)
                @if (auth()->user()->role == 'KABID')
                    @if ($user->teknisi)
                        @if ($user->teknisi->category->id == auth()->user()->kabid->category->id)
                            <tr x-data="window.__controller.dataTableController({{ $user->id }})">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->role }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->created_at->format('d M Y H:i') }}</td>
                                <td class="whitespace-nowrap row-action--icon">
                                    <a role="button" href="/user/edit/{{ $user->id }}" class="mr-3"><i class="fa fa-16px fa-pen"></i></a>
                                    <a role="button" x-on:click.prevent="deleteItem" href="#"><i class="fa fa-16px fa-trash text-red-500"></i></a>
                                </td>
                            </tr>
                        @endif
                    @endif
                @else
                    <tr x-data="window.__controller.dataTableController({{ $user->id }})">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->role }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at->format('d M Y H:i') }}</td>
                        <td class="whitespace-nowrap row-action--icon">
                            <a role="button" href="/user/edit/{{ $user->id }}" class="mr-3"><i class="fa fa-16px fa-pen"></i></a>
                            <a role="button" x-on:click.prevent="deleteItem" href="#"><i class="fa fa-16px fa-trash text-red-500"></i></a>
                        </td>
                    </tr>
                @endif
            @endforeach
        </x-slot>
    </x-data-table>
</div>
