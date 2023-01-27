<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Jobs\ResizeProfilePic;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Laravel\Fortify\Contracts\UpdatesUserPasswords;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateProfile extends Component
{
    use WithFileUploads;
    // public $state =[];
    
    public function mount()
    {
        $this->state = auth()->user()->only(['name', 'email']);
    }
    
    public function updateProfile(UpdatesUserProfileInformation $updater)
    {
        $updater->update(auth()->user(), [
            'name'=> $this->state['name'],
            'email'=> $this->state['email'],
        ]);
        
        session()->flash('message', 'Profile updated');
        return redirect('/profile');
    }
    
    public function render()
    {
        return view('livewire.update-profile');
    }
    
    public function changePassword(UpdatesUserPasswords $updater)
    {
        $updater->update(auth()->user(), [
            'current_password' => $this->state['current_password'] ?? '',
            'password' => $this->state['password'] ?? '',
            'password_confirmation' => $this->state['password_confirmation'] ?? '',
        ]);
        session()->flash('message', 'Password updated');
        return redirect('/profile');
    }
    
    public $image;
    public $temporary_image;
    public $user;
    
    protected $rules = [
        'temporary_image'=> 'image|max:2048',
        'image' => 'image|max:2048',
        
    ];
    protected $messages = [
        'temporary_image.image'=>'the image must be an image',
        'temporary_image.max'=>'the image must be max 2mb',       
        'image.image'=>'the file must be an image',
        'image.max'=>'the image must be max 2mb',
        
    ];
    public function updatedTemporaryImages()  {
        if ($this->validate(['temporary_image' => 'image|max:2048'])) {            
            $this->image = $this->temporary_image;
        }else {
            $this->removeImage();
        }
    }
    
    public function store(){
        $this->validate();
        
        $this->user = Auth::user();
        
        // dd(Auth::user()->picPath);
        if ($this->image != null){
            File::deleteDirectory(public_path("/storage/users/{$this->user->id}"));
            /* $this->insertion->images()->create(['path'=>$image->store('images', 'public')]);  */
            $newFileName = "users/{$this->user->id}";
            $newImage = $this->image->store($newFileName, 'public');
            // dd($newImage);
            // dd(storage_path() . '/app/public/'. $newFileName . "/" . "crop_300x300_" . $newImage);
            dispatch(new ResizeProfilePic($newImage , 300 , 300));
            $basename = basename($newImage);
            sleep(5);
            File::delete(public_path("/storage/users/{$this->user->id}/{$basename}"));
            File::deleteDirectory(storage_path('/app/livewire-tmp'));
            // $this->user = User::user()->picPath->create(storage_path() . '/app/public/'. $newFileName . "/" . "crop_300x300_" . $newImage);
            $this->user->picPath = $newFileName . "/" . "crop_300x300_" . $basename;
        }
        
        session()->flash('message', 'Profile pic loaded');
        // $this->user->picPath->save();
        // dd($this->user);
        
        $this->user->save();
        // Auth::user()->picPath = 0;
        $this->cleanForm();
    }
    
    protected function cleanForm(){
        $this->image = null;
        $this->temporary_image = null;
    }
    public function removeImage()
    {
        // $this->image = null;
        // $this->temporary_image = null;
        unset($this->image);
        unset($this->temporary_image);
    }
}
