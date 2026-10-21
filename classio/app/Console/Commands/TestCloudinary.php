<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\CloudinaryService;
use Illuminate\Http\UploadedFile;

class TestCloudinary extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:cloudinary';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test Cloudinary upload and delete';

    /**
     * Execute the console command.
     */
    public function handle(CloudinaryService $cloudinary)
    {
        $this->info('Starting Cloudinary Test...');

        $filePath = storage_path('app/public/products/tommy-hilfiger-lorenzo-th1792117.png');
        if (!file_exists($filePath)) {
            $this->error("File not found: " . $filePath);
            return;
        }

        $file = new UploadedFile($filePath, 'tommy-hilfiger-lorenzo-th1792117.png');
        
        try {
            $this->info('Uploading test asset...');
            $result = $cloudinary->upload($file, 'products/tommy-hilfiger-lorenzo-th1792117');
            
            $publicId = $result['public_id'];
            $secureUrl = $result['secure_url'];
            
            $this->info("Upload successful. Public ID: {$publicId}");
            $this->info("Secure URL: {$secureUrl}");
            
            $this->info('Deleting asset...');
            $deleted = $cloudinary->delete($publicId);
            if ($deleted) {
                $this->info('Delete successful!');
            } else {
                $this->error('Delete failed!');
            }
            
            $this->info('Testing reject outside classio namespace...');
            try {
                $cloudinary->delete('foreign_project/some_image');
                $this->error('Failed: Did not reject outside classio namespace!');
            } catch (\Exception $e) {
                $this->info('Success: Rejected foreign asset deletion! ' . $e->getMessage());
            }

        } catch (\Exception $e) {
            $this->error("Exception: " . $e->getMessage());
        }
    }
}
