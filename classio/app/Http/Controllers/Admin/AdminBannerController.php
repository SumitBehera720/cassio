<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use App\Services\CloudinaryService;
use Illuminate\Support\Facades\Storage;

class AdminBannerController extends Controller
{
    const VALID_PLACEMENTS = [
        'hero_slider',
        'ladies_collection',
        'gents_collection',
        'watches_perfumes',
        'category_banner',
        'editorial',
        'offers'
    ];

    public function index(Request $request)
    {
        $query = Banner::query();

        if ($request->filled('placement')) {
            $query->where('placement_section', $request->placement);
        }

        if ($request->filled('status')) {
            if ($request->status === 'active') {
                $query->where('is_active', true);
            } elseif ($request->status === 'inactive') {
                $query->where('is_active', false);
            }
        }

        $banners = $query->orderBy('placement_section')
                         ->orderBy('sort_order')
                         ->paginate(20)
                         ->withQueryString();

        $placementCounts = Banner::selectRaw('placement_section, count(*) as count')
                                ->groupBy('placement_section')
                                ->pluck('count', 'placement_section')
                                ->toArray();

        return view('admin.banners.index', compact('banners', 'placementCounts'));
    }

    public function create()
    {
        return view('admin.banners.create');
    }

    public function store(Request $request, CloudinaryService $cloudinary)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'image_url' => 'nullable|string|max:1000',
            'placement_section' => 'required|in:' . implode(',', self::VALID_PLACEMENTS),
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'link_url' => 'nullable|string|max:255',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer'
        ]);

        if (!$request->hasFile('image') && !$request->filled('image_url')) {
            return back()->withErrors(['image' => 'Please provide either a banner image file or an image URL.'])->withInput();
        }

        $data = $request->except(['image', 'image_url']);
        $data['is_active'] = $request->has('is_active');
        $data['sort_order'] = $request->sort_order ?? 0;

        if ($request->hasFile('image')) {
            $folder = 'banners/' . $request->placement_section;
            $data['image_path'] = $this->handleImageUpload($request->file('image'), $folder, $cloudinary);
        } else {
            $data['image_path'] = $request->image_url;
        }

        Banner::create($data);

        return redirect()->route('admin.banners.index')->with('success', 'Banner created successfully.');
    }

    public function edit(Banner $banner)
    {
        return view('admin.banners.edit', compact('banner'));
    }

    public function update(Request $request, Banner $banner, CloudinaryService $cloudinary)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'image_url' => 'nullable|string|max:1000',
            'placement_section' => 'required|in:' . implode(',', self::VALID_PLACEMENTS),
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'link_url' => 'nullable|string|max:255',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer'
        ]);

        $data = $request->except(['image', 'image_url']);
        $data['is_active'] = $request->has('is_active');
        $data['sort_order'] = $request->sort_order ?? 0;

        if ($request->hasFile('image')) {
            $folder = 'banners/' . $request->placement_section;
            $data['image_path'] = $this->handleImageUpload($request->file('image'), $folder, $cloudinary);
        } elseif ($request->filled('image_url')) {
            $data['image_path'] = $request->image_url;
        }

        $banner->update($data);

        return redirect()->route('admin.banners.index')->with('success', 'Banner updated successfully.');
    }

    public function destroy(Banner $banner, CloudinaryService $cloudinary)
    {
        if ($banner->image_path) {
            if (strpos($banner->image_path, 'res.cloudinary.com') !== false) {
                try {
                    $cloudinary->delete($banner->image_path);
                } catch (\Exception $e) {}
            } elseif (file_exists(public_path($banner->image_path)) && str_starts_with($banner->image_path, 'uploads/')) {
                @unlink(public_path($banner->image_path));
            } elseif (Storage::disk('public')->exists($banner->image_path)) {
                Storage::disk('public')->delete($banner->image_path);
            }
        }
        
        $banner->delete();

        return redirect()->route('admin.banners.index')->with('success', 'Banner deleted successfully.');
    }

    /**
     * Safely upload image to Cloudinary or fallback to local public uploads.
     */
    protected function handleImageUpload($file, string $folder, CloudinaryService $cloudinary): string
    {
        if (env('CLOUDINARY_CLOUD_NAME') && env('CLOUDINARY_API_KEY') && env('CLOUDINARY_API_SECRET')) {
            try {
                $result = $cloudinary->upload($file, $folder);
                if (!empty($result['secure_url'])) {
                    return $result['secure_url'];
                }
            } catch (\Exception $e) {
                // Cloudinary failed or timed out, fall back to local disk
            }
        }

        $destination = public_path('uploads/banners');
        if (!is_dir($destination)) {
            @mkdir($destination, 0755, true);
        }
        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move($destination, $filename);
        
        return 'uploads/banners/' . $filename;
    }
}