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

    public function recipes()
    {
        $recipes = Recipe::all();

        return view('home.recipes')->with('recipes', $recipes);
    }

    public function video_recipes()
    {
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

    public function contact()
    {
        return view('home.contact');
    }

    public function categories()
    {
        return view('home.categories');

    }
}
