<x-modal-action action="{{ $action }}">
    @if ($data->id)
        @method('put')
    @endif
    <div class="row-baris">
        <div class="col-6">
            <div class="mb-3">
                <p>Tanggal mulai :</p>
                <input type="text" name="start_date" readonly value="{{ $data->start_date ?? request()->start_date }}" class="form-control datepicker">
            </div>
        </div>
        <div class="col-6">
            <div class="mb-3">
                <p>Tanggal akhir :</p>
                <input type="text" name="end_date" readonly value="{{ $data->end_date ?? request()->end_date }}" class="form-control datepicker">
            </div>
        </div>

        <div class="col-12">
            <div class="mb-3">
                <textarea name="title" class="form-control">{{ $data->title }}</textarea>
            </div>
        </div>
        <select name="category" class="form-select" aria-label="Default select example">
            <option selected disabled>Pilih Category</option>
            @foreach (['primary', 'secondary', 'success', 'danger', 'warning', 'info'] as $category)
                <option value="{{ $category }}" {{ old('category', $data->category) == $category ? 'selected' : '' }}>
                    {{ ucfirst($category) }}
                </option>
            @endforeach
        </select>
        
        <select name="id_diklat" class="form-select" aria-label="Default select example">
            <option selected disabled>Pilih Diklat</option>
            @foreach ($diklats as $diklat)
                <option value="{{ $diklat->id }}" {{ old('id_diklat', $data->id_diklat) == $diklat->id ? 'selected' : '' }}>
                    {{ $diklat->nama_diklat }}
                </option>
            @endforeach
        </select>
        
        <div class="col-12">
            <div class="mb-3">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="delete" role="switch" id="flexSwitchCheckDefault">
                    <label class="form-check-label" for="flexSwitchCheckDefault">Delete</label>
                  </div>
            </div>
        </div>
    </div>
</x-modal-action>