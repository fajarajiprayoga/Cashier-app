<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionsRequest extends FormRequest
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
            'id_transaction' => 'required',
            'customer_name' => 'required|string',
            'discount' => 'required',
            'total_price' => 'required',
            'pay' => 'required',
            'change' => 'required',
            'products' => 'required',
            'products.*.id' => 'exists:products,id'
        ];
    }

    public function messages()
    {
        return [
            'id_transaction.required' => 'Transaksi ID harus ada',
            'customer_name.required' => 'Nama kustomer harus diisi',
            'discount.required' => 'Diskon harus diisi, jika tidak ada diskon silahkan isi angka 0',
            'total_price.required' => 'Total price tidak boleh kosong',
            'pay.required' => 'Dibayarkan tidak boleh kosong',
            'change.required' => 'Kembali tidak boleh kosong, jika tidak ada kembali isikan angka 0',
            'products.required' => 'Silahkan isi produk yang mau diorder terlebih dahulu',
        ];
    }
}
