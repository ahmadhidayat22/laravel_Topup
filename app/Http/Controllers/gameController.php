<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Transaksi;
use App\Models\game_details;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Storage;

class gameController extends Controller
{
    public function index()
    {
        return view('/home' , [
            "game" => Game::all()
        ]);
    }

    public function show(Game $game){
        
        return view('/game',[
            "game" => $game,
            "denom" => game_details::where('id_game' , $game->id)->get()
        ]);
    }

    public function store(Request $request)
    {
    //     $rules = $request->validate([
    //         'id' => 'required',
    //         'nama' => 'required',
    //     ]);

    //    $validatedata = $request->validate($rules);

    //     Transaksi::create($request);
    //     return redirect('home')->with('success', 'succes buy'); 

       return view('/bayar' , [
            'id' => $request->id,
            'zoneId' => $request->zone_id,
            'denom' => $request->denom,
            'whatsapp' => $request->whatsapp
            
       ]);
    }
}
