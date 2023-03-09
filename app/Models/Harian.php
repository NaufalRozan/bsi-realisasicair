<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Harian extends Model
{
    protected $table = 'harian';
    protected $fillable = ['id', 'name', 'Realisasi_Cair', 'tanggal', 'Total_Pencairan', 'Pencairan_TopUp', 'Outlet'];

    public function user()
    {
        //Setiap data hanya dimiliki oleh satu user
        return $this->belongsTo(User::class);
    }

    protected $appends = ['total'];

    public function getTotalAttribute()
    {
        return $this->DB::table("harian")->sum('Realisasi_Cair');
    }


}
