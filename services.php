<?php

global $_start;
$_start = microtime(true);

require __DIR__ . '/header.php';

use devups\ModulePaiement\Controller\AfrikpayController;
use Genesis as g;
use Request as R;
use devups\ModulePaiement\Controller\MonetbilController;


header("Access-Control-Allow-Origin: *");

$transaction = new Dvups_transactionController();

(new Request('hello'));

switch (Request::get('path')) {

    case 'add.reference':
        g::json_encode(MonetbilController::reference());
        break;
    case 'add.referenceAfrikpay':
        g::json_encode(AfrikpayController::reference());
        break;
    case 'send.payment':
        g::json_encode($transaction->paiement());
        break;

    default :
        g::json_encode(["success" => false, "message" => "404 :".Request::get('path')." page note found"]);
        break;
}