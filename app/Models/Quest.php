<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quest extends Model
{
	protected $fillable = ['misi','rewards'];	
    use HasFactory;
}
