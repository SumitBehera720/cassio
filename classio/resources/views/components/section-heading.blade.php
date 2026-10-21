
@props(['title', 'subtitle' => null, 'align' => 'left'])
@php
    $alignClass = [
        'left' => 'text-left',
        'center' => 'text-center mx-auto',
        'editorial' => 'text-center mx-auto max-w-2xl'
    ][$align] ?? 'text-left';
@endphp
<div class='mb-8 {{ $alignClass }}'>
    <h2 class='font-serif text-3xl md:text-4xl font-bold text-[#0F1A2C]'>{{ $title }}</h2>
    @if($subtitle)
        <p class='mt-2 font-sans text-sm md:text-base text-[#6B7280]'>{{ $subtitle }}</p>
    @endif
</div>
