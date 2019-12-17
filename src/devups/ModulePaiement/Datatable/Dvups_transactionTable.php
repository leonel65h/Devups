<?php 


use DClass\devups\Datatable as Datatable;

class Dvups_transactionTable extends Datatable{
    
    public $entity = "dvups_transaction";

    public $datatablemodel = [
['header' => 'Heure', 'value' => 'heure'], 
['header' => 'Montant', 'value' => 'montant'], 
['header' => 'Dvups_agregateur', 'value' => 'Dvups_agregateur.nom']
];

    public function __construct($lazyloading = null, $datatablemodel = [])
    {
        parent::__construct($lazyloading, $datatablemodel);
    }

    public static function init($lazyloading = null){
        $dt = new Dvups_transactionTable($lazyloading);
        return $dt;
    }

    public function buildindextable(){

        return $this;
    }
    
    public function builddetailtable()
    {
        $this->datatablemodel = [
['label' => 'Heure', 'value' => 'heure'], 
['label' => 'Montant', 'value' => 'montant'],
['label' => 'Dvups_agregateur', 'value' => 'Dvups_agregateur.nom']
];
        $this->enabletopaction=true;
        return $this;
    }

}
