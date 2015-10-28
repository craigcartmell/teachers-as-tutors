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
            'parent',
            'children' => function ($query) {
                $query->where('is_enabled', true)->orderBy('id', 'desc');
            },
        ])->where('uri', $uri)->where('is_enabled', true)->first();

        if (! $page) {
            abort(404);
        }

        $data['page']       = $page;
        $data['hero_image'] = get_hero_image($uri);

        // TODO: Hide blog until Alexa requests otherwise
        /*if ($uri === '/') {
            $data['blog'] = Page::query()->with(['parent', 'children'])->where('name', 'blog')->first();
        }*/

        return view('page', $data);
    }
}
