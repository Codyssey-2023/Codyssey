<?php

namespace App\Http\Controllers;

use App\Models\Insertion;
use Illuminate\Http\Request;
use App\Http\Livewire\CreateInsertion;
use Illuminate\Support\Facades\Auth;

class InsertionController extends Controller
{
   // Funzione per le rotte delle inserzioni
   public function createInsertion(){
      return view('insertion.create');
   }
   public function showInsertions($category){
      $insertions= Insertion::orderBy('created_at', 'desc')->get();
      return view('insertion/insertions', compact('insertions', 'category'));
   }
   public function showDetail (Insertion $insertion){
      return view('insertion/detail', compact('insertion'));
   }
}

