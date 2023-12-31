<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }

    public function VoucherRecord()
    {
        return $this->hasOne(VoucherRecord::class);
    }

    public function vouchers()
    {
        return $this->belongsToMany(Voucher::class, VoucherRecord::class);
    }
    protected $fillable = ["name","brand_id","actual_price","sales_price",'total_stock','unit','more_information','user_id','photo'];

}
