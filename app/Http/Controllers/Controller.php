<?php

namespace App\Http\Controllers;

use App\Models\Insertion;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function welcome() 
    {
        // Funzione per ordinare l'ordine delle inserzioni
        $insertions = Insertion::orderBy('created_at', 'DESC')->get();
        return view('welcome' , compact('insertions'));
    }
    
    
    public function setLanguage($lang)
    {
        // dd($lang);
        session()->put('locale', $lang);
        return redirect()->back();
    }
}
