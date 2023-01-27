<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\AdminMail;
use App\Models\Insertion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    //* Funzione per la revisionPage 
    public function revisionPage(){
        $insertions = Insertion::orderBy('created_at', 'desc')->get();
        return view ('revision.revisionPage', compact('insertions'));
    }

    //* Funzioni per gli annunci
    public function acceptInsertion (Insertion $insertion) {
        $insertion->setAccepted(true);
        session()->flash('message', 'Insertion accepted');
        return redirect('/revisor/welcome');
    }
    public function suspendInsertion (Insertion $insertion) {
        $insertion->setAccepted(false);
        session()->flash('message', 'Insertion suspended');
        return redirect('/revisor/welcome');
    }
    public function deleteInsertion (Insertion $insertion) {
        $insertion->delete();
        File::deleteDirectory(public_path("/storage/insertions/{$insertion->id}"));
        session()->flash('message', 'Insertion deleted');
        return redirect('/revisor/welcome');
    }
    //! Funzione da usare per comprare 
    // public function purchaseInsertion (Insertion $insertion) {
    //     $insertion->delete();
    //     session()->flash('message', 'Successfully purchased');
    //     return redirect('/revisor/welcome');
    // }

    //* Funzioni per vista profilo e funzioni per utente 
    public function showProfile(){        
        return view ('user/userProfile');
    }
    public function revisorRequest()
    {
        Mail::to('admin@admin.admin')->send(new AdminMail(Auth::user()));
        session()->flash('message', 'Request sent');
        return redirect('profile');
    }
    public function makeRevisor(User $user)
    {
        Artisan::call('presto:MakeUserRevisor', ["email"=>$user->email]);  
        Auth::logout();      
        session()->flash('message', 'New revisor accepted');
        return redirect('login');
    }
    public function workWithUs()
    {
        return view('user.workWithUs');
    }
    
    //* Funzioni per la ricerca
    public function searchInsertion(Request $request)
    {
        //* IGNORATE GLI "ERRORI"!

        $editedRequest = strtolower($request->searched);
        if ($editedRequest == 'giochi' || $editedRequest == 'juegos') {
            $editedRequest = "games";
        }
        if ($editedRequest == 'deporte') {
            $editedRequest = "sport";
        }
        if ($editedRequest == 'abbigliamento' || $editedRequest == 'ropa') {
            $editedRequest = "clothing";
        }
        if ($editedRequest == 'casa' || $editedRequest == 'cucina' || $editedRequest == 'casa e cucina' || $editedRequest == 'cogar') {
            $editedRequest = "Homeliving";
        }
        if ($editedRequest == 'elettronica' || $editedRequest == 'electrónica') {
            $editedRequest = "Elettronics";
        }
        if ($editedRequest == 'gioielleria' || $editedRequest == 'joyería') {
            $editedRequest = "Jewelry";
        }
        if ($editedRequest == 'computer' || $editedRequest == 'ordenadores') {
            $editedRequest = "Computers & other";
        }
        if ($editedRequest == 'Libri' || $editedRequest == 'Libro') {
            $editedRequest = "Books";
        }
        if ($editedRequest == 'videogiochi' || $editedRequest == 'videojuegos') {
            $editedRequest = "Videogames";
        }
        if ($editedRequest == 'musica' || $editedRequest == 'música') {
            $editedRequest = "Music";
        }
        
        $insertions = Insertion::search($editedRequest)->where('is_accepted', true)->get();

        return view('insertion.insertionAll', compact('insertions', 'request'));
    }

    public function emailVerify()
    {
        return view('auth.verify-email');
    }

    //Elinima immagine profilo
    public function deleteProfilePic (User $user) {
        $user->picPath= null;
        $user->save();
        File::deleteDirectory(public_path("/storage/users/{$user->id}"));
        session()->flash('message', 'Profile pic removed');
        return redirect('/profile');
    }
}
