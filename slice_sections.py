from PIL import Image
import os

img = Image.open('design/design.png')
out_dir = 'scratch/sections'
os.makedirs(out_dir, exist_ok=True)

# Slices:
# 1. Header & Hero: 0 to 300
img.crop((0, 0, 728, 300)).save(f'{out_dir}/1_hero.png')

# 2. Categories: 290 to 390
img.crop((0, 290, 728, 390)).save(f'{out_dir}/2_categories.png')

# 3. Trending Now: 390 to 600
img.crop((0, 390, 728, 600)).save(f'{out_dir}/3_trending.png')

# 4. Ladies Collection: 600 to 750
img.crop((0, 600, 728, 750)).save(f'{out_dir}/4_ladies.png')

# 5. Gents Collection: 750 to 910
img.crop((0, 750, 728, 910)).save(f'{out_dir}/5_gents.png')

# 6. Watches & Perfumes: 910 to 1060
img.crop((0, 910, 728, 1060)).save(f'{out_dir}/6_watches.png')

# 7. Promo Grid 1: 1060 to 1180
img.crop((0, 1060, 728, 1180)).save(f'{out_dir}/7_promo1.png')

# 8. Promo Grid 2 & 3: 1180 to 1420
img.crop((0, 1180, 728, 1420)).save(f'{out_dir}/8_promo23.png')

# 9. Featured: 1420 to 1620
img.crop((0, 1420, 728, 1620)).save(f'{out_dir}/9_featured.png')

# 10. Story & Value: 1610 to 1850
img.crop((0, 1610, 728, 1850)).save(f'{out_dir}/10_story.png')

# 11. Newsletter & Footer: 1840 to 2161
img.crop((0, 1840, 728, 2161)).save(f'{out_dir}/11_footer.png')

print("All slices saved!")
