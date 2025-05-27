<!-- resources/views/components/alert-errors.blade.php -->

@props(['messages'])

@if ($messages && count($messages) > 0)
    <div {{ $attributes->merge(['class' => 'alert alert-danger']) }}>
        <strong>Whoops!</strong> There were some problems with your input.
        <ul class="mt-2">
            @foreach ((array) $messages as $message)
                <li>{{ $message }}</li>
            @endforeach
        </ul>
    </div>
@endif
