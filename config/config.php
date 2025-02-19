<?php
function detectEnvironment()
{
    // cheking if it is development or production

    $host = $_SERVER['HTTP_HOST'];
    $devDomains = ['dev.tradefix.co.il'];

    if (strpos($host, 'localhost') !== false || in_array($host, $devDomains)) {
        return 'development';
    } else {
        return 'production';
    }
}

return [
    'development' => [
        'host' => 'localhost',
        'username' => 'root',
        'password' => '',
        'database' => 'tradefixbrglp_legalLoss', 
        'base_url' => '/tradefix/TradeFixNew',      
    ],
    'production' => [
        'host' => 'localhost',//'webxpcpanel.spd.co.il',
        'username' => 'tradefixbrglp_legalLoss',
        'password' => '3XZWG;@6]JPA',
        'database' => 'tradefixbrglp_legalLoss',  
        'base_url' => '/backend',      
    ],
];


?>