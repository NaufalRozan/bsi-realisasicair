<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    protected $table = 'data';
    protected $fillable = ['id','Nama_Marketing','Outlet', 'Target_Jabatan', 'Total_Cair', 'Pencairan_Baru', 'Pencairan_TopUp', 'Total_Pencairan_Growth', 'Persenan'];


    public function user()
    {
        //Setiap data hanya dimiliki oleh satu user
        return $this->belongsTo(User::class);
    }

    protected $appends = ['full'];

    public function getTotalAttribute()
    {
        return $this->DB::table("harian")->sum('Realisasi_Cair', '+', 'Pencairan_TopUp');
    }
}