<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailInventory extends Model
{
    use HasFactory;
    protected $fillable = ['nama_alat','jumlah','inventory_id'];
}
