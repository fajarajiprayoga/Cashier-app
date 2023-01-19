<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(10);
        return Inertia::render('Admin/Categories/Index', [
            'categories' => $categories
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Categories/Create');
    }

    public function store(CategoryRequest $request)
    {
        DB::beginTransaction();
        try {
            $category = Category::create([
                'name' => $request->name
            ]);
            DB::commit();
            return redirect()->route('category.index')->with([
                'success' => true,
                'message' => 'Berhasil menambah kategori ' . $category->name
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('category.index')->with([
                'error' => true,
                'message' => 'Gagal menambah kategori ' . $category->name
            ]);
        }
    }

    public function edit(Category $category)
    {
        return Inertia::render('Admin/Categories/Edit', [
            'category' => $category
        ]);
    }

    public function update(CategoryRequest $request, Category $category)
    {
        DB::beginTransaction();
        try {
            $category->name = $request->name;
            $category->update();
            DB::commit();
            return redirect()->route('category.index')->with([
                'success' => true,
                'message' => 'Berhasil mengedit kategori ' . $category->name
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('category.index')->with([
                'success' => false,
                'message' => 'Gagal mengedit kategori ' . $category->name
            ]);
        }
    }

    public function destroy(Category $category)
    {
        DB::beginTransaction();
        try {
            $category->delete();
            DB::commit();

            return redirect()->route('category.index')->with([
                'success' => true,
                'message' => 'Berhasil menghapus kategori ' . $category->name
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('category.index')->with([
                'success' => false,
                'message' => 'Gagal menambah kategori ' . $category->name
            ]);
        }
    }
}
