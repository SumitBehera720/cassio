
@props(['price', 'compareAt' => null])
<div class='flex items-center justify-center gap-2 mt-auto'>
    <span class='font-sans text-base font-bold text-[#1F2937]'>₹{{ number_format($price, 2) }}</span>
    @if($compareAt && $compareAt > $price)
        <span class='font-sans text-sm text-[#6B7280] line-through'>₹{{ number_format($compareAt, 2) }}</span>
    @endif
</div>
