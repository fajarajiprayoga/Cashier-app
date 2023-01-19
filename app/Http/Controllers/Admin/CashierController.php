<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TransactionsRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

class CashierController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Cashiers/Index');
    }

    public function create()
    {
        $new_transaction = new Transaction;
        $new_transaction->customer_name = '';
        $new_transaction->discount = 0;
        $new_transaction->total_price = 0;
        $new_transaction->pay = 0;
        $new_transaction->change = 0;
        $new_transaction->save();

        Session::put('transaction_id', $new_transaction->id);
        $transaction_id = Session::get('transaction_id');

        $categories = Category::all();

        $category_id = Category::where('name', 'Makanan')->get('id');
        $products = Product::where('category_id', '=', $category_id)->with('categories')->get();

        return Inertia::render('Admin/Cashiers/Cashiers', [
            'transaction_id' => $transaction_id,
            'categories' => $categories,
            'products' => $products,
            'url' => url('/')
        ]);
    }

    public function showMenu($category_id)
    {
        $products = Product::where('category_id', '=', $category_id)->with('categories')->get();

        return response()->json([
            'success' => true,
            'data' => $products,
            'message' => 'Berhasil menampilkan menu kategori '
        ]);
    }

    public function store(TransactionsRequest $request)
    {
        // dd($request);
        DB::beginTransaction();
        try {
            foreach ($request->products as $data) {
                $transaction_detail = new TransactionDetail;
                $transaction_detail->transaction_id = $request->id_transaction;
                $transaction_detail->product_id = $data['id'];

                $product = Product::findOrFail($data['id']);
                $transaction_detail->count = $data['qty'];
                $transaction_detail->discount = $product->discount;
                $transaction_detail->new_price = $product->new_price;
                $transaction_detail->sub_total = $product->new_price * $data['qty'];
                $transaction_detail->save();
            }

            // dd($transaction_detail);

            $transaction = Transaction::findOrFail($request->id_transaction);
            $transaction->customer_name = $request->customer_name;
            $transaction->discount = $request->discount;

            $prod_detail = TransactionDetail::where('transaction_id', $request->id_transaction)->get();
            foreach ($prod_detail as $data) {
                $transaction->total_price += $data->sub_total;
            }

            $transaction->pay = $request->pay;
            $transaction->change = $transaction->pay - $transaction->total_price;
            $transaction->save();
            DB::commit();

            return redirect()->route('cashier.index');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
        }
    }

    public function destroy($id)
    {
        $transaction = Transaction::findOrFail($id);
        DB::beginTransaction();
        try {
            $transaction->delete();
            DB::commit();

            return redirect()->route('cashier.index');
        } catch (\Throwable $th) {
            DB::rollback();
            dd($th);
        }
    }
}
