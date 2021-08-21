<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pelajaran extends Model
{
    protected $table = 'pelajaran';
    protected $primary_key = 'id';
    protected $guarded = [];
}
