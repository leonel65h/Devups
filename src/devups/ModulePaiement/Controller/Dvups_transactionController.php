<?php


use DClass\devups\Datatable as Datatable;

class Dvups_transactionController extends Controller{

    public function listView($next = 1, $per_page = 10){

        $lazyloading = $this->lazyloading(new Dvups_transaction(), $next, $per_page);

        self::$jsfiles[] = Dvups_transaction::classpath('Ressource/js/transactionCtrl.js');

        $this->entitytarget = 'Devups_transaction';
        $this->title = "Manage Dvups_transaction";

        $this->renderListView(Dvups_transactionTable::init($lazyloading)->buildindextable()->render());

    }

    public function datatable($next, $per_page) {
        $lazyloading = $this->lazyloading(new Dvups_transaction(), $next, $per_page);
        return ['success' => true,
            'datatable' => Dvups_transactionTable::init($lazyloading)->buildindextable()->getTableRest(),
        ];
    }

    public function createAction($transaction_form = null){
        extract($_POST);

        $transaction = $this->form_fillingentity(new Dvups_transaction(), $transaction_form);


        if ( $this->error ) {
            return 	array(	'success' => false,
                            'transaction' => $transaction,
                            'action' => 'create',
                            'error' => $this->error);
        }

        $id = $transaction->__insert();
        return 	array(	'success' => true,
                        'transaction' => $transaction,
                        'tablerow' => Dvups_transactionTable::init()->buildindextable()->getSingleRowRest($transaction),
                        'detail' => '');

    }

    public function updateAction($id, $transaction_form = null){
        extract($_POST);

        $transaction = $this->form_fillingentity(new Dvups_transaction($id), $transaction_form);


        if ( $this->error ) {
            return 	array(	'success' => false,
                            'transaction' => $transaction,
                            'action_form' => 'update&id='.$id,
                            'error' => $this->error);
        }

        $transaction->__update();
        return 	array(	'success' => true,
                        'transaction' => $transaction,
                        'tablerow' => Dvups_transactionTable::init()->buildindextable()->getSingleRowRest($transaction),
                        'detail' => '');

    }


    public function detailView($id)
    {

        $this->entitytarget = 'Devups_transaction';
        $this->title = "Detail Transaction";

        $transaction = Dvups_transaction::find($id);

        $this->renderDetailView(
            Dvups_transactionTable::init()
                ->builddetailtable()
                ->renderentitydata($transaction)
        );

    }

    public function deleteAction($id){

            Dvups_transaction::delete($id);
        return 	array(	'success' => true,
                        'detail' => '');
    }


    public function deletegroupAction($ids)
    {

        Dvups_transaction::delete()->where("id")->in($ids)->exec();

        return array('success' => true,
                'detail' => '');

    }
    public function paiement(){
        $trans = new Dvups_transaction();
        $trans->setMontant(Request::post('montant'));
        $trans->setHeure(Request::post('heure'));
        $trans->setDvups_agregateur(Dvups_agregateur::select()->where('nom',Request::post('agregateur'))->__getOne());
        $trans->__insert();
        Response::set('agregateur',Request::post('agregateur'));
        Response::set('montant',Request::post('montant'));
        Response::set('heure',Request::post('heure'));
        return Response::$data;

    }

    public function listeTransaction(){
        return[
            'success'=>true,
            'transaction' =>Dvups_transaction::select()->__getAll()
        ];
    }

}
