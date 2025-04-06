<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dependencias extends Model
{
    protected $table = 'dependencias';

    public $timestamps = false;

    protected $primaryKey = null;
    public $incrementing = false;
 
    protected $fillable = [
         'cod_depen',
         'des_depen'
     ];
}
