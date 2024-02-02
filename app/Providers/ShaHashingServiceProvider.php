<?php
namespace App\Providers;

use Illuminate\Hashing\HashManager;
use Illuminate\Support\ServiceProvider;
use App\Libraries\Hashing\Sha512Hasher;

class ShaHashingServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->extend(HashManager::class, function () {
            return new Sha512Hasher();
        });
    }
}