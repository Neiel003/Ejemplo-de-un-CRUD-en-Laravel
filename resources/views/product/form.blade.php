
<div class="row padding-1 p-1">
    <div class="col-md-12">
        <div class="form-group mb-2">
            <label for="name" class="form-label">Nombre del producto</label>
            <input
                type="text"
                name="name"
                id="name"
                class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name', $product->name) }}"
                required
            >
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-2">
            <label for="description" class="form-label">Descripción</label>
            <textarea
                name="description"
                id="description"
                class="form-control @error('description') is-invalid @enderror"
                rows="3"
            >{{ old('description', $product->description) }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-2">
            <label for="price" class="form-label">Precio</label>
            <input
                type="number"
                name="price"
                id="price"
                class="form-control @error('price') is-invalid @enderror"
                value="{{ old('price', $product->price) }}"
                min="0"
                step="0.01"
                required
            >
            @error('price')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-2">
            <label for="stock" class="form-label">Stock</label>
            <input
                type="number"
                name="stock"
                id="stock"
                class="form-control @error('stock') is-invalid @enderror"
                value="{{ old('stock', $product->stock) }}"
                min="0"
                required
            >
            @error('stock')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <button type="submit" class="btn btn-primary">
            {{ __('Submit') }}
        </button>
    </div>
</div>