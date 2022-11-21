<?php

namespace App\Http\Controllers\api;

use App\Http\Requests\TransactionRequest;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{

    public function show()
    {
        $transactions = Transaction::all();
        return view('welcome', ['transactions' => $transactions]);
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $data = Transaction::where('payment_id', 'LIKE', $request->payment_id . '%')->get();
            $output = '';
            if (count($data) > 0) {
                $output = '<ul class="list-group" style="display:block;position:relative;z-indez:1">';
                foreach ($data as $row) {
                    $output .= '<li class="list-group-item">' . $row->payment_id . '</li>';
                }
                $output .= '</ul>';
            } else {
                $output .= '<br><li class="list-group-item" style="color:#ff0000;"><strong>NO Data Found!</strong></li>';
            }
            return $output;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    use apiResponseTrait;
    public function create(TransactionRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = Transaction::create([
                'payment_id'       => $request->payment_id,
                'amount'           => $request->amount,
                'currency'         => $request->currency,
                'status'           => $request->status,
            ]);
            DB::commit();
            if ($data) {
                return redirect('welcome');
            } else {
                return $this->apiResponse('Application error please try again', [], $data, [], 400);
            }
        } catch (\Throwable $th) {
            DB::rollback();
            return $this->apiResponse('Application error please try again', [], $th, [], 400);
        }
    }

}
