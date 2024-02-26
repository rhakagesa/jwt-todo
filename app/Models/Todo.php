<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'tasks';
    protected $primaryKey = '_id';
    protected $fillable = ['task'];

}
