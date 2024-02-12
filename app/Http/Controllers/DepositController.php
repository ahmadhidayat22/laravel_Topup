<?php

namespace App\Http\Controllers;

use App\Models\transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Sanctum\Sanctum;
use Illuminate\Support\Facades\Auth;

class DepositController extends Controller
{
      /** @var \App\Models\User $user **/
     
    public function deposit(Request $request)
    {
        $user = Auth::user();
        
    
        $id_user = $user->id;
        $jumlah = $request->jumlah;
        $angka_tanpa_koma = str_replace('.', '', $jumlah);
        // dd($angka_tanpa_koma);
        // Dekripsi token
        // $user = Sanctum::decrypt($token);
    
        // Dapatkan id user
        $akun = User::find($id_user);

        $akun->saldo += $angka_tanpa_koma;

        $akun->save();

        return redirect('/dashboard/deposit');
        // return view('/bayar' , [
        //     'data' => $request,
        //     'user_id' => $id_user
        // ]);
    }
     public function index()
     { 
        return view('user.deposit', [
            'data' => transaction::latest()->where('transaction_user_id', Auth::user()->id)->where('transaction_type' , 'deposit')->paginate(7)->withQueryString()
        ]);
        
     }
     public function show($id_trx)
     {
        // dd(transaction::where('transaction_code', $id_trx)->first());
        return view('user.detailDeposit', [
            'data' => transaction::where('transaction_code', $id_trx)->first()
        ]);
     }
}
