<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function index() {
        $categories = Category::all();

        return view('admin.categories.index', compact('categories'));
    }

    public function create() {
        return view('admin.categories.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|max:25|unique:categories',
            'description' => 'nullable|min:10|max:500',
        ]);


        // Para guardar el registro.
        $category = new Category();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();

        return redirect()->route('admin.categories.index');
    }

    public function edit($category) 
    {
        $category = Category::find($category);

        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, $category) 
    {
        // Cateogria que estamos editando
        $category = Category::find($category);
        
        // Validamos
        $request->validate([
            'name' => ['required','max:25', Rule::unique('categories')->ignore($category->id) ],
            'description' => ['nullable','min:10','max:500']
        ]);

        // Para actualizar un registro existente
        $category->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.categories.index');
    }

    public function destroy($category) 
    {
        $category = Category::find($category);

        $category->delete();

        return redirect()->route('admin.categories.index');
    }
}