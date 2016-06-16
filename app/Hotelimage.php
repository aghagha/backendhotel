<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hotelimage extends Model
{
    protected $table = 'images';
    protected $fillable = ['hotelid', 'image_url'];

}
