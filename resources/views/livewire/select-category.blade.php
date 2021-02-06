<li class="mt-3 ml-1">
    {{-- Success is as dangerous as failure. --}}
    <div class="form-group">
        <select class="form-control" id="category-select" wire:model.lazy="category">
            <option value="">Select a Category</option>
            @foreach ($categories as $item)
                <option>{{ $item }}</option>
            @endforeach
        </select>
    </div>
</li>
