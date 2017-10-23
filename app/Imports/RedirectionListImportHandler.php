<?php

namespace App\Imports;

use Illuminate\Http\Response;
use Maatwebsite\Excel\Files\ImportHandler;
use Maatwebsite\Excel\Collections\RowCollection;
use Maatwebsite\Excel\Collections\CellCollection;
use App\Repositories\Contracts\RedirectionRepository;

class RedirectionListImportHandler implements ImportHandler
{
    /**
     * @var RedirectionRepository
     */
    protected $redirections;

    /**
     * Create a new controller instance.
     *
     * @param RedirectionRepository $redirections
     *
     * @throws \Mcamara\LaravelLocalization\Exceptions\SupportedLocalesNotDefined
     */
    public function __construct(RedirectionRepository $redirections)
    {
        $this->redirections = $redirections;
    }

    public function handle($import)
    {
        /** @var RowCollection $results */
        $results = $import->get();

        $results->each(function (CellCollection $row) {
            if (isset($row['source'], $row['target'])) {
                $this->redirections->store([
                    'source' => $row['source'],
                    'target' => $row['target'],
                    'type' => Response::HTTP_MOVED_PERMANENTLY,
                ]);
            }
        });
    }
}
