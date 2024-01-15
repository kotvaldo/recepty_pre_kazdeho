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

    public function __construct()
    {
        $this->authorizeResource(Recipe::class, 'recipe');
    }
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
            'ingredients' => 'required',
            'instructions' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required',
            'difficulty' => 'required',
            'cooking_time' => 'required',
        ]);
        $avatarName = null;
        if ($request->hasFile('image')) {
            $avatarName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('images'), $avatarName);
        }


        $recipe = Recipe::create([
            'name' => $request->name,
            'ingredients' => $request->ingredients,
            'instructions' => $request->instructions,
            'image' => $avatarName,
            'category_id' => $request->category_id,
            'difficulty' => $request->difficulty,
            'cooking_time' => $request->cooking_time,
        ]);

        $recipe->save();

        return redirect()->route('user.my_recipes')->with('alert', 'Recipe was successfully created!');
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
        $request->validate([
            'name' => 'required',
            'ingredients' => 'required',
            'instructions' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // môžete zmeniť na 'nullable' ak nechcete povinný obrázok
            'category_id' => 'required',
            'difficulty' => 'required',
            'cooking_time' => 'required',
        ]);

        $recipe->update($request->all());

        if ($request->hasFile('image')) {
            $avatarName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('images'), $avatarName);
            $recipe->update(['image' => $avatarName]);
        }


        return redirect()->route('recipes.index')->with('alert', 'Recipe was successfully edited!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Recipe $recipe)
    {
        $recipe->delete();

        return redirect()->route('')->with('alert', 'Recipe was successfully removed!');
    }
}
