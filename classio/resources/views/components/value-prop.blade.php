
@props(['title', 'subtitle', 'icon'])
<div class='flex items-center space-x-4 p-4'>
    <div class='flex-shrink-0 text-[#D8C3A5]'>
        {!! $icon !!}
    </div>
    <div>
        <h4 class='font-sans font-bold text-[#0F1A2C] text-sm uppercase tracking-wide'>{{ $title }}</h4>
        <p class='font-sans text-xs text-[#6B7280] mt-0.5'>{{ $subtitle }}</p>
    </div>
</div>
