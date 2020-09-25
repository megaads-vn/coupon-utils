<?php

namespace Megaads\CouponUtils;

class CouponUtils {

    const DEFAULT_CONFIG = [
        'free_shipping' => [
            'text' => ['free(.*)shipping'],
            'regex' => [
                'default' => '/#text/i',
            ],
            'value' => [
                'default' => '',
            ]
        ],
        'percent' => [
            'text' => ['off'],
            'regex' => [
                'default' => '/(\d+)% #text/i',
            ],
            'value' => [
                'default' => '#value%',
            ]
        ],
        'amount' => [
            'text' => ['off'],
            'regex' => [
                'default' => '/\$(\d+) #text/i',
            ],
            'value' => [
                'default' => '$#value', 
            ]
        ],
    ];

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
                                preg_match('/(envío|entrega) grat/i', $title, $matches);
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
                        $freeShippingText = [
                            'portes grátis',
                            'portes gratís',
                            'entrega gratís',
                            'envio gratís',
                            'entrega gratuita',
                            'entrega ao domicílio gratuita',
                            'envio gratuito',
                            'entrega grátis',
                            'envio grátis',
                            'frete grátis'
                        ];
                        $freeShippingText = join('|', $freeShippingText);
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
                                preg_match("/($freeShippingText)/i", $title, $matches);
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

    public static function detectCouponType ($title, $type = 'COUPON') {
        $retval = [
            'type' => ($type === 'COUPON_CODE') ? 'discount' : 'deal',
            'value' => '',
        ];
        $config = config('coupon-utils');
        $currentLang = 'default';
        $isMultipleLang = $config['is_multiple_lang'];
        unset($config['is_multiple_lang']);
        $configText = $config;
        if (empty($configText)) {
            $configText = self::DEFAULT_CONFIG;
        }
        if ($isMultipleLang) {
            $currentLang = config('app.locale');
        }
        
        foreach ($configText as $key => $value) {
            if (!empty($value['text'])) {
                $text = join('|', $value['text']);
                $regexValue = isset($value['regex'][$currentLang]) ? $value['regex'][$currentLang] : $value['regex']['default'];
                $regex = str_replace('#text', $text, $regexValue);
                preg_match($regex, $title, $matches);
                if (count($matches) > 1) {
                    $detectVal = trim($matches[1]);
                    $replaceValue = isset($value['value'][$currentLang]) ? $value['value'][$currentLang] : $value['value']['default'];
                    $retval = [
                        'type' => $key, 
                        'value' => str_replace('#value', $detectVal, $replaceValue)
                    ];
                    break;
                }
            }
        }
        return $retval;
    }
}
