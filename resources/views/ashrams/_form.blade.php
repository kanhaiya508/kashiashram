@csrf
<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Name</label>
        <input type="text" name="name" class="form-control" required value="{{ old('name', $ashram->name ?? '') }}">
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Type</label>
        <select name="type" class="form-control" required>
            <option value="Brahmin" {{ old('type', $ashram->type ?? '') == 'Brahmin' ? 'selected' : '' }}>Brahmin
            </option>
            <option value="Other" {{ old('type', $ashram->type ?? '') == 'Other' ? 'selected' : '' }}>Other</option>
        </select>
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Order</label>
        <input type="number" name="order" class="form-control" value="{{ old('order', $ashram->order ?? '') }}">
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Active</label>
        <select name="active" class="form-control" required>
            <option value="1" {{ old('active', $ashram->active ?? '') == 1 ? 'selected' : '' }}>Yes</option>
            <option value="0" {{ old('active', $ashram->active ?? '') == 0 ? 'selected' : '' }}>No</option>
        </select>
    </div>

    <div class="col-md-12 mb-3">
        <label class="form-label">Address</label>
        <textarea name="address" class="form-control" rows="2">{{ old('address', $ashram->address ?? '') }}</textarea>
    </div>

    <div class="col-md-12 mb-3">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control" rows="3">{{ old('description', $ashram->description ?? '') }}</textarea>
    </div>

    <div class="col-md-12 mb-3">
        <label class="form-label">Upload Banner (1920x517)</label>
        <input type="file" name="image" class="form-control">
        @if (!empty($ashram->image))
            <a href="{{ asset($ashram->image) }}" target="_blank" class="d-block mt-2">View Existing</a>
        @endif
    </div>
</div>
