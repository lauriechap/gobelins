<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Filesystem\Filesystem;
use League\Glide\Responses\LaravelResponseFactory;
use League\Glide\ServerFactory;

class ImageController extends Controller
{
    public function show($path)
    {
        $server = ServerFactory::create([
            'response' => new LaravelResponseFactory(app('request')),
            'source' => '/', # Local filesystem for now.
            'source_path_prefix' => storage_path(env('MEDIA_STORAGE_PATH')),
            'cache' => '/', # Local filesystem for now.
            'cache_path_prefix' => storage_path('cache/media'),
            'base_url' => 'image',
        ]);

        return $server->getImageResponse($path, request()->all());
    }
}
