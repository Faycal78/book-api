<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class book extends Model
{

    protected $fillable = ['title', 'author', 'publication_year', 'isbn'];

    use HasFactory;
}
