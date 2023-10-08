<div id="modal-rating" class="fixed inset-0 z-50 flex h-screen w-screen flex-col items-center justify-center bg-black bg-opacity-50 pt-4">
	<div class="max-w-sm overflow-x-auto rounded-lg bg-white p-4 shadow-lg" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
		<div id="complete" class="mt-2 hidden text-center">
			<h3 class="text-xl font-semibold leading-6 text-[#173D7A]" id="modal-headline">Terima kasih</h3>
			<div class="mt-2">
				<p class="mb-3 px-3 text-sm leading-5 text-gray-600">
					Semoga layanan kami dapat selalu membantu anda
				</p>
				<div class="btn-tutup flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
					<button type="button" class="focus:shadow-outline-blue inline-flex w-full justify-center rounded-md border border-gray-500 bg-white px-4 py-2 text-base font-medium leading-6 text-gray-600 shadow-sm transition duration-150 ease-in-out hover:text-gray-500 focus:outline-none sm:text-sm sm:leading-5">
						Tutup
					</button>
				</div>
			</div>
		</div>
		<form id="form-rating">
			<div class="mt-2 text-center">
				<h3 class="text-xl font-semibold leading-6 text-[#173D7A]" id="modal-headline">Beri nilai pengalaman Anda</h3>
				<div class="mt-2">
					<p class="px-3 text-sm leading-5 text-gray-600">
						Laporan anda yang berjudul "<span class="font-medium">{{ session('showFeedback')->judul }}</span>" telah selesai. Mohon beri pendapat Anda tentang layanan kami dengan mengisi survei singkat kami. Terima kasih!
					</p>
				</div>
				<div class="mt-2 flex flex-wrap items-center justify-center">
					<label for="rate-1" class="label-rating flex-initial cursor-pointer">
						<svg class="w-12 transform fill-current stroke-current transition-all duration-300 ease-out hover:scale-110 hover:text-[#173D7A]" viewBox="0 0 72 72" xmlns="http://www.w3.org/2000/svg">
							<title>Sangat Tidak Memuaskan</title>
							<g id="line">
								<circle cx="36" cy="36" r="23" fill="none" stroke-miterlimit="10" stroke-width="2" />
								<path fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2" d="M28,46c1.5805-2.5575,4.9043-4.1349,8.4211-4.0038C39.6499,42.1166,42.5622,43.6595,44,46" />
								<path d="M30,32.9252c0,1.6567-1.3448,3-3,3c-1.6553,0-3-1.3433-3-3c0-1.6553,1.3447-3,3-3C28.6552,29.9252,30,31.27,30,32.9252" />
								<path d="M48,32.9252c0,1.6567-1.3447,3-3,3s-3-1.3433-3-3c0-1.6553,1.3447-3,3-3S48,31.27,48,32.9252" />
								<line x1="23" x2="30" y1="24" y2="28" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2" />
								<line x1="49" x2="42" y1="24" y2="28" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2" />
							</g>
						</svg>
					</label>
					<input type="radio" name="rate" value="1" id="rate-1" class="hidden">
					<label for="rate-2" class="label-rating flex-initial cursor-pointer">
						<svg class="w-12 transform fill-current stroke-current transition-all duration-300 ease-out hover:scale-110 hover:text-[#173D7A]" viewBox="0 0 72 72" xmlns="http://www.w3.org/2000/svg">
							<title>Tidak Memuaskan</title>
							<g id="line">
								<circle cx="36" cy="36" r="23" fill="none" stroke-miterlimit="10" stroke-width="2" />
								<path d="M30,31c0,1.6568-1.3448,3-3,3c-1.6553,0-3-1.3433-3-3c0-1.6552,1.3447-3,3-3C28.6552,28,30,29.3448,30,31" />
								<path d="M48,31c0,1.6568-1.3447,3-3,3s-3-1.3433-3-3c0-1.6552,1.3447-3,3-3S48,29.3448,48,31" />
								<path fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2" d="M28,46c1.5805-2.5575,4.9043-4.1349,8.4211-4.0038C39.6499,42.1166,42.5622,43.6595,44,46" />
							</g>
						</svg>
					</label>
					<input type="radio" name="rate" value="2" id="rate-2" class="hidden">
					<label for="rate-3" class="label-rating flex-initial cursor-pointer">
						<svg class="w-12 transform fill-current stroke-current transition-all duration-300 ease-out hover:scale-110 hover:text-[#173D7A]" viewBox="0 0 72 72" xmlns="http://www.w3.org/2000/svg">
							<title>Netral</title>
							<g id="line">
								<circle cx="36" cy="36" r="23" fill="none" stroke-miterlimit="10" stroke-width="2" />
								<line x1="27" x2="45" y1="43" y2="43" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2" />
								<path d="M30,31c0,1.6568-1.3448,3-3,3c-1.6553,0-3-1.3433-3-3c0-1.6552,1.3447-3,3-3C28.6552,28,30,29.3448,30,31" />
								<path d="M48,31c0,1.6568-1.3447,3-3,3s-3-1.3433-3-3c0-1.6552,1.3447-3,3-3S48,29.3448,48,31" />
							</g>
						</svg>
					</label>
					<input type="radio" name="rate" value="3" id="rate-3" class="hidden">
					<label for="rate-4" class="label-rating flex-initial cursor-pointer">
						<svg class="w-12 transform fill-current stroke-current transition-all duration-300 ease-out hover:scale-110 hover:text-[#173D7A]" viewBox="0 0 72 72" xmlns="http://www.w3.org/2000/svg">
							<title>Memuaskan</title>
							<g id="line">
								<circle cx="36" cy="36" r="23" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
								<path fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M45.8147,45.2268a15.4294,15.4294,0,0,1-19.6294,0" />
								<path fill="none" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2" d="M31.6941,33.4036a4.7262,4.7262,0,0,0-8.6382,0" />
								<path fill="none" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2" d="M48.9441,33.4036a4.7262,4.7262,0,0,0-8.6382,0" />
							</g>
						</svg>
					</label>
					<input type="radio" name="rate" value="4" id="rate-4" class="hidden">
					<label for="rate-5" class="label-rating flex-initial cursor-pointer">
						<svg class="w-12 transform fill-current stroke-current transition-all duration-300 ease-out hover:scale-110 hover:text-[#173D7A]" viewBox="0 0 72 72" xmlns="http://www.w3.org/2000/svg">
							<title>Sangat Memuaskan</title>
							<g id="line">
								<circle cx="36" cy="36" r="23" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
								<path fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M50.595,41.64a11.5554,11.5554,0,0,1-.87,4.49c-12.49,3.03-25.43.34-27.49-.13a11.4347,11.4347,0,0,1-.83-4.36h.11s14.8,3.59,28.89.07Z" />
								<path fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M49.7251,46.13c-1.79,4.27-6.35,7.23-13.69,7.23-7.41,0-12.03-3.03-13.8-7.36C24.2951,46.47,37.235,49.16,49.7251,46.13Z" />
								<path fill="none" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2" d="M31.6941,32.4036a4.7262,4.7262,0,0,0-8.6382,0" />
								<path fill="none" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2" d="M48.9441,32.4036a4.7262,4.7262,0,0,0-8.6382,0" />
							</g>
						</svg>
					</label>
					<input type="radio" name="rate" value="5" id="rate-5" class="hidden">
				</div>
			</div>
			<div class="px-4 py-3 sm:flex sm:flex-row-reverse sm:justify-center sm:px-6">
				<span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
					<button type="submit" id="submit-rating" class="focus:shadow-outline-blue inline-flex w-full items-center justify-center rounded-md bg-[#173D7A] px-4 py-2 text-base font-medium leading-6 text-white shadow-sm transition duration-150 ease-in-out hover:opacity-75 focus:outline-none sm:text-sm sm:leading-5">
						<svg class="mr-2 hidden h-5 w-5 animate-spin" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
							<g id="SVGRepo_bgCarrier" stroke-width="0"></g>
							<g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
							<g id="SVGRepo_iconCarrier">
								<path opacity="0.2" fill-rule="evenodd" clip-rule="evenodd" d="M12 19C15.866 19 19 15.866 19 12C19 8.13401 15.866 5 12 5C8.13401 5 5 8.13401 5 12C5 15.866 8.13401 19 12 19ZM12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" fill="#ffffff"></path>
								<path d="M2 12C2 6.47715 6.47715 2 12 2V5C8.13401 5 5 8.13401 5 12H2Z" fill="#ffffff"></path>
							</g>
						</svg>
						Submit
					</button>
				</span>
				<span class="btn-tutup mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
					<button type="button" class="focus:shadow-outline-blue inline-flex w-full justify-center rounded-md border border-gray-500 bg-white px-4 py-2 text-base font-medium leading-6 text-gray-600 shadow-sm transition duration-150 ease-in-out hover:text-gray-500 focus:outline-none sm:text-sm sm:leading-5">
						Tutup
					</button>
				</span>
			</div>
		</form>
	</div>
</div>

<script>
	const isLoading = (isLoading) => {
		if (isLoading) {
			$("#submit-rating svg").removeClass("hidden")
			return $("#submit-rating").addClass("opacity-75").attr("disabled", isLoading)
		}
		$("#submit-rating svg").addClass("hidden")
		$("#submit-rating").removeClass("opacity-75").attr("disabled", isLoading)
	}

	$(".btn-tutup").on("click", () => {
		$("#modal-rating").addClass("hidden")
	})

	$("#form-rating").on("submit", (event) => {
		event.preventDefault();
		isLoading(true);

		const rate = $("input[name='rate']:checked").val();
		const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
		const url = @json(route('feedback.store'));
		const report_id = @json(session('showFeedback')->id);

		$.ajax({
			url,
			method: 'POST',
			headers: {
				'Content-Type': 'application/json',
				'X-CSRF-TOKEN': csrfToken
			},
			data: JSON.stringify({
				rate,
				report_id
			}),
			dataType: 'json',
			success: (response) => {
				$("#complete").removeClass("hidden")
				$("#form-rating").remove()
			},
			error: (error) => {
				console.error(error)
				const errors = error.responseJSON?.errors
				if (errors) {
					for (const key in errors) {
						errors[key].forEach(err => {
							new Noty({
								type: 'error',
								text: err,
								timeout: 2000,
							}).show()
						})
					}
				}
			},
			complete: () => {
				isLoading(false)
			}
		})
	})

	// handle style checked
	$("input[name='rate']").on("change", () => {
		const checkedRate = $("input[name='rate']:checked").val()

		$("label.label-rating svg").removeClass("text-[#173D7A] scale-125");
		$(`label[for='rate-${checkedRate}'] svg`).addClass("text-[#173D7A] scale-125")
	})
</script>
