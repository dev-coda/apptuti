<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Str as Str;


class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        


        $brands = Brand::query()
        ->when($request->q, function($query, $q){
            $query->where('name', 'like', "%{$q}%");
        })
        ->orderBy('name')
        ->paginate();
       
        $context = compact('brands'); 
        
        return view('brands.index', $context);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return  view('brands.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name'=>'required|max:255',
            'delivery_days'=>'numeric',
           
            'description'=>'nullable',
            'active'=>'nullable',
        ]);


        $slug =  Str::slug($request->name);

        if($request->hasFile('image_file')){
            $validate['image'] = $request->image_file->store('/brands', 'public');
        }

        if($request->hasFile('banner_file')){
            $validate['banner'] = $request->banner_file->store('/brands', 'public');
        }
        
        Brand::create($validate + ['slug' => $slug] );

        return to_route('brands.index')->with('success', 'Marca creada');

    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {

        $context = compact('brand'); 
        
        return view('brands.edit', $context);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand)
    {
        $validate = $request->validate([
            'name'=>'required|max:255',
            'delivery_days'=>'numeric',
          
            'description'=>'nullable',
            'slug'=>'required|unique:brands,slug,'.$brand->id,
            'active'=>'nullable',
        ]);
        
        //save file
        if($request->hasFile('image_file')){
            $validate['image'] = $request->image_file->store('/brands', 'public');
        }

        if($request->hasFile('banner_file')){
            $validate['banner'] = $request->banner_file->store('/brands', 'public');
        }

   



        $validate['slug'] =  Str::slug($request->slug);
        
        $brand->update($validate);

        return to_route('brands.index')->with('success', 'Marca actualizada');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        
        if(!$brand->vendors->count()){
            $brand->delete();
            return to_route('brands.index')->with('success', 'Vendor eliminado');
        }

        return to_route('brands.edit', $brand)->with('error', 'No es posible eliminar la marca por que tiene vendors asociados');


        // $brand->delete();
        // return to_route('brands.index')->with('success', 'Marca eliminada');
    }
}
