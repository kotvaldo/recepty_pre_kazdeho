<?php

namespace App\Http\Controllers;

use Aginev\Datagrid\Datagrid;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->authorizeResource(Category::class, 'category');
    }

    public function index(Request $request)
    {
        $categories = Category::query()->filter($request->get('f', []))->get();

        $grid = new Datagrid($categories, $request->get('f', []));

        $grid->setColumn('name', 'Category Name', ['sortable' => true, 'has_filters' => true])
            ->setColumn('created_at', 'Created at', ['sortable' => true, 'has_filters' => true])
            ->setActionColumn([
                'wrapper' => function ($value, $row) {
                    return (Auth::user()->can('update', $row->getData()) ? '<a href="' . route('category.edit', [$row->id]) . '" title="Edit" class="btn btn-sm btn-primary"><i class="bi bi-pencil-square"></i></a> ' : '') .
                        (Auth::user()->can('delete', $row->getData()) ? '<a href="' . route('category.destroy', [$row->id]) . '" title="Delete" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></a>' : '');
                }
            ]);

        return view('category.index', [
            'grid' => $grid
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category.create', [
            'action' => route('category.store'),
            'method' => 'post'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories',
        ]);

        $category = Category::create($request->all());
        $category->save();
        return redirect()->route('category.index')->with('alert', 'Category has been created successfully!');
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
    public function edit(Category $category)
    {
        return view('category.edit', [
            'action' => route('category.update', $category->id),
            'method' => 'put',
            'model' => $category,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|unique:categories',
        ]);

        $category->update($request->all());

        return redirect()->route('category.index')->with('alert', 'Category has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {

        $category->delete();
        return redirect()->route('category.index')->with('alert', 'Category has been removed successfully!');
    }
}
