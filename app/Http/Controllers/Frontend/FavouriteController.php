<?php
declare(strict_types = 1);

namespace App\Http\Controllers\Frontend;

use App\Http\Requests\Favourite\ToggleRequest;
use App\Models\Post;
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
}
