<?php

namespace App\Console\Commands;

use App\Models\Coupon\Coupon;
use Carbon\Carbon;
use Illuminate\Console\Command;

class UpdateCouponStatusCommand extends Command
{

    protected $signature = 'coupon:update-status';

    protected $description = 'Update coupon status based on expiry date';

    public function handle()
    {
        $coupons = Coupon::where('coupon_status', 'active')->get();

        foreach ($coupons as $coupon) {
            $expiryDate = Carbon::createFromFormat('Y-m-d H:i:s', $coupon->coupon_validity);

            if (Carbon::now() > $expiryDate) {
                if ($coupon->coupon_status === 'active') {
                    $coupon->update(['coupon_status' => 'inactive']);
                    $this->info('Coupon status updated for coupon ID: ' . $coupon->id);
                } else {
                    $this->info('Skipping inactive coupon with ID: ' . $coupon->id);
                }
            }
        }

        $this->info('Coupon status update completed.');
    }
}
