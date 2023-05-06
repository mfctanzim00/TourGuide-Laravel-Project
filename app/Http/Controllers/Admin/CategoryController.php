<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255|unique:categories',
            'description' => 'sometimes|max:1000',
            'image' => 'required|image|mimes:jpg,png,bmp,jpeg'
        ]);
        // Image
        $image = $request->image;
        $imageName = Str::slug($request->name, '-'). uniqid(). '.'. $image->getClientOriginalExtension();

        if(!Storage::disk('public')->exists('category')){
            Storage::disk('public')->makeDirectory('category');
        }
        // store
      //  $image->storeAs('category', $imageName, 'public');
        $categoryImg = Image::make($image)->resize(640, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->stream();
        // Store in public/category
        Storage::disk('public')->put('category/'.$imageName, $categoryImg);


        $category = new Category();
        $category->name = $request->name;
        $category->slug = Str::slug($request->name, '-');
        $category->description = $request->description;
        $category->image = $imageName;
        $category->save();
        Toastr::success('Category created successfully.');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($request->name == Category::findorFail($id)->name){
            $this->validate($request, [
                'name' => 'required|max:255',
                'description' => 'sometimes|max:1000',
                'image' => 'sometimes|image|mimes:jpg,bmp,png,jpeg'
            ]);
        }
        else {
            $this->validate($request, [
                'name' => 'required|max:255|unique:categories',
                'description' => 'sometimes|max:1000',
                'image' => 'sometimes|image|mimes:jpg,bmp,png,jpeg'
            ]);
        }

        $category = Category::findorFail($id);

        if($request->image != NULL){
            // Image
            $image = $request->image;
            $imageName = Str::slug($request->name, '-'). uniqid(). '.'. $image->getClientOriginalExtension();
 
            if(!Storage::disk('public')->exists('category')){
                Storage::disk('public')->makeDirectory('category');
            }
            // Delete old image
            if(Storage::disk('public')->exists('category/'. $category->image)){
                Storage::disk('public')->delete('category/'. $category->image);
            }
            // store
           // $image->storeAs('category', $imageName, 'public');
            $categoryImg = Image::make($image)->resize(640, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->stream();
            // Store in public/category
            Storage::disk('public')->put('category/'.$imageName, $categoryImg);
        }
        else {
            $imageName = $category->image;
        }

        $category->name = $request->name;
        $category->slug = Str::slug($request->name, '-');
        $category->description = $request->description;
        $category->image = $imageName;
        $category->save();
        Toastr::success('Category updated successfully.');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findorFail($id);
        Storage::disk('public')->delete('category/'. $category->image);
        $category->delete();
        Toastr::success('Category deleted successfully.');
        return redirect()->back();
    }
}
