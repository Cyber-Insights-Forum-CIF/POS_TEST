<?php

namespace Database\Seeders;

use App\Models\VoucherRecord;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VoucherRecordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
//        VoucherRecord::factory(0)->create();
//        foreach (VoucherRecord::all() as $key => $VoucherRecord) {
//            $voucher =  $VoucherRecord->Voucher;
//            $voucher->total +=  $VoucherRecord->cost;
//            $voucher->net_total = $voucher->total  + ($voucher->total * ($voucher->tax / 100));
//            $voucher->update();
//        }
        VoucherRecord::factory(5)->create();
    }
}
