@if ($errors->any())
<div class="alert alert-danger mt-3">{{ $errors->first() }}</div>
@endif

@if (!$product->id)
<div class="mb-3">
    <label for="image" class="form-label">Image</label>
    <input class="form-control" type="file" id="image" name="image" value="{{ $product->image  }}">
</div>
@endif

<div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input type="text" class="form-control" name="name" placeholder="Product Name" value="{{ old('name') ?? $product->name }}">
</div>

<div class="mb-3">
    <label for="price" class="form-label">Price</label>
    <input type="number" class="form-control" name="price" placeholder="Price" value="{{ old('price') ?? $product->price }}">
</div>

<div class="mb-3">
    <label for="description" class="form-label">Description (Optional)</label>
    <textarea name="description" id="description" cols="30" rows="10" class="form-control">{{ old('description') ?? $product->description }}</textarea>
</div>

<button type="submit" class="btn btn-block btn-primary w-100">Submit</button>
