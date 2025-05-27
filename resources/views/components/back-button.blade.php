<!-- resources/views/components/back-button.blade.php -->
@props(['route', 'icon' => 'fa-arrow-left', 'text' => 'Back'])

<a href="{{ $route }}" class="btn btn-dark mb-2">
    <i class="fa {{ $icon }}"></i> {{ $text }}
</a>
