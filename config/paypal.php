<?php 
return [ 
    'client_id' => 'AdrChUIUylavWt7gYkL6-wP0_MIiqSzW-hWxb8DuDsoBC3dh1ANJjWKkQBdEm2m0sWL8VSPFGGWUz0rR',
	'secret' => 'AdrChUIUylavWt7gYkL6-wP0_MIiqSzW-hWxb8DuDsoBC3dh1ANJjWKkQBdEm2m0sWL8VSPFGGWUz0rR',
    'settings' => array(
        'mode' => 'sandbox',
        'http.ConnectionTimeOut' => 1000,
        'log.LogEnabled' => true,
        'log.FileName' => storage_path() . '/logs/paypal.log',
        'log.LogLevel' => 'FINE'
    ),
];