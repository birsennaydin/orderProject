<?php

namespace App\Http\ApiTrait;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;

trait CacheTrait
{

    /**
     * @return mixed
     */
    public function getCache($key)
    {
        return Cache::get($key);
    }

    /**
     * @param $key
     * @param $data
     * @param $limit
     * @return bool
     */
    public function setCache($key, $data, $limit): bool
    {
        $expireDate = Carbon::now()->addMinutes($limit);
        return Cache::put($key, $data, $expireDate);
    }
}
