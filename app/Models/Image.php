<?php

namespace App\Models;

use App\Models\Insertion;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Image extends Model
{
    use HasFactory;
    
    protected $fillable = ['path'];
    /*! NON TOCCARE PER NESSUNA RAGIONE ALTRIMENTI SALTA LA USER 07 E SARAI KILLATO
 */
    protected $casts = [
        'labels'=>'array'
    ];
    
    public function insertion()
    {
        return $this->belongsTo(Insertion::class);
    }
    
    public static function getUrlByFilePath($filePath , $w =null , $h = null)
    {
        if(!$w && !$h){
            return Storage::url($filePath);
        }
        
        $path = dirname($filePath);
        $filename = basename($filePath);
        $file = "{$path}/crop_{$w}x{$h}_{$filename}";
        // dd($file);
        return Storage::url($file);
    }
    
    public function getUrl($w = null , $h = null)
    {
        return Image::getUrlByFilePath($this->path , $w , $h);
    }
}
