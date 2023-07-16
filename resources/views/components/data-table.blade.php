<div class="bg-gray-100 text-gray-900 tracking-wider leading-normal">
    <div class="p-8 pt-4 mt-2 bg-white" x-data="window.__controller.dataTableMainController()" x-init="setCallback();">
        @if ($categories && auth()->user()->role == 'ADMIN')
            <div class="flex space-x-3 mb-4">
                @foreach ($categories as $category)
                    <button wire:click="filterByCategory('{{ $category->name }}')" class="tab-btn tab-btn-pengaduan font-bold text-[#002979] px-3 py-2 rounded-lg border-2 border-[#002979] {{ $this->selectedCategory === $category->name ? 'active' : '' }}">{{ $category->name }}</button>
                @endforeach
            </div>
        @endif
        @if ($data->actions)
            <div class="flex pb-4 -ml-3">
                @foreach ($data->actions as $item)
                    @if ($item->is_used)
                        <a href="{{ $item->route }}"  class="mr-2 btn btn-{{ $item->btn_color }} shadow-none">
                            <span class="{{ $item->icon }}"></span> {{ $item->text }}
                        </a>
                    @endif
                @endforeach
            </div>
        @endif

        <div class="row mb-4">
            <div class="col form-inline">
                Per Page: &nbsp;
                <select wire:model="perPage" class="form-control" style="width: 5rem;">
                    <option>10</option>
                    <option>15</option>
                    <option>25</option>
                </select>
            </div>

            <div class="col">
                <input wire:model="search" class="form-control border-slate-200 rounded-sm" type="text" placeholder="Cari...">
            </div>
        </div>

        <div class="row">
            <div class="table-responsive">
                <table class="table table-bordered table-striped text-sm text-gray-600">
                    <thead>
                        {{ $head }}
                    </thead>
                    <tbody>
                        {{ $body }}
                    </tbody>
                </table>
            </div>
        </div>

        <div id="table_pagination" class="py-3">
            {{ $model->onEachSide(1)->links() }}
        </div>
    </div>
</div>

