<x-app-layout>
	<x-slot name="header_content">
		<h1>Feedback</h1>
		<div class="section-header-breadcrumb">
			<div class="breadcrumb-item">Lainnya</div>
			<div class="breadcrumb-item active">Feedback</div>
		</div>
	</x-slot>

	<div>
		<livewire:table.main name="feedback" :model="$feedbacks" :categories="$categories" />
	</div>
</x-app-layout>
