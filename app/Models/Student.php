<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable=['family_id'];
    public function family(){
       return $this->belongsTo(Family::class);
    }
    public function photo_path(){
        if ($this->photo){
            return asset('storage/student/'.$this->photo);
        }
        return asset('default-image.png');
    }
}
