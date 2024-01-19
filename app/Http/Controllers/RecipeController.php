<?php

namespace App\Http\Controllers;

use Aginev\Datagrid\Datagrid;
use App\Models\Category;
use App\Models\Difficulty;
use App\Models\Recipe;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mockery\Matcher\Ducktype;
use SebastianBergmann\Diff\Diff;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
        $this->authorizeResource(Recipe::class, 'recipe', ['except' => 'show']);
    }

    public function index(Request $request)
    {
        $recipes = null;
        if (auth()->user()->role == 'Admin') {
            $recipes = Recipe::query()->filter($request->get('f', []))->get();
        } else {
            $userID = Auth::id();
            $recipes = Recipe::query()->where('user_id', $userID)->filter($request->get('f', []))->get();
        }
        $grid = new Datagrid($recipes, $request->get('f', []));

        $grid->setColumn('name', 'Recipe name', ['sortable' => true, 'has_filters' => true])
            ->setColumn('user_id', 'Owner', ['sortable' => true,
                'has_filters' => true,
                'filters' => User::pluck('name', 'id')->toArray(),
                'wrapper' => function ($value, $row) {
                    $userName = User::find($value)->name;
                    return $userName ?? $value;
                }
            ])
            ->setColumn('description', 'Description', ['sortable' => true, 'has_filters' => true])
            ->setColumn('category_id', 'Category', [
                'sortable' => true,
                'has_filters' => true,
                'filters' => Category::pluck('name', 'id')->toArray(),
                'wrapper' => function ($value, $row) {
                    $categoryName = Category::find($value)->name;
                    return $categoryName ?? $value; // Ak názov nemožno nájsť, použite identifikátor
                }
            ])
            ->setColumn('difficulty', 'Difficulty', [
                'sortable' => true,
                'has_filters' => true,
                'filters' => Difficulty::pluck('name', 'id')->toArray(),
                'wrapper' => function ($value, $row) {
                    $difficultyName = Difficulty::find($value)->name;
                    return $difficultyName ?? $value;
                }
            ])
            ->setColumn('cooking_time', 'Cooking time (minúty)', ['sortable' => true, 'has_filters' => true])
            ->setActionColumn([
                'wrapper' => function ($value, $row) {
                    return (Auth::user()->can('update', $row->getData()) ? '<a href="' . route('recipe.edit', [$row->id]) . '" title="Edit" class="btn btn-sm btn-primary"><i class="bi bi-pencil-square"></i></a> ' : '') .
                        (Auth::user()->can('delete', $row->getData()) ? '<a href="' . route('recipe.delete', $row->id) . '" title="Delete" class="btn btn-sm btn-danger" onclick="return confirm(\'Are you sure ?\')"><i class="bi bi-trash"></i></a>' : '');
                }
            ]);
        return view('recipe.index', [
            'grid' => $grid
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */

    public function edit(Recipe $recipe)
    {
        $categories = Category::all();
        $difficulties = Difficulty::all();
        return view('recipe.edit', [
            'action' => route('recipe.update', $recipe->id),
            'method' => 'put',
            'model' => $recipe,
            'categories' => $categories,
            'difficulties' => $difficulties,
        ]);

    }

    public function create()
    {
        $categories = Category::all();
        $difficulties = Difficulty::all();
        return view('recipe.create', [
            'action' => route('recipe.store'),
            'method' => 'post',
            'categories' => $categories,
            'difficulties' => $difficulties,
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
            'description' => 'required'
        ]);
        $avatarName = null;
        if ($request->hasFile('image')) {
            $avatarName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('images'), $avatarName);
        }


        $recipe = Recipe::create([
            'name' => $request->name,
            'description' => $request->description,
            'ingredients' => $request->ingredients,
            'instructions' => $request->instructions,
            'image' => $avatarName,
            'category_id' => $request->category_id,
            'difficulty' => $request->difficulty,
            'cooking_time' => $request->cooking_time,
            'video_url' => $request->video_url,
            'user_id' => Auth::user()->getAuthIdentifier(),
        ]);

        $recipe->save();

        return redirect()->route('recipe.index')->with('alert', 'Recipe was successfully created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Recipe $recipe)
    {
        $difficulties = Difficulty::all();
        return view('recipe.show' ,['recipe' => $recipe, 'difficulties' => $difficulties]);
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
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'required',
            'difficulty' => 'required',
            'cooking_time' => 'required',
        ]);
        $oldImage = null;
        $avatarName = null;

        if ($request->hasFile('image')) {
            $oldImage = $recipe->image;
            $avatarName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('images'), $avatarName);

        }

        $recipe->update($request->all());
        $recipe->update(['image' => $avatarName]);

        if ($oldImage) {
            $oldImagePath = public_path('images') . '/' . $oldImage;
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }
        return redirect()->route('recipe.index')->with('alert', 'Recipe was successfully edited!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Recipe $recipe)
    {
        $oldImage = $recipe->image;
        if ($oldImage) {
            $oldImagePath = public_path('images') . '/' . $oldImage;
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }
        $recipe->delete();

        return redirect()->route('recipe.index')->with('alert', 'Recipe was successfully removed!');
    }

}
