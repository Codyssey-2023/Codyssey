<?php

namespace App\Models;

use App\Models\User;
use App\Models\Image;
use App\Models\Category;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Insertion extends Model
{
    use HasFactory, Searchable;
    protected $fillable = ['title', 'description', 'price'];

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        $category = $this->category;
        $array = [
            'id'=> $this->id, 
            'title'=> $this->title,
            'description'=> $this->description,
            'category'=> $category,
        ];
 
 
        return $array;
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function setAccepted($value)
    {
        $this->is_accepted = $value;
        $this->save();
        return true;
    }
    public static function toBeRevisionedCount()
    {
        return Insertion::where('is_accepted', null)->count();
    }
    public function images()
    {
        // dd( $this->hasMany(Image::class)->get());
        return $this->hasMany(Image::class);
    }
}
