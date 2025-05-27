@props(['type' => 'submit'])

<button {{ $attributes->merge([
    'type' => $type,
    'class' => 'btn btn-primary mb-3',
]) }}>
    {{ $slot }}
</button>
