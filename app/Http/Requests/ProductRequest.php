<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'old_price' => 'required|numeric|min:0.0',
            'discount' => 'required|numeric',
            'thumbnail' => 'required|image|mimes:png,jpg,jpeg',
            'multi_img' => 'required',
            'multi_img.*' => 'image|mimes:png,jpg,jpeg'
        ];
    }

    public function messages()
    {
        return [
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
            'thumbnail.required' => 'Thumnail produk harus diisi',
            'thumbnail.image' => 'Thumnail produk harus bertime gambar dengan format (png, jpg, atau jpeg',
            'multi_img.required.*' => 'Thumnail produk harus diisi',
            'multi_img.image.*' => 'Thumnail produk harus bertime gambar dengan format (png, jpg, atau jpeg',
        ];
    }
}
