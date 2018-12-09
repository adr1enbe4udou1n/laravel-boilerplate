<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use League\Glide\ServerFactory;
use League\Glide\Signatures\SignatureFactory;
use League\Glide\Signatures\SignatureException;
use League\Glide\Filesystem\FileNotFoundException;
use League\Glide\Responses\SymfonyResponseFactory;

class ImageController extends Controller
{
    /**
     * @param $path
     * @param \Illuminate\Http\Request $request
     *
     * @return mixed
     */
    public function show($path, Request $request)
    {
        try {
            if (! auth()->check()) {
                SignatureFactory::create(config('glide.key'))
                    ->validateRequest('/img/'.$path, $request->all());
            }

            $server = ServerFactory::create([
                'response' => new SymfonyResponseFactory($request),
                'source'   => public_path(),
                'cache'    => storage_path('app/cache'),
                'base_url' => 'img',
            ]);

            return $server->getImageResponse($path, $request->all());
        } catch (SignatureException $e) {
            abort(403);
        } catch (FileNotFoundException $e) {
            abort(404);
        }
    }
}
