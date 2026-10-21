from PIL import Image
import os

img = Image.open('design/design.png')
target_dir = 'classio/public/images/classio'
os.makedirs(target_dir, exist_ok=True)

crops = {
    # 1. Hero
    'hero_model.jpg': (458, 64, 715, 290),

    # 2. Categories
    'cat_ladies.jpg': (23, 308, 77, 362),
    'cat_gents.jpg': (92, 308, 146, 362),
    'cat_watches.jpg': (161, 308, 215, 362),
    'cat_accessories.jpg': (230, 308, 284, 362),
    'cat_bags.jpg': (299, 308, 353, 362),
    'cat_footwear.jpg': (368, 308, 422, 362),
    'cat_gifts.jpg': (437, 308, 491, 362),
    'cat_electronics.jpg': (506, 308, 560, 362),
    'cat_new_arrivals.jpg': (575, 308, 629, 362),

    # 3. Trending Now
    'trending_anarkali.jpg': (23, 452, 130, 560),
    'trending_blazer.jpg': (140, 452, 247, 560),
    'trending_watch.jpg': (257, 452, 364, 560),
    'trending_handbag.jpg': (375, 452, 482, 560),
    'trending_perfume.jpg': (492, 452, 599, 560),
    'trending_sneakers.jpg': (610, 452, 715, 560),

    # 4. Ladies Collection Showcase
    'ladies_banner.jpg': (180, 615, 350, 745),
    'ladies_kurti.jpg': (360, 638, 440, 718),
    'ladies_saree.jpg': (446, 638, 526, 718),
    'ladies_kurti_set.jpg': (532, 638, 612, 718),
    'ladies_western.jpg': (618, 638, 698, 718),

    # 5. Gents Collection Showcase
    'gents_banner.jpg': (175, 765, 350, 895),
    'gents_shirt.jpg': (360, 788, 440, 868),
    'gents_blazer.jpg': (446, 788, 526, 868),
    'gents_chinos.jpg': (532, 788, 612, 868),
    'gents_tshirt.jpg': (618, 788, 698, 868),

    # 6. Watches & Perfumes Showcase
    'watches_banner.jpg': (165, 930, 350, 1055),
    'watch_mens.jpg': (360, 946, 440, 1026),
    'watch_womens.jpg': (446, 946, 526, 1026),
    'perfume_luxury.jpg': (532, 946, 612, 1026),
    'perfume_deo.jpg': (618, 946, 698, 1026),

    # 7. Promo Grid
    'banner_accessories.jpg': (120, 1076, 248, 1172),
    'banner_bags.jpg': (370, 1076, 490, 1172),
    'banner_footwear.jpg': (560, 1076, 705, 1172),
    'banner_gifts.jpg': (160, 1188, 355, 1290),
    'banner_electronics.jpg': (520, 1188, 705, 1290),
    'banner_new_arrivals.jpg': (165, 1302, 355, 1405),
    'banner_offers.jpg': (570, 1302, 705, 1405),

    # 8. Featured Collections
    'feat_handbag.jpg': (30, 1475, 137, 1582),
    'feat_sunglasses.jpg': (147, 1475, 254, 1582),
    'feat_shoes.jpg': (264, 1475, 371, 1582),
    'feat_watch.jpg': (381, 1475, 488, 1582),
    'feat_wallet.jpg': (498, 1475, 605, 1582),
    'feat_jacket.jpg': (615, 1475, 715, 1582),

    # 9. Brand Boutique
    'brand_boutique.jpg': (3, 1614, 250, 1785),

    # 10. Newsletter
    'newsletter_model.jpg': (580, 1845, 725, 1930),
}

for name, box in crops.items():
    cropped = img.crop(box)
    # Upscale 2x using Lanczos for crisp high-DPI display
    w, h = cropped.size
    upscaled = cropped.resize((w * 2, h * 2), Image.Resampling.LANCZOS)
    upscaled.save(os.path.join(target_dir, name), quality=95)
    print(f"Extracted {name}: {upscaled.size}")

print("All exact images successfully extracted and saved!")
