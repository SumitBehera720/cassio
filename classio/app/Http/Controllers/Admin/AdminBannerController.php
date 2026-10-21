<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use App\Services\CloudinaryService;
use Illuminate\Support\Facades\Storage;

class AdminBannerController extends Controller
{
    public function index()
    {
        $banners = Banner::orderBy('placement_section')->orderBy('sort_order')->paginate(20);
        return view('admin.banners.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.banners.create');
    }

    public function store(Request $request, CloudinaryService $cloudinary)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'placement_section' => 'required|in:hero_slider,category_banner,editorial,offers',
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'link_url' => 'nullable|url|max:255',
            'is_active' => 'boolean',
            'sort_order' => 'integer'
        ]);

        $data = $request->except('image');
        $data['is_active'] = $request->has('is_active');
        $data['sort_order'] = $request->sort_order ?? 0;
        
        $folderMap = [
            'hero_slider' => 'banners/hero',
            'category_banner' => 'banners/category',
            'editorial' => 'banners/editorial',
            'offers' => 'banners/offers',
        ];
        $folder = $folderMap[$request->placement_section] ?? 'banners/general';
        
        $result = $cloudinary->upload($request->file('image'), $folder);
        $data['image_path'] = $result['secure_url'];

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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'placement_section' => 'required|in:hero_slider,category_banner,editorial,offers',
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'link_url' => 'nullable|url|max:255',
            'is_active' => 'boolean',
            'sort_order' => 'integer'
        ]);

        $data = $request->except('image');
        $data['is_active'] = $request->has('is_active');
        $data['sort_order'] = $request->sort_order ?? 0;

        if ($request->hasFile('image')) {
            if ($banner->image_path) {
                if (strpos($banner->image_path, 'res.cloudinary.com') !== false) {
                    try {
                        $cloudinary->delete($banner->image_path);
                    } catch (\Exception $e) {}
                } elseif (Storage::disk('public')->exists($banner->image_path)) {
                    Storage::disk('public')->delete($banner->image_path);
                }
            }
            
            $folderMap = [
                'hero_slider' => 'banners/hero',
                'category_banner' => 'banners/category',
                'editorial' => 'banners/editorial',
                'offers' => 'banners/offers',
            ];
            $folder = $folderMap[$request->placement_section] ?? 'banners/general';
            
            $result = $cloudinary->upload($request->file('image'), $folder);
            $data['image_path'] = $result['secure_url'];
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
            } elseif (Storage::disk('public')->exists($banner->image_path)) {
                Storage::disk('public')->delete($banner->image_path);
            }
        }
        
        $banner->delete();

        return redirect()->route('admin.banners.index')->with('success', 'Banner deleted successfully.');
    }
}