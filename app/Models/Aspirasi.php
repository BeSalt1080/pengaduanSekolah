<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aspirasi extends Model
{
    use HasFactory;
    protected $fillable = ['nis','kategori_id','lokasi','keterangan','foto'];
    public function tanggapan(){
        return $this->hasMany(Tanggapan::class);
    }
    public function kategori(){
        return $this->belongsTo(Kategori::class);
    }
}
