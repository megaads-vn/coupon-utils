Thêm cái này vào 'aliases' => [] trong file app.php

'CouponUtils' => Megaads\CouponUtils\CouponUtils::class,

Rồi gọi cái này để lấy coupon promotion type :

$couponType = CouponUtils::getCouponType($titleOfCoupon);

Return trả về kiểu kiểu như sau

$retval = [
    'type' => 'deal',
    'value' => '',
];

Trong đó type có thể là :
'deal', 'percent', 'amout', 'free_shipping'

Value có thể là :
'', '30', ...
