<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    use HasFactory;

    public function photo_path(){
        if ($this->photo){
            return asset('storage/family/'.$this->photo);
        }
        return asset('default-image.png');
    }
}
