<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spreadsheet extends Model
{
    use HasFactory;
    protected $fillable = [
        "user_id",
        "type",
        "date", 
        "amount", 
        "description", 
        "category", 
    ];
    public function status(){
        return $this->belongsTo(Status::class);
    }
}