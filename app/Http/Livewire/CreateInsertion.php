<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Jobs\RemoveFaces;
use App\Jobs\ResizeImage;
use App\Jobs\WaterMark;
use Livewire\WithFileUploads;
use App\Jobs\GoogleVisionLabelImage;
use App\Jobs\GoogleVisionSafeSearch;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;


class CreateInsertion extends Component
{
    use WithFileUploads;
    
    public $title;
    public $category;
    public $description;
    public $price;
    public $temporary_images;
    public $images = [];
    public $insertion;
    
    protected $rules = [
        'title'=>'required|min:4',
        'category'=>'required',
        'description'=>'required|min:10',
        'price'=> 'required|numeric',
        'images' => 'nullable|array|max: 5',
        'temporary_images' => 'nullable|array|max: 5',
        'images.*'=>'image|max:2048',
        'temporary_images.*'=> 'image|max:2048|dimensions:min_width=1,min_height=1',
    ];
    
    protected $messages = [
        'required'=>'The field :attribute is obligatory',
        'min'=>'the field :attribute is too short',
        'numeric'=>'the field :attribute is\' a number',
        'images.max' => 'max 5 images',
        'temporary_images.max' => 'max 5 images',
        'images.*.image'=>'files must be images',
        'images.*.max'=>'the image must be max 2mb',   
        'temporary_images.*.image'=>'files must be images',
        'temporary_images.*.max'=>'the image must be max 2mb',    
        
    ];
    
    public function updatedTemporaryImages()
    {
        $this->images = [];
        // dd($this->temporary_images[0]);
        if ($this->validate(['temporary_images' => 'array|max: 5']) && $this->validate(['temporary_images.*' => 'image|max:2048',])) {
            foreach ($this->temporary_images as $image) {
                $this->images[] = $image;
            }
        }else {
            $this->removeAllImages();
        }
    }
    
    public function removeImage($key)
    {
        if (in_array($key, array_keys($this->images))) {
            unset($this->images[$key]);
        }
        if (in_array($key, array_keys($this->temporary_images))) {
            unset($this->temporary_images[$key]);
        }
    }
    public function removeAllImages()
    {
        $lenght =  sizeof($this->temporary_images);
        for ($i=0; $i < $lenght; $i++) { 
            if (in_array($i, array_keys($this->images))) {
                unset($this->images[$i]);
            }
            if (in_array($i, array_keys($this->temporary_images))) {
                unset($this->temporary_images[$i]);
            }
        }
        // dd($i);
    }
    
    public function store(){
        $this->validate();
        $this->images = [];
        // dd($this->temporary_images[0]);
        if ($this->validate(['temporary_images' => 'array|max: 5']) && $this->validate(['temporary_images.*' => 'image|max:2048',])) {
            foreach ($this->temporary_images as $image) {
                $this->images[] = $image;
            }
        }else {
            $this->removeAllImages();
        }
        
        $this->insertion = Category::find($this->category)->insertions()->create($this->validate());
        if (count($this->images)){
            foreach ($this->images as $image) {
                /* $this->insertion->images()->create(['path'=>$image->store('images', 'public')]);  */
                $newFileName = "insertions/{$this->insertion->id}";
                $newImage = $this->insertion->images()->create(['path'=>$image->store($newFileName, 'public')]);
                // dd(new ResizeImage($newImage->path , 300 , 300));
                RemoveFaces::withChain([
                    
                    new ResizeImage($newImage->path , 300 , 300),
                    new GoogleVisionSafeSearch($newImage->id),
                    new GoogleVisionLabelImage($newImage->id),
                    ])->dispatch($newImage->id);
                }
                
                File::deleteDirectory(storage_path('/app/livewire-tmp'));
                
            }
            
            session()->flash('message', 'Your insertion inserted correctly');
            
            $this->insertion->user()->associate(Auth::user());
            $this->insertion->save();
            
            $this->cleanForm();
            
        }
        
        public function updated($update){
            $this->validateOnly($update);
        }
        
        protected function cleanForm(){
            $this->title = "";
            $this->category = "";
            $this->description = "";
            $this->price = "";
            $this->images = [];
            $this->temporary_images = [];
        }
        
        public function render()
        {
            return view('livewire.create-insertion');
        }
        
    }
    
    