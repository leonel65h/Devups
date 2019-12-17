<?php 

        
use Genesis as g;

    class Dvups_transactionForm extends FormManager{

        public static function formBuilder($dataform, $button = false) {
            $transaction = new \Dvups_transaction();
            extract($dataform);
            $entitycore = new Core($transaction);
            
            $entitycore->formaction = $action;
            $entitycore->formbutton = $button;
            
            //$entitycore->addcss('csspath');
                
            
            $entitycore->field['heure'] = [
                "label" => 'Heure', 
"type" => FORMTYPE_TEXT,
                "value" => $transaction->getHeure(), 
            ];

            $entitycore->field['montant'] = [
                "label" => 'Montant', 
"type" => FORMTYPE_TEXT,
                "value" => $transaction->getMontant(), 
            ];

                $entitycore->field['dvups_agregateur'] = [
                    "type" => FORMTYPE_SELECT, 
                    "value" => $transaction->getDevups_agregateur()->getId(),
                    "label" => 'Dvups_agregateur',
                    "options" => FormManager::Options_Helper('nom', Dvups_agregateur::allrows()),
                ];

            
            $entitycore->addDformjs($action);
            $entitycore->addjs(Dvups_transaction::classpath('Ressource/js/transactionForm'));
            
            return $entitycore;
        }
        
        public static function __renderForm($dataform, $button = false) {
            return FormFactory::__renderForm(Dvups_transactionForm::formBuilder($dataform,  $button));
        }
        
        public static function getFormData($id = null, $action = "create")
        {
            if (!$id):
                $transaction = new Dvups_transaction();
                
                return [
                    'success' => true,
                    'transaction' => $transaction,
                    'action' => "create",
                ];
            endif;
            
            $transaction = Dvups_transaction::find($id);
            return [
                'success' => true,
                'transaction' => $transaction,
                'action' => "update&id=" . $id,
            ];

        }
        
        public static function render($id = null, $action = "create")
        {
            g::json_encode(['success' => true,
                'form' => self::__renderForm(self::getFormData($id, $action),true),
            ]);
        }

        public static function renderWidget($id = null, $action = "create")
        {
            Genesis::renderView("transaction.formWidget", self::getFormData($id, $action));
        }
        
    }
