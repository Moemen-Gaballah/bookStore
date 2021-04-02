<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'status',
    ];


    public function books()
    {
        return $this->hasMany(Book::class);
    }

    // Accessors & Mutators
    // accessor
    public function getCreatedAtAttribute($date)
    {
        return \Carbon\Carbon::parse($date)->diffForHumans();
    }

    // public function getStatusAttribute($status)
    // {
    //     return ($status == 1) ? 'Active' : 'In active' ;
    // }
}
