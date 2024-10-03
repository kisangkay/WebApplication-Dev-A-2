{{--reusing this for input error showing --}}
@props(['messages'])
{{--Props here tells the component that it expects a property called messages--}}

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'text-sm text-red-600 space-y-1']) }}>
        @foreach ((array) $messages as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif
