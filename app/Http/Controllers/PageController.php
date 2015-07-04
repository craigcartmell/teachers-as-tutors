<?php

namespace TeachersAsTutors\Http\Controllers;

use Illuminate\Http\Response;
use TeachersAsTutors\Http\Requests;
use TeachersAsTutors\Page;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param string $uri
     *
     * @return Response
     */
    public function index($uri)
    {
        $page = Page::with([
            'children' => function ($query) {
                $query->where('is_enabled', true)->orderBy('id', 'desc');
            }
        ])->where('uri', $uri)->where('is_enabled', true)->first();

        if (! $page) {
            abort(404);
        }
        
        return view('page', ['page' => $page]);
    }
}
