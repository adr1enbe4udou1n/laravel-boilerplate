<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;

class BackendController extends Controller
{
    /**
     * Show admin home.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('backend.home');
    }

    protected function searchQuery(Request $request, Builder $query, $columns, $searchables = [])
    {
        if ($column = $request->get('column')) {
            $query->orderBy($column, $request->get('direction') ?? 'asc');
        }

        if ($search = $request->get('search')) {
            foreach ($searchables as $key => $searchableColumn) {
                if (is_array($searchableColumn)) {
                    $query->whereHas(
                        $key, function (Builder $query) use ($searchableColumn, $search) {
                            foreach ($searchableColumn as $index => $field) {
                                if (0 === $index) {
                                    $query->where($field, 'like', "%{$search}%");
                                    continue;
                                }
                                $query->orWhere($field, 'like', "%{$search}%");
                            }
                        });
                    continue;
                }
                $query->orWhere($searchableColumn, 'like', "%{$search}%");
            }
        }

        return $query->paginate($request->get('perPage'), $columns);
    }

    protected function redirectResponse(Request $request, $message, $type = 'success')
    {
        if ($request->wantsJson()) {
            return response()->json([
              'status' => $type,
              'message' => $message,
            ]);
        }

        return redirect()->back()->with("flash_{$type}", $message);
    }
}
