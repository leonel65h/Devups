<?php
            //ModulePaiement

        require '../../../admin/header.php';

// move comment scope to enable authentication
if (!isset($_SESSION[ADMIN]) and $_GET['path'] != 'connexion') {
    header("location: " . __env . 'admin/login.php');
}

        global $viewdir, $moduledata;
        $viewdir[] = __DIR__ . '/Ressource/views';

$moduledata = Dvups_module::init('ModulePaiement');




        define('CHEMINMODULE', ' ');


        $dvups_transactionCtrl = new Dvups_transactionController();
		$dvups_agregateurCtrl = new Dvups_agregateurController();


(new Request('layout'));

switch (Request::get('path')) {

    case 'dvups-transaction/index':
        $dvups_transactionCtrl->listView();
        break;

    case 'dvups-agregateur/index':
        Genesis::renderView("overview",$dvups_agregateurCtrl->listAgregateur());
        break;
    case 'dvups-statistique/index':
        Genesis::renderView("statistique",$dvups_transactionCtrl->listeTransaction());
        break;
    case 'dvups-agregateurs/index':
        $dvups_agregateurCtrl->choixAgregateur(Request::get('name'));
        break;

    default:
        Genesis::renderView('404', ['page' => Request::get('path')]);
        break;
}
    
    