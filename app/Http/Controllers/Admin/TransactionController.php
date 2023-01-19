<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('transaction_details')->paginate(10);

        return Inertia::render('Admin/Transactions/Index', [
            'transactions' => $transactions
        ]);
    }

    public function detailProduct($id)
    {
        try {
            $product = TransactionDetail::with('products')->where('transaction_id', $id)->get();

            return response()->json([
                'succes' => true,
                'data' => $product,
                'message' => 'Berhasil mendapatkan data'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'succes' => false,
                'data' => null,
                'message' => 'Gagal mendapatkan data',
                'err_message' => $e
            ]);
        }
    }
}
