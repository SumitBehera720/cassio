$ErrorActionPreference = 'SilentlyContinue'
$dir = "public/images/classio"
if (!(Test-Path $dir)) {
    New-Item -ItemType Directory -Force -Path $dir | Out-Null
}

$images = @{
    'hero_model.jpg' = 'https://images.unsplash.com/photo-1507679799987-c73779587ccf?w=1400&auto=format&fit=crop&q=85'
    'cat_ladies.jpg' = 'https://images.unsplash.com/photo-1610030469983-98e550d6193c?w=400&auto=format&fit=crop&q=80'
    'cat_gents.jpg' = 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?w=400&auto=format&fit=crop&q=80'
    'cat_watches.jpg' = 'https://images.unsplash.com/photo-1524805444758-089113d48a6d?w=400&auto=format&fit=crop&q=80'
    'cat_accessories.jpg' = 'https://images.unsplash.com/photo-1511499767150-a48a237f0083?w=400&auto=format&fit=crop&q=80'
    'cat_bags.jpg' = 'https://images.unsplash.com/photo-1584917865442-de89df76afd3?w=400&auto=format&fit=crop&q=80'
    'cat_footwear.jpg' = 'https://images.unsplash.com/photo-1600185365926-3a2ce3cdb9eb?w=400&auto=format&fit=crop&q=80'
    'cat_gifts.jpg' = 'https://images.unsplash.com/photo-1513201099705-a9746e1e201f?w=400&auto=format&fit=crop&q=80'
    'cat_electronics.jpg' = 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=400&auto=format&fit=crop&q=80'
    'cat_new_arrivals.jpg' = 'https://images.unsplash.com/photo-1595950653106-6c9ebd614d3a?w=400&auto=format&fit=crop&q=80'
    'trending_anarkali.jpg' = 'https://images.unsplash.com/photo-1583391733956-3750e0ff4e8b?w=600&auto=format&fit=crop&q=80'
    'trending_blazer.jpg' = 'https://images.unsplash.com/photo-1507679799987-c73779587ccf?w=600&auto=format&fit=crop&q=80'
    'trending_watch.jpg' = 'https://images.unsplash.com/photo-1522335789203-aabd1fc54bc9?w=600&auto=format&fit=crop&q=80'
    'trending_handbag.jpg' = 'https://images.unsplash.com/photo-1590874103328-eac38a683ce7?w=600&auto=format&fit=crop&q=80'
    'trending_perfume.jpg' = 'https://images.unsplash.com/photo-1541643600914-78b084683601?w=600&auto=format&fit=crop&q=80'
    'trending_sneakers.jpg' = 'https://images.unsplash.com/photo-1560769629-975ec94e6a86?w=600&auto=format&fit=crop&q=80'
    'ladies_banner.jpg' = 'https://images.unsplash.com/photo-1617627143750-d86bc21e42bb?w=800&auto=format&fit=crop&q=80'
    'ladies_kurti.jpg' = 'https://images.unsplash.com/photo-1610030469983-98e550d6193c?w=500&auto=format&fit=crop&q=80'
    'ladies_saree.jpg' = 'https://images.unsplash.com/photo-1617627143750-d86bc21e42bb?w=500&auto=format&fit=crop&q=80'
    'ladies_kurti_set.jpg' = 'https://images.unsplash.com/photo-1609357605129-26f69add5d6e?w=500&auto=format&fit=crop&q=80'
    'ladies_western.jpg' = 'https://images.unsplash.com/photo-1595777457583-95e059d581b8?w=500&auto=format&fit=crop&q=80'
    'gents_banner.jpg' = 'https://images.unsplash.com/photo-1507679799987-c73779587ccf?w=800&auto=format&fit=crop&q=80'
    'gents_shirt.jpg' = 'https://images.unsplash.com/photo-1602810318383-e386cc2a3ccf?w=500&auto=format&fit=crop&q=80'
    'gents_blazer.jpg' = 'https://images.unsplash.com/photo-1594938298603-c8148c4dae35?w=500&auto=format&fit=crop&q=80'
    'gents_chinos.jpg' = 'https://images.unsplash.com/photo-1473966968600-fa801b869a1a?w=500&auto=format&fit=crop&q=80'
    'gents_tshirt.jpg' = 'https://images.unsplash.com/photo-1521572267360-ee0c2909d518?w=500&auto=format&fit=crop&q=80'
    'watches_banner.jpg' = 'https://images.unsplash.com/photo-1522335789203-aabd1fc54bc9?w=800&auto=format&fit=crop&q=80'
    'watch_mens.jpg' = 'https://images.unsplash.com/photo-1524805444758-089113d48a6d?w=500&auto=format&fit=crop&q=80'
    'watch_womens.jpg' = 'https://images.unsplash.com/photo-1508057198894-247b23fe5ade?w=500&auto=format&fit=crop&q=80'
    'perfume_luxury.jpg' = 'https://images.unsplash.com/photo-1541643600914-78b084683601?w=500&auto=format&fit=crop&q=80'
    'perfume_deo.jpg' = 'https://images.unsplash.com/photo-1523293182086-7651a899d37f?w=500&auto=format&fit=crop&q=80'
    'banner_accessories.jpg' = 'https://images.unsplash.com/photo-1511499767150-a48a237f0083?w=700&auto=format&fit=crop&q=80'
    'banner_bags.jpg' = 'https://images.unsplash.com/photo-1584917865442-de89df76afd3?w=700&auto=format&fit=crop&q=80'
    'banner_footwear.jpg' = 'https://images.unsplash.com/photo-1560769629-975ec94e6a86?w=700&auto=format&fit=crop&q=80'
    'banner_gifts.jpg' = 'https://images.unsplash.com/photo-1513201099705-a9746e1e201f?w=700&auto=format&fit=crop&q=80'
    'banner_electronics.jpg' = 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=700&auto=format&fit=crop&q=80'
    'banner_new_arrivals.jpg' = 'https://images.unsplash.com/photo-1489987707025-afc232f7ea0f?w=700&auto=format&fit=crop&q=80'
    'banner_offers.jpg' = 'https://images.unsplash.com/photo-1549465220-1a8b9238cd48?w=700&auto=format&fit=crop&q=80'
    'feat_handbag.jpg' = 'https://images.unsplash.com/photo-1584917865442-de89df76afd3?w=500&auto=format&fit=crop&q=80'
    'feat_sunglasses.jpg' = 'https://images.unsplash.com/photo-1511499767150-a48a237f0083?w=500&auto=format&fit=crop&q=80'
    'feat_shoes.jpg' = 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=500&auto=format&fit=crop&q=80'
    'feat_watch.jpg' = 'https://images.unsplash.com/photo-1522335789203-aabd1fc54bc9?w=500&auto=format&fit=crop&q=80'
    'feat_wallet.jpg' = 'https://images.unsplash.com/photo-1627123424574-724758594e93?w=500&auto=format&fit=crop&q=80'
    'feat_jacket.jpg' = 'https://images.unsplash.com/photo-1551028719-00167b16eac5?w=500&auto=format&fit=crop&q=80'
    'brand_boutique.jpg' = 'https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=800&auto=format&fit=crop&q=80'
    'newsletter_model.jpg' = 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=800&auto=format&fit=crop&q=80'
}

foreach ($item in $images.GetEnumerator()) {
    $target = Join-Path $dir $item.Key
    if (!(Test-Path $target)) {
        Write-Host "Downloading $($item.Key)..."
        Invoke-WebRequest -Uri $item.Value -OutFile $target
    }
}

$count = (Get-ChildItem $dir).Count
Write-Host "Total images in $dir : $count"
