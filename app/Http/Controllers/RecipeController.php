<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('recipe.index');
    }

    /**
     * Show the form for creating a new resource.
     */

    public function edit(Recipe $recipe){
        $categories = Category::all();
        return view('recipe.edit', [
            'action' => route('recipe.update'),
            'method' => 'put',
            'model' => $recipe,
            'categories' => $categories,
        ]);

    }
    public function create()
    {
        $categories = Category::all();
        return view('recipe.create', [
            'action' => route('recipe.store'),
            'method' => 'post',
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'role' => 'required',
        ]);

        $recipe = User::create($request->all());
        $user->save();
        return redirect()->route('user.users_admin')->with('alert', 'User has been created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Recipe $recipe)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Recipe $recipe)
    {
        $recipe->delete();

        return redirect()->route('');
    }
}
