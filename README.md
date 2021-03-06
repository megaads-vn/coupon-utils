Cài đặt: 

```
composer require megaads/coupon-utils
```
Sau khi cài đặt xong thì cấu hình Service Provider class vào file `app.php` trong thư mục `config` của Laravel như sau: 
```
Megaads\CouponUtils\CouponUtilsServiceProvider::class,
```
Sau đó thì chạy câu lệnh sau để tạo file cấu hình:
```
php artisan vendor:publish --provider="Megaads\CouponUtils\CouponUtilsServiceProvider" --tag=config --force
```
Sau khi chạy lệnh thì file cấu hình được tạo sẽ có nội dung như sau: 

```
return [
    'free_shipping' => [
        'text' => ['free(.*)shipping'],
        'regex' => [
            'default' => '/#text/i'
        ],
        'value' => [
            'default' => ''
        ]
    ],
    'percent' => [
        'text' => ['off'],
        'regex' => [
            'default' => '/(\d+)% #text/i'
        ],
        'value' => [
            'default' => '#value%'
        ]
    ],
    'amount' => [
        'text' => ['off'],
        'regex' => [
            'default' => '/\$(\d+) #text/i'
        ],
        'value' => [
            'default' => '$#value'
        ]
    ],
];

```
Sau khi sửa file cấu hình xong thì chạy lệnh sau để clear cache: 
```
php artisan config:cache

php artisan cache:clear
```
Thêm cái này vào 'aliases' => [] trong file app.php
```
'CouponUtils' => Megaads\CouponUtils\CouponUtils::class,
```
Rồi gọi cái này để lấy coupon promotion type :
```
$couponType = CouponUtils::detectCouponType($titleOfCoupon);
```
Hoặc gọi theo kiểu cũ không dùng file cấu hình ở trên:
```
$couponType = CouponUtils::getCouponType($titleOfCoupon);
```
Return trả về kiểu kiểu như sau
```
$retval = [
    'type' => 'deal',
    'value' => '',
];
```
Trong đó type có thể là :
'deal', 'percent', 'amout', 'free_shipping'

Value có thể là :
'', '30', ...
