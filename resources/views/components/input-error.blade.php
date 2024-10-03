{{--reusing this for input error showing --}}
@props(['messages'])
{{--Props here tells the component that it expects a property called messages-- Naming convention allows it to be found here by default--}}

@if ($messages)
    <ul>
        @foreach ((array) $messages as $message)
            <li class="list-unstyled text-danger text-center">{{ $message }}</li>
        @endforeach
    </ul>
@endif
