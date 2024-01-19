<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('root');
    }

    public function recipes(Request $request)
    {
        if($request->ajax()) {
            $page = $request->input('page', 1);
            $search = $request->input('search', '');

            // Pridajte logiku na načítavanie receptov s vyhľadávaním
            $query = Recipe::query();
            $query->whereNull('video_url');
            $query->when(!empty($search), function ($q) use ($search) {
                return $q->where('name', 'like', '%' . $search . '%');
            });

            $recipes = $query->paginate(500, ['*'], 'page', $page);

            return response()->json(['recipes' => $recipes]);
        }
        return view('home.recipes');
    }


    public function video_recipes(Request $request)
    {
        if ($request->ajax()) {
            $page = $request->input('page', 1);
            $search = $request->input('search', '');

            $query = Recipe::query();
            $query->when(!empty($search), function ($q) use ($search) {
                return $q->where('name', 'like', '%' . $search . '%');
            });
            $query->whereNotNull('video_url');

            $recipes = $query->paginate(500, ['*'], 'page', $page);

            return response()->json(['recipes' => $recipes]);
        }

        return view('home.video_recipes');
    }


    public function about()
    {
        return view('home.about');
    }

    public function rules()
    {
        return view('home.rules');
    }

    public function privacy()
    {
        return view('home.privacy');
    }


}
