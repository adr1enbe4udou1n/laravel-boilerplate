<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BackendController extends Controller
{
    /**
     * Show admin home.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('backend.home');
    }

    protected function RedirectResponse(Request $request, $message, $type = 'success')
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
