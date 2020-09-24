<?php 
return [
    'free_shipping' => [
        'text' => ['free(.*)shipping'],
        'regex' => '/#text/i',
        'value' => ''
    ],
    'percent' => [
        'text' => ['off'],
        'regex' => '/(\d+)% #text/i',
        'value' => '#value%'
    ],
    'amount' => [
        'text' => ['off'],
        'regex' => '/\$(\d+) #text/i',
        'value' => '$#value'
    ],
];