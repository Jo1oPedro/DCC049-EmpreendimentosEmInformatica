<!-- custom-message.blade.php -->
@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            Swap
        @endcomponent
    @endslot

    {{-- Body --}}
    {{ $slot }}

    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            © {{ date('Y') }} Swap. All rights reserved.
        @endcomponent
    @endslot
@endcomponent
