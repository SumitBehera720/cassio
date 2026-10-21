<?php
$base = __DIR__ . '/classio/resources/views/components';

if (!is_dir($base)) mkdir($base, 0755, true);

// 1. Header / Navbar
file_put_contents($base . '/header.blade.php', "
<header class='bg-[#0F1A2C] text-white sticky top-0 z-50 shadow-md'>
    <div class='max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between h-20'>
        <div class='flex-shrink-0 flex items-center gap-4'>
            <a href='/' class='font-serif text-3xl font-bold tracking-widest text-[#D8C3A5]'>CLASSIO</a>
        </div>
        <nav class='hidden lg:flex space-x-8'>
            {{ \$slot }}
        </nav>
        <div class='flex items-center space-x-6'>
            <!-- Search, Wishlist, Cart Icons -->
            <button class='hover:text-[#D8C3A5] transition-colors'><svg class='w-6 h-6' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z'></path></svg></button>
            <a href='/wishlist' class='hover:text-[#D8C3A5] transition-colors'><svg class='w-6 h-6' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z'></path></svg></a>
            <a href='/cart' class='hover:text-[#D8C3A5] transition-colors relative'><svg class='w-6 h-6' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z'></path></svg></a>
        </div>
    </div>
</header>
");

// 2. Button
file_put_contents($base . '/button.blade.php', "
@props(['variant' => 'primary', 'type' => 'button'])
@php
    \$baseClasses = 'inline-flex items-center justify-center px-6 py-3 font-sans text-sm font-semibold tracking-widest uppercase transition-colors duration-200';
    \$variants = [
        'primary' => 'bg-[#0F1A2C] text-white hover:bg-[#090E17]',
        'secondary' => 'bg-[#D8C3A5] text-[#0F1A2C] hover:bg-[#E3D1B8]',
        'outline' => 'border border-[#0F1A2C] text-[#0F1A2C] hover:bg-gray-50',
        'whatsapp' => 'bg-[#25D366] text-white hover:bg-[#1DA851] shadow-md',
    ];
    \$classes = \$baseClasses . ' ' . (\$variants[\$variant] ?? \$variants['primary']);
@endphp
<button type='{{ \$type }}' {{ \$attributes->merge(['class' => \$classes]) }}>
    {{ \$slot }}
</button>
");

// 3. Section Heading
file_put_contents($base . '/section-heading.blade.php', "
@props(['title', 'subtitle' => null, 'align' => 'left'])
@php
    \$alignClass = [
        'left' => 'text-left',
        'center' => 'text-center mx-auto',
        'editorial' => 'text-center mx-auto max-w-2xl'
    ][\$align] ?? 'text-left';
@endphp
<div class='mb-8 {{ \$alignClass }}'>
    <h2 class='font-serif text-3xl md:text-4xl font-bold text-[#0F1A2C]'>{{ \$title }}</h2>
    @if(\$subtitle)
        <p class='mt-2 font-sans text-sm md:text-base text-[#6B7280]'>{{ \$subtitle }}</p>
    @endif
</div>
");

// 4. Product Card
file_put_contents($base . '/product-card.blade.php', "
@props(['product', 'variant' => 'default'])
<div class='group relative bg-white flex flex-col h-full border border-transparent hover:border-gray-100 transition-colors duration-300'>
    <div class='relative aspect-[4/5] bg-gray-100 overflow-hidden'>
        <img src='{{ \$product->primary_image ?? \"/placeholder.jpg\" }}' alt='{{ \$product->name }}' class='object-cover w-full h-full transition-transform duration-700 ease-out group-hover:scale-105' loading='lazy'>
        @if(\$product->is_new)
            <div class='absolute top-3 left-3 bg-[#0F1A2C] text-white text-[10px] font-bold px-2 py-1 uppercase tracking-wider'>New</div>
        @endif
        <div class='absolute top-3 right-3 z-10'>
            <x-wishlist-button :product-id='\$product->id' />
        </div>
    </div>
    <div class='p-4 flex flex-col flex-grow text-center'>
        <h3 class='font-sans text-sm font-medium text-[#1F2937] line-clamp-1 mb-1'>{{ \$product->name }}</h3>
        <x-product-price :price='\$product->price' :compare-at='\$product->compare_at_price' />
    </div>
</div>
");

// 5. Product Price
file_put_contents($base . '/product-price.blade.php', "
@props(['price', 'compareAt' => null])
<div class='flex items-center justify-center gap-2 mt-auto'>
    <span class='font-sans text-base font-bold text-[#1F2937]'>₹{{ number_format(\$price, 2) }}</span>
    @if(\$compareAt && \$compareAt > \$price)
        <span class='font-sans text-sm text-[#6B7280] line-through'>₹{{ number_format(\$compareAt, 2) }}</span>
    @endif
</div>
");

// 6. Wishlist Button
file_put_contents($base . '/wishlist-button.blade.php', "
@props(['productId'])
<button class='bg-white/80 backdrop-blur rounded-full p-2 text-gray-400 hover:text-red-500 hover:bg-white transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-[#D8C3A5]' aria-label='Add to Wishlist'>
    <svg class='w-5 h-5' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z'></path></svg>
</button>
");

// 7. Value Prop
file_put_contents($base . '/value-prop.blade.php', "
@props(['title', 'subtitle', 'icon'])
<div class='flex items-center space-x-4 p-4'>
    <div class='flex-shrink-0 text-[#D8C3A5]'>
        {!! \$icon !!}
    </div>
    <div>
        <h4 class='font-sans font-bold text-[#0F1A2C] text-sm uppercase tracking-wide'>{{ \$title }}</h4>
        <p class='font-sans text-xs text-[#6B7280] mt-0.5'>{{ \$subtitle }}</p>
    </div>
</div>
");

echo "Components generated successfully.\n";
