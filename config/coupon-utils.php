<?php 
return [
    /**
     * Cấu hình nhận biết site có đang sử dụng đa ngôn ngữ hay không.
     * --------------------------------------------------------------
     * 
     * 
     */
    'is_multiple_lang' => false,
    
    /**
     * Cấu hình text nhận biết dạng Freeship
     * --------------------------------------------------------------
     * 
     * 
     */
    'free_shipping' => [ 
         /** Cấu hình text xuất hiện trong title để nhận biết là dạng giản giá theo số tiền.
         * Tất các cả text theo các ngôn ngữ khác nhau đều cấu hình vào đây.
         */
        'text' => ['free(.*)shipping', 'entrega', 'envío', 'livraison'], 
        /**
         * Cấu hình đoạn regex nhận dạng title theo từng ngôn ngữ. Mặc định sử dụng default. 
         * Nếu `is_multiple_lang` là true thì cấu regex theo từng ngôn ngữ được lấy theo 
         * function config(`app.locale`);
         */
        'regex' => [
            'default' => '/#text/i',
            'es_ES.utf8' => '/(#text) grat/i',
            'fr_FR.utf8' => '/(#text)/i'
        ],
         /**
         * Cấu hình đoạn value trả ra theo từng ngôn ngữ. Mặc định sử dụng default. 
         * Nếu `is_multiple_lang` là true thì cấu regex theo từng ngôn ngữ được lấy theo 
         * function config(`app.locale`);
         */
        'value' => [
            'default' => '',
            'es_ES.utf8' => '',
            'fr_FR.utf8' => ''
        ]
    ],

    /**
     * Cấu hình nhận biết giảm giá theo %
     * --------------------------------------------------------------
     * 
     * 
    */
    'percent' => [
        /** Cấu hình text xuất hiện trong title để nhận biết là dạng giản giá theo số tiền.
         * Tất các cả text theo các ngôn ngữ khác nhau đều cấu hình vào đây.
         */
        'text' => ['off'],
         /**
         * Cấu hình đoạn regex nhận dạng title theo từng ngôn ngữ. Mặc định sử dụng default. 
         * Nếu `is_multiple_lang` là true thì cấu regex theo từng ngôn ngữ được lấy theo 
         * function config(`app.locale`);
         */
        'regex' => [
            'default' => '/(\d+)% #text/i',
            'es_ES.utf8' => '/(\d+)%/i',
            'fr_FR.utf8' => '/(\d+)%/i'
        ],
         /**
         * Cấu hình đoạn value trả ra theo từng ngôn ngữ. Mặc định sử dụng default. 
         * Nếu `is_multiple_lang` là true thì cấu regex theo từng ngôn ngữ được lấy theo 
         * function config(`app.locale`);
         */
        'value' => [
            'default' => '#value%',
            'es_ES.utf8' => '#value%',
            'fr_FR.utf8' => '#value%'
        ]
    ],
    /**
     * Cấu hình nhận biết giảm giá theo số tiền
     * --------------------------------------------------------------
     * 
     */
    'amount' => [
        /** Cấu hình text xuất hiện trong title để nhận biết là dạng giản giá theo số tiền.
         * Tất các cả text theo các ngôn ngữ khác nhau đều cấu hình vào đây.
         */
        'text' => ['off', 'descuento'],

        /**
         * Cấu hình đoạn regex nhận dạng title theo từng ngôn ngữ. Mặc định sử dụng default. 
         * Nếu `is_multiple_lang` là true thì cấu regex theo từng ngôn ngữ được lấy theo 
         * function config(`app.locale`);
         */
        'regex' => [
            'default' => '/\$(\d+) #text/i',
            'es_ES.utf8' => '/(\d+)€(.*)(#text)/i',
            'fr_FR.utf8' => '/(\d+)€(.*)(#text)/i'
        ],
        /**
         * Cấu hình đoạn value trả ra theo từng ngôn ngữ. Mặc định sử dụng default. 
         * Nếu `is_multiple_lang` là true thì cấu regex theo từng ngôn ngữ được lấy theo 
         * function config(`app.locale`);
         */
        'value' => [
            'default' => '$#value', 
            'es_ES.utf8' => '€#value',
            'fr_FR.utf8' => '#value€'
        ]
    ],
];