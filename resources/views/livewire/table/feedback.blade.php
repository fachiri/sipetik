<div>
	<x-data-table :data="$data" :model="$feedbacks" :categories="$categories">
		<x-slot name="head">
			<tr>
				<th>
					<a wire:click.prevent="sortBy('id')" role="button" href="#">
						No
						@include('components.sort-icon', ['field' => 'id'])
					</a>
				</th>
				<th>
					<a wire:click.prevent="sortBy('user_id')" role="button" href="#">
						Name
						@include('components.sort-icon', ['field' => 'user_id'])
					</a>
				</th>
				<th>
					<a wire:click.prevent="sortBy('rate')" role="button" href="#">
						Penilaian
						@include('components.sort-icon', ['field' => 'rate'])
					</a>
				</th>
			</tr>
		</x-slot>
		<x-slot name="body">
			@foreach ($feedbacks as $feedback)
				<tr x-data="window.__controller.dataTableController({{ $feedback->id }})">
					<td>{{ $loop->iteration }}</td>
					<td>{{ $feedback->user->name }}</td>
					<td>
						@switch($feedback->rate)
							@case(1)
                            Sangat Tidak Memuaskan
							@break

							@case(2)
                            Tidak Memuaskan
							@break

							@case(3)
                            Netral
							@break

							@case(4)
                            Memuaskan
							@break

							@case(5)
                            Sangat Memuaskan
							@break

							@default
						@endswitch
					</td>
				</tr>
			@endforeach
		</x-slot>
	</x-data-table>
</div>
