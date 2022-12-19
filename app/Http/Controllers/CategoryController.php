<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $categories = Category::paginate(20);
        return view('category/list', [
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category/new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50|min:2|unique:categories,name',
        ]);

        $cat = new Category();
        $cat->name = $request->name;
        $cat->active = $request->active=="on" ? 1:0;
        $cat->save();
        
        return redirect(route('categoryList'))->with('status', 'ثبت با موفقیت انجام شد.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        if($id == null)
            return redirect(route('categoryList'))->with('statusErr', 'برای ویرایش باید یک دسته‌بندی انتخاب کرده باشید.');

        $cat = Category::where('id', $id)->first();
        if($cat == null)
            return redirect(route('categoryList'))->with('statusErr', 'دسته‌بندی مورد نظر یافت نشد.');
        
        return view('category/edit', [
            'cat' => $cat
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($id == null)
            return redirect(route('categoryList'))->with('statusErr', 'برای ویرایش باید یک دسته‌بندی انتخاب کرده باشید.');

        $validated = $request->validate([
            'name' => 'required|string|max:50|min:2|unique:categories,name,'.$id,
        ]);
        $cat = Category::where('id', $id)->first();
        if($cat == null)
            return redirect(route('categoryList'))->with('statusErr', 'دسته‌بندی مورد نظر یافت نشد.');
            
        Category::where('id', $id)->update(['active'=> $request->active=="on" ? 1:0, 'name'=> $request->name]);
        return redirect(route('categoryList'))->with('status', 'دسته‌بندی مورد نظر با موفقیت ویرایش شد.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function updateStatus($id)
    {
        if($id == null)
            return redirect(route('categoryList'))->with('statusErr', 'برای ویرایش باید یک دسته‌بندی انتخاب کرده باشید.');

        $cat = Category::where('id', $id)->first();
        if($cat == null)
            return redirect(route('categoryList'))->with('statusErr', 'دسته‌بندی مورد نظر یافت نشد.');
            
        Category::where('id', $id)->update(['active'=> $cat->active ^ 1]);
        return redirect(route('categoryList'))->with('status', 'دسته‌بندی مورد نظر با موفقیت ویرایش شد.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($id == null)
            return redirect(route('categoryList'))->with('statusErr', 'برای حذف باید یک دسته‌بندی انتخاب کرده باشید.');

        $cat = Category::where('id', $id)->first();
        if($cat == null)
            return redirect(route('categoryList'))->with('statusErr', 'دسته‌بندی مورد نظر یافت نشد.');
            
        Category::where('id', $id)->delete();
        return redirect(route('categoryList'))->with('status', 'دسته‌بندی مورد نظر با موفقیت حذف شد.');
    }
}
