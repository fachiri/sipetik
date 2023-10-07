<div class="modal fade" id="notif" tabindex="-1" aria-labelledby="notifLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered show">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title text-lg font-bold" id="notifLabel">Pekerjaan yang belum selesai</h1>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="flex flex-col">
					@foreach (session('notifications', []) as $notification)
						<a href="{{ $notification->link }}" class="flex space-x-3 hover:bg-gray-200 p-3 hover:no-underline {{ $loop->iteration > 1 ? 'border-t-2' : '' }}">
							@switch($notification->type)
								@case('alert')
									<div class="w-10 h-10 bg-danger text-white grid place-items-center rounded-circle">
										<i class="fas fa-exclamation-triangle m-0"></i>
									</div>
								@break

								@default
									<div class="w-10 h-10 bg-info text-white grid place-items-center rounded-circle">
										<i class="fas fa-bell m-0"></i>
									</div>
							@endswitch
							<div>
								<div class="font-bold">{{ $notification->message }}</div>
								<div class="text-sm">{{ $notification->time }}</div>
							</div>
						</a>
					@endforeach
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	window.addEventListener('load', function() {
		const notifModal = document.getElementById('notif')

		if (notifModal) {
			const bootstrapModal = new bootstrap.Modal(notifModal)
			bootstrapModal.show()
		}
	})
</script>
