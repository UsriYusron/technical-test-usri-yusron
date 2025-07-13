<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employees extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 
        'name', 
        'image', 
        'position', 
        'phone', 
        'divisi_id'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id = (string) Str::uuid();
        });
    }

    // buat relasi ke tabel divisi
    public function division()
    {
        return $this->belongsTo(Divisi::class, 'divisi_id');
    }
}
