<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class page extends Model
{
    use HasFactory;
    protected $fillable = ['user','introduction','description','logo','background'];
}
