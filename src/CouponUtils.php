<?php

namespace Megaads\CouponUtils;

class CouponUtils {
    public static function getCouponType ($title, $type = 'COUPON') {

        $retval = [
            'type' => ($type === 'COUPON_CODE') ? 'discount' : 'deal',
            'value' => '',
        ];
    
        try {
            switch (config('app.locale', 'en')) {
                    case 'de':
                        preg_match('/(\d+)%/i', $title, $matches);
                        if (count($matches) > 1) {
                            $retval = [
                                'type' => 'percent',
                                'value' => $matches[1] . '%',
                            ];
                        } else {
                            preg_match('/(\d+)€(.*)(rabatt|nachlass|gutschein|Ermäßigung)/i', $title, $matches);
                            if (count($matches) > 1) {
                                $retval = [
                                    'type' => 'amount',
                                    'value' => $matches[1] . '€',
                                ];
                            } else {
                                preg_match('/(kostenlose(.*)lieferung|versand)/i', $title, $matches);
                                if (count($matches) > 1) {
                                    $retval = [
                                        'type' => 'free_shipping',
                                        'value' => '',
                                    ];
                                }
                            }
                        }
                        break;

                    case 'fr':
                        preg_match('/(\d+)%/i', $title, $matches);
                        if (count($matches) > 1) {
                            $retval = [
                                'type' => 'percent',
                                'value' => $matches[1] . '%',
                            ];
                        } else {
                            preg_match('/(\d+)€(.*)(off)/i', $title, $matches);
                            if (count($matches) > 1) {
                                $retval = [
                                    'type' => 'amount',
                                    'value' => $matches[1] . '€',
                                ];
                            } else {
                                preg_match('/(livraison)/i', $title, $matches);
                                if (count($matches) > 1) {
                                    $retval = [
                                        'type' => 'free_shipping',
                                        'value' => '',
                                    ];
                                }
                            }
                        }
                        break;

                    case 'es':
                        preg_match('/(\d+)%/i', $title, $matches);
                        if (count($matches) > 1) {
                            $retval = [
                                'type' => 'percent',
                                'value' => $matches[1] . '%',
                            ];
                        } else {
                            preg_match('/(\d+)€(.*)(descuento)/i', $title, $matches);
                            if (count($matches) > 1) {
                                $retval = [
                                    'type' => 'amount',
                                    'value' => $matches[1] . '€',
                                ];
                            } else {
                                preg_match('/(envío|entrega)/i', $title, $matches);
                                if (count($matches) > 1) {
                                    $retval = [
                                        'type' => 'free_shipping',
                                        'value' => '',
                                    ];
                                }
                            }
                        }
                        break;

                    case 'cn':
                        preg_match('/(\d+)折/i', $title, $matches);
                        if (count($matches) > 1) {
                            $retval = [
                                'type' => 'percent',
                                'value' => $matches[1] . '折',
                                // 'value' => (10 - $matches[1]) * 10 . '%',
                            ];
                        } else {
                            preg_match('/减(\d+元|\d+\$)/i', $title, $matches);
                            if (count($matches) > 1) {
                                $retval = [
                                    'type' => 'amount',
                                    'value' => $matches[1],
                                ];
                            } else {
                                preg_match('/(运费)/i', $title, $matches);
                                if (count($matches) > 1) {
                                    $retval = [
                                        'type' => 'free_shipping',
                                        'value' => '',
                                    ];
                                }
                            }
                        }
                        break;
                    case 'it':
                        preg_match('/(\d+)% (di sconto|di saldo|di sconti|di saldi|di risparmio)/i', $title, $matches);
                        if (count($matches) > 1) {
                            $retval = [
                                'type' => 'percent',
                                'value' => $matches[1] . '%',
                            ];
                        } else {
                            preg_match('/(sconto di|sconti di|risparmio di|risparmia di|regalo di|regala)\s(\d+)€/i', $title, $matches);
                            if (count($matches) > 1) {
                                $retval = [
                                    'type' => 'amount',
                                    'value' => $matches[1] . '€',
                                ];
                            } else {
                                preg_match('/(spedizione gratis|spedizione gratuita)/i', $title, $matches);
                                if (count($matches) > 1) {
                                    $retval = [
                                        'type' => 'free_shipping',
                                        'value' => '',
                                    ];
                                }
                            }
                        }
                    break;
                    case 'pt':
                        preg_match('/(\d+)% (de desconto)/i', $title, $matches);
                        if (count($matches) > 1) {
                            $retval = [
                                'type' => 'percent',
                                'value' => $matches[1] . '%',
                            ];
                        } else {
                            preg_match('/(\d+)€\s(de desconto)/i', $title, $matches);
                            if (count($matches) > 1) {
                                $retval = [
                                    'type' => 'amount',
                                    'value' => $matches[1] . '€',
                                ];
                            } else {
                                preg_match('/(portes gratís|entrega gratís|envio gratís|entrega gratuita|entrega ao domicílio gratuita|envio gratuito)/i', $title, $matches);
                                if (count($matches) > 1) {
                                    $retval = [
                                        'type' => 'free_shipping',
                                        'value' => '',
                                    ];
                                }
                            }
                        }
                    break;
                    default:
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
                        break;
                }

        } catch (\Exception $e) {
            \Log::error("$title cannot get type");
        }


        return $retval;
    }
}
