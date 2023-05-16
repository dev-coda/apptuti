<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str as Str;
use Closure;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = Category::query()
        ->with('parent')
        ->when($request->q, function($query, $q){
            $query->where('name', 'like', "%{$q}%")->orWhere('description', 'like', "%{$q}%");
        })
        ->orderBy('name')
        ->paginate();
       
        $context = compact('categories'); 
        
        return view('categories.index', $context);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $categories = Category::active()->whereNull('parent_id')->orderBy('name')->get()->pluck('name', 'id');
        $categories->prepend('Seleccione', null);

        $context = compact('categories');

        return view('categories.create', $context);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => [
                'required', 
                'max:255',
                function (string $attribute, $value, Closure $fail){
                    $slug =  Str::slug($value);
                    $p = Category::where('slug', $slug)->first();
                    if($p){
                        $fail('El slug para este nombre ya existe');
                    }
                },
            ],
            'parent_id' => 'nullable',
            'description' => 'nullable',
            'image' => 'nullable|image',
            'active' => 'nullable|boolean',
        ]);

        if($request->hasFile('image_file')){
            $validate['image'] = $request->image_file->store('/categories', 'public');
        }

        $slug =  Str::slug($request->name);
        $validate['slug'] = $slug;

        $category = Category::create($validate);

        return to_route('categories.index')->with('success', 'La categoría se ha creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $categories = Category::active()->whereNot('id', $category->id)->whereNull('parent_id')->orderBy('name')->get()->pluck('name', 'id');
        $categories->prepend('Seleccione', null);
        $context = compact('category', 'categories');
        return view('categories.edit', $context);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
    
        $validate = $request->validate([
            'name' => [
                'required', 
                'max:255',
                
            ],
            'description' => 'nullable',
            'parent_id' => 'nullable',
            'image' => 'nullable|image',
            'active' => 'nullable|boolean',
            'slug' => [
                'required',
                function (string $attribute, $value, Closure $fail) use($category){
                    $slug =  Str::slug($value);
                    $p = Category::whereNot('id', $category->id)->where('slug', $slug)->first();
                    if($p){
                        $fail('El slug para este nombre ya existe');
                    }
                },
            ]
        ]);

        if($request->hasFile('image_file')){
            $validate['image'] = $request->image_file->store('/categories', 'public');
        }

        $slug =  Str::slug($request->name);
        $validate['slug'] = $slug;

        $category->update($validate);

        return to_route('categories.index')->with('success', 'La categoría se ha actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
       
        if($category->children()->count()){
            return back()->with('error', 'No se puede eliminar una categoría que tiene subcategorías');
        }

        if($category->products()->count()){
            return back()->with('error', 'No se puede eliminar una categoría que tiene productos asociados');
        }
        
        $category->delete();
        return to_route('categories.index')->with('success', 'La categoría se ha eliminado correctamente');

    }
}
