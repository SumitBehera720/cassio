
@props(['variant' => 'primary', 'type' => 'button'])
@php
    $baseClasses = 'inline-flex items-center justify-center px-6 py-3 font-sans text-sm font-semibold tracking-widest uppercase transition-colors duration-200';
    $variants = [
        'primary' => 'bg-[#0F1A2C] text-white hover:bg-[#090E17]',
        'secondary' => 'bg-[#D8C3A5] text-[#0F1A2C] hover:bg-[#E3D1B8]',
        'outline' => 'border border-[#0F1A2C] text-[#0F1A2C] hover:bg-gray-50',
        'whatsapp' => 'bg-[#25D366] text-white hover:bg-[#1DA851] shadow-md',
    ];
    $classes = $baseClasses . ' ' . ($variants[$variant] ?? $variants['primary']);
@endphp
<button type='{{ $type }}' {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</button>
