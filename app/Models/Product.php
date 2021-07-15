<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function procons()
    {
        return $this->hasMany(Procon::class);
    }

    public function getAdvantagesAttribute(){
        return $this->procons()->whereType('pro')->get();
    }

    public function getDisadvantagesAttribute(){
        return $this->procons()->whereType('con')->get();
    }
}
