<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories'; // add if needed
    public $timestamps = true;  
    protected $fillable = [
        'name',
        'icon',
        'description'
    ];
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
