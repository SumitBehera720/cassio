@props(['product'])
<button 
    x-data="{ added: false, wishlist: [] }"
    x-init="
        wishlist = JSON.parse(localStorage.getItem('wishlist') || '[]');
        added = wishlist.some(i => i.product_id === {{ $product->id }});
        window.addEventListener('wishlist-updated', () => {
            wishlist = JSON.parse(localStorage.getItem('wishlist') || '[]');
            added = wishlist.some(i => i.product_id === {{ $product->id }});
        });
        window.addEventListener('storage', (e) => {
            if (e.key === 'wishlist') {
                wishlist = JSON.parse(e.newValue || '[]');
                added = wishlist.some(i => i.product_id === {{ $product->id }});
            }
        });
    "
    @click.prevent="
        if (added) {
            wishlist = wishlist.filter(i => i.product_id !== {{ $product->id }});
        } else {
            wishlist.push({ product_id: {{ $product->id }}, product_slug: '{{ addslashes($product->slug) }}' });
        }
        localStorage.setItem('wishlist', JSON.stringify(wishlist));
        window.dispatchEvent(new CustomEvent('wishlist-updated'));
    "
    class="bg-white rounded-full p-2 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-[#D8C3A5] shadow-sm z-20 relative"
    :class="added ? 'text-[#991B1B] bg-gray-50' : 'text-gray-400 hover:text-[#0F1A2C] hover:bg-gray-50'"
    :aria-label="added ? 'Remove {{ addslashes($product->name) }} from wishlist' : 'Add {{ addslashes($product->name) }} to wishlist'"
>
    <svg class="w-5 h-5" :class="added ? 'fill-current' : 'fill-none'" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
    </svg>
</button>
