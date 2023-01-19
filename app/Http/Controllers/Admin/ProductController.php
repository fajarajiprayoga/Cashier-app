<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\MultiImg;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Stmt\TryCatch;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('categories')->paginate(10);

        return Inertia::render('Admin/Products/Index', [
            'products' => $products,
            'url' => url('/')
        ]);
    }

    public function create()
    {
        $categories = Category::all();

        return Inertia::render('Admin/Products/Create', [
            'categories' => $categories
        ]);
    }

    public function store(ProductRequest $request)
    {
        DB::beginTransaction();
        try {
            $product = new Product;
            $product->name = $request->name;
            $product->description = $request->description;
            $product->category_id = $request->category_id;
            $product->old_price = $request->old_price;
            $product->discount = $request->discount;
            $product->new_price = $request->old_price - ($request->old_price * ($request->discount / 100));

            if ($request->file('thumbnail')) {
                $file = $request->file('thumbnail');
                $fileName = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();

                $path = Storage::putFileAs('product-thumbnail', $file, $fileName);

                $product->thumbnail = $path;
            }

            $product->save();

            if ($request->file('multi_img')) {
                foreach ($request->file('multi_img') as $img) {
                    $file = $img;
                    $fileName = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();

                    $path = Storage::putFileAs('product-multi_img', $file, $fileName);

                    $multi_img = new MultiImg;
                    $multi_img->product_id = $product->id;
                    $multi_img->photo_path = $path;

                    $multi_img->save();
                }
            }

            DB::commit();

            return redirect()->route('product.index')->with([
                'success' => true,
                'message' => 'Berhasil menambahkan produk ' . $product->name
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('product.index')->with([
                'success' => false,
                'message' => 'Gagal menambahkan produk ' . $product->name,
                'error_message' => $e
            ]);
        }
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        $product->load('categories');
        $multi_img = MultiImg::where('product_id', $product->id)->get();

        return Inertia::render('Admin/Products/Edit', [
            'categories' => $categories,
            'product' => $product,
            'url' => url('/'),
            'multi_img' => $multi_img
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'old_price' => 'required|numeric|min:0.0',
            'discount' => 'required|numeric',
            'thumbnail' => 'nullable|image|mimes:png,jpg,jpeg',
            'multi_img' => 'nullable',
            'multi_img.*' => 'image|mimes:png,jpg,jpeg'
        ], [
            'name.required' => 'Nama produk harus diisi',
            'name.string' => 'Nama produk harus bertipe teks',
            'description.required' => 'Deskripsi produk harus diisi',
            'description.string' => 'Deskripsi produk harus bertipe teks',
            'category_id.required' => 'Kategori produk harus dipillih',
            'category_id.exists' => 'Kategori tidak tersedia',
            'old_price.required' => 'Harga awal harus diisi',
            'old_price.numeric' => 'Harga awal harus bertipe angka',
            'old_price.min' => 'Harga awal tidak boleh negatif',
            'discount.required' => 'Diskon harus diisi, jika tidak ada diskon isikan dengan angka 0',
            'discount.numeric' => 'Diskon harus bertipe angka',
            'thumbnail.image' => 'Thumnail produk harus bertime gambar dengan format (png, jpg, atau jpeg',
            'multi_img.image.*' => 'Thumnail produk harus bertime gambar dengan format (png, jpg, atau jpeg',
        ]);

        DB::beginTransaction();
        try {
            $product->name = $request->name;
            $product->description = $request->description;
            $product->category_id = $request->category_id;
            $product->old_price = $request->old_price;
            $product->discount = $request->discount;

            if ($request->file('thumbnail')) {
                $file = $request->file('thumbnail');
                $fileName = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();

                if (!empty($product->thumbnail)) {
                    Storage::delete($product->thumbnail);
                }

                $path = Storage::putFileAs('product-thumbnail', $file, $fileName);

                $product->thumbnail = $path;
            }

            if ($request->file('multi_img')) {
                $old_multi_img = MultiImg::where('product_id', $product->id)->get();

                if (!empty($old_multi_img)) {
                    foreach ($old_multi_img as $data) {
                        Storage::delete($data->photo_path);
                    }
                }

                foreach ($request->file('multi_img') as $new_data) {
                    $multi_img = new MultiImg;
                    $multi_img->product_id = $product->id;

                    $fileName = hexdec(uniqid()) . '.' . $new_data->getClientOriginalExtension();
                    $path = Storage::putFileAs('product-multi_img', $new_data, $fileName);

                    $multi_img->photo_path = $path;
                    $multi_img->save();
                }
            }
            $product->save();
            DB::commit();

            return redirect()->route('product.index')->with([
                'success' => true,
                'message' => 'Berhasil mengedit produk ' . $product->name
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('product.index')->with([
                'success' => false,
                'message' => 'Gagal mengedit produk ' . $product->name,
                'error_message' => $e
            ]);
        }
    }

    public function destroy(Product $product)
    {
        DB::beginTransaction();
        try {
            $multi_img = MultiImg::where('product_id', $product->id)->get();
            foreach ($multi_img as $img) {
                Storage::delete($img->photo_path);
                $img->delete();
            }

            if (Storage::has($product->thumbnail)) {
                Storage::delete($product->thumbnail);
            }
            $product->delete();
            DB::commit();

            return redirect()->route('product.index')->with([
                'success' => true,
                'message' => 'Berhasil menghapus produk ' . $product->name
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('product.index')->with([
                'success' => false,
                'message' => 'Gagal menghapus produk ' . $product->name,
                'error_message' => $e
            ]);
        }
    }
}
