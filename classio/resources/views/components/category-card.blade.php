@props(['category'])
<a href="{{ route('category.show', $category->slug ?? '#') }}" class="group flex flex-col items-center flex-shrink-0 text-center focus:outline-none">
    <div class="w-16 h-16 sm:w-20 sm:h-20 md:w-22 md:h-22 rounded-full p-0.5 border border-gray-200 group-hover:border-[#0B1A2C] transition-all duration-300 mb-2">
        <div class="w-full h-full rounded-full overflow-hidden bg-[#F4F0E9]">
            @if(isset($category->image_path) && $category->image_path)
                <img src="{{ str_starts_with($category->image_path, 'http') ? $category->image_path : asset($category->image_path) }}" 
                     alt="{{ $category->name }}" 
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" 
                     loading="lazy">
            @else
                <div class="w-full h-full flex items-center justify-center text-[#0B1A2C] font-serif font-bold text-lg">
                    {{ substr($category->name, 0, 1) }}
                </div>
            @endif
        </div>
    </div>
    <span class="font-sans text-[11px] sm:text-xs font-medium text-gray-800 group-hover:text-[#0B1A2C] transition-colors tracking-tight line-clamp-1 max-w-[80px] sm:max-w-[90px]">
        {{ $category->name }}
    </span>
</a>
