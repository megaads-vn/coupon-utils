<?php

namespace Megaads\CouponUtils;

class CouponUtils {
    public static function getCouponType ($title) {
        $retval = [
            'type' => 'deal',
            'value' => '',
        ];

        preg_match('/(\d+)% off/i', $title, $matches);
        if (count($matches) > 1) {
            $retval = [
                'type' => 'percent',
                'value' => $matches[1] . '%',
            ];
        } else {
            preg_match('/\$(\d+) off/i', $title, $matches);
            if (count($matches) > 1) {
                $retval = [
                    'type' => 'amount',
                    'value' => '$' . $matches[1],
                ];
            } else {
                preg_match('/free(.*)shipping/i', $title, $matches);
                if (count($matches) > 1) {
                    $retval = [
                        'type' => 'free_shipping',
                        'value' => '',
                    ];
                }
            }
        }

        return $retval;
    }
}
