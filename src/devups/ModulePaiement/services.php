<?php
            //ModulePaiement
		
        require '../../../admin/header.php';
        
// verification token
//

        use Genesis as g;
        use Request as R;
        
        header("Access-Control-Allow-Origin: *");
                

		$transactionCtrl = new Dvups_transactionController();
		$agregateurCtrl = new Dvups_agregateurController();
		
     (new Request('hello'));

     switch (R::get('path')) {
                
        case 'transaction._new':
                Dvups_transactionForm::render();
                break;
        case 'transaction.create':
                g::json_encode($transactionCtrl->createAction());
                break;
        case 'transaction._edit':
                Dvups_transactionForm::render(R::get("id"));
                break;
        case 'transaction.update':
                g::json_encode($transactionCtrl->updateAction(R::get("id")));
                break;
        case 'transaction._show':
                $transactionCtrl->detailView(R::get("id"));
                break;
        case 'transaction._delete':
                g::json_encode($transactionCtrl->deleteAction(R::get("id")));
                break;
        case 'transaction._deletegroup':
                g::json_encode($transactionCtrl->deletegroupAction(R::get("ids")));
                break;
        case 'transaction.datatable':
                g::json_encode($transactionCtrl->datatable(R::get('next'), R::get('per_page')));
                break;
	
        default:
            g::json_encode(['success' => false, 'error' => ['message' => "404 : action note found", 'route' => R::get('path')]]);
            break;
     }

