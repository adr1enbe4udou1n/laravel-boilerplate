<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Post;
use App\Models\Favourite;
use App\Http\Requests\Favourite\ToggleRequest;
use App\Repositories\EloquentFavouriteRepository;

class FavouriteController extends FrontendController
{
    /** @var EloquentFavouriteRepository */
    private $favourite;

    /**
     * @param EloquentFavouriteRepository $favourite
     */
    public function __construct(EloquentFavouriteRepository $favourite)
    {
        parent::__construct();
        $this->favourite = $favourite;
    }

    /**
     * @param ToggleRequest $request
     *
     * @return array
     */
    public function post(ToggleRequest $request)
    {
        $this->favourite->toggleFavourite(
            $request->getChecked(),
            Post::class,
            $request->getId(),
            auth()->id()
        );

        return [
            'success' => true,
        ];
    }

    /**
     * @param string $type
     *
     * @return mixed
     */
    public function user(string $type)
    {
        if (auth()->guest()) {
            abort(403);
        }

        if (! in_array($type, Favourite::EXISTING_TYPES)) {
            abort(404);
        }

        return view("frontend.favourite.{$type}")
            ->withType($type)
            ->withItems(
                $this->favourite->getUserFavouritesByType($type, auth()->id())->paginate(9)
            );
    }
}
