<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;
use Exception;

class CloudinaryService
{
    protected $cloudName;
    protected $apiKey;
    protected $apiSecret;

    public function __construct()
    {
        $this->cloudName = env('CLOUDINARY_CLOUD_NAME');
        $this->apiKey = env('CLOUDINARY_API_KEY');
        $this->apiSecret = env('CLOUDINARY_API_SECRET');
    }

    /**
     * Upload an image to Cloudinary within the 'classio/' namespace.
     *
     * @param UploadedFile $file
     * @param string $folder Relative folder path inside 'classio/'
     * @return array [ 'public_id' => string, 'secure_url' => string ]
     */
    public function upload(UploadedFile $file, string $folder): array
    {
        $fullFolder = 'classio/' . ltrim($folder, '/');
        $timestamp = time();
        
        $signatureString = "folder={$fullFolder}&timestamp={$timestamp}" . $this->apiSecret;
        $signature = sha1($signatureString);

        $response = Http::withoutVerifying()->attach(
            'file', file_get_contents($file->getRealPath()), $file->getClientOriginalName()
        )->post("https://api.cloudinary.com/v1_1/{$this->cloudName}/image/upload", [
            'api_key' => $this->apiKey,
            'timestamp' => $timestamp,
            'signature' => $signature,
            'folder' => $fullFolder
        ]);

        if (!$response->successful()) {
            throw new Exception("Cloudinary upload failed: " . $response->body());
        }

        $data = $response->json();
        return [
            'public_id' => $data['public_id'],
            'secure_url' => $data['secure_url'],
        ];
    }

    /**
     * Delete an asset from Cloudinary using its secure URL or public ID.
     * Enforces that the asset must be within the 'classio/' namespace.
     *
     * @param string $identifier
     * @return bool
     * @throws Exception
     */
    public function delete(string $identifier): bool
    {
        $publicId = $this->extractPublicId($identifier);
        
        if (!$publicId || strpos($publicId, 'classio/') !== 0) {
            throw new Exception("Deletion rejected: Asset '{$identifier}' does not belong to the Classio namespace (classio/). Foreign assets cannot be deleted.");
        }

        $timestamp = time();
        
        $signatureString = "public_id={$publicId}&timestamp={$timestamp}" . $this->apiSecret;
        $signature = sha1($signatureString);

        $response = Http::withoutVerifying()->post("https://api.cloudinary.com/v1_1/{$this->cloudName}/image/destroy", [
            'api_key' => $this->apiKey,
            'public_id' => $publicId,
            'timestamp' => $timestamp,
            'signature' => $signature
        ]);
        
        if (!$response->successful()) {
            throw new Exception("Cloudinary delete failed: " . $response->body());
        }

        $data = $response->json();
        return isset($data['result']) && $data['result'] === 'ok';
    }

    /**
     * Extracts the public ID from a Cloudinary URL or returns the string if it's already a public ID.
     */
    public function extractPublicId(string $url): string
    {
        if (strpos($url, 'res.cloudinary.com') === false) {
            return preg_replace('/\.[a-zA-Z0-9]+$/', '', $url);
        }

        // Example URL: https://res.cloudinary.com/bsu0beoj/image/upload/v1791463119/classio/products/xxx.png
        $parts = explode('/upload/', $url);
        if (count($parts) < 2) return $url;
        
        $path = $parts[1];
        // Remove the version tag (e.g. v1791463119/)
        $path = preg_replace('/^v[0-9]+\//', '', $path);
        
        // Remove the extension
        return preg_replace('/\.[a-zA-Z0-9]+$/', '', $path);
    }
}
