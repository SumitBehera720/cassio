<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $guarded = [];

    /**
     * Retrieve a setting value by key_name with fallback.
     */
    public static function get(string $key, $default = null)
    {
        $setting = static::where('key_name', $key)->first();
        return ($setting && $setting->value !== null && $setting->value !== '') ? $setting->value : $default;
    }

    /**
     * Set a setting value by key_name.
     */
    public static function set(string $key, $value)
    {
        return static::updateOrCreate(
            ['key_name' => $key],
            ['value' => $value]
        );
    }
}