<div class="form-group">
    <label for="{{ $id }}">{{ $label }}</label>
    <textarea 
        name="{{ $name }}" 
        id="{{ $id }}" 
        class="form-control" 
        placeholder="{{ $placeholder }}">{{ old($name) ?? $value }}</textarea>
</div>
