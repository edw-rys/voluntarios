<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;

class CacheService extends BaseService
{
    /**
     * Get info from cache
     *
     * @param string $cache_name
     * @param string $sub_name
     * @param string $key_name
     * @return mixed|string
     */
    public function get(string $cache_name, string $sub_name = '', string $key_name = '')
    {
        if ($cache_name === '' && $key_name === '' && ! Cache::has($cache_name)) {
            return '';
        }

        $settings = Cache::get($cache_name);
        if ($settings === null) {
            return '';
        }

        if (! $sub_name || $sub_name === '') {
            return $settings;
        }

        if (! $key_name || $key_name === '') {
            return $settings[$sub_name];
        }

        $data = $settings[$sub_name]->first(static function ($value, $key) use ($key_name) {
            if ($value->key === $key_name) {
                return $value->display_name;
            }
        });

        return $data->value ?? '';
    }
}
