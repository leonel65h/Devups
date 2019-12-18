<?php 


use DClass\devups\Datatable as Datatable;

class Dvups_agregateurController extends Controller{

    public function listAgregateur(){
        return[
            'success'=>true,
            'agregateur'=>Dvups_agregateur::all('nom')
        ];
    }

    public function choixAgregateur($agregateur){
        switch ($agregateur){
            case 'monetbil':
                Genesis::renderView('agregateur.monetbil');
                break;
            case 'afrikpay':
                Genesis::renderView('agregateur.afrikpay');
                break;
        }
    }

    
}
