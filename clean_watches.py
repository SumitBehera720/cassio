import sqlite3
import json

conn = sqlite3.connect('classio/database/database.sqlite')
c = conn.cursor()

# 1. Remove all other products from watch collection (category_id = 3) except ID 25, 26, 27, 28, 29
c.execute("SELECT id, name FROM products WHERE category_id = 3 AND id NOT IN (25, 26, 27, 28, 29)")
to_remove = c.fetchall()
print(f"Removing {len(to_remove)} products from watch collection:")
for p in to_remove:
    print(f"  Deleting ID {p[0]}: {p[1]}")
    c.execute("DELETE FROM product_images WHERE product_id = ?", (p[0],))
    c.execute("DELETE FROM product_variants WHERE product_id = ?", (p[0],))
    c.execute("DELETE FROM products WHERE id = ?", (p[0],))

# Deactivate empty subcategories 6 and 7 so users don't see empty tabs
c.execute("UPDATE subcategories SET is_active = 0 WHERE id IN (6, 7)")
c.execute("UPDATE subcategories SET is_active = 1 WHERE id = 5")

# Ensure all 5 watches belong to Category 3, Subcategory 5 (Men Watches), active status
# Also set trending/featured flags appropriately
c.execute("UPDATE products SET is_trending = 1, is_featured = 1 WHERE id IN (25, 26)")
c.execute("UPDATE products SET is_featured = 1 WHERE id IN (27, 28, 29)")

conn.commit()
conn.close()
print("Cleaned watch collection successfully.")
