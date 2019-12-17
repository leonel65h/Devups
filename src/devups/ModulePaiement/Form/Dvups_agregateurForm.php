<?php 

        
use Genesis as g;

    class Dvups_agregateurForm extends FormManager{

        public static function formBuilder($dataform, $button = false) {
            $agregateur = new \Dvups_agregateur();
            extract($dataform);
            $entitycore = new Core($agregateur);
            
            $entitycore->formaction = $action;
            $entitycore->formbutton = $button;
            
            //$entitycore->addcss('csspath');
                
            
            $entitycore->field['nom'] = [
                "label" => 'Nom', 
"type" => FORMTYPE_TEXT,
                "value" => $agregateur->getNom(), 
            ];

            $entitycore->field['reference'] = [
                "label" => 'Reference', 
"type" => FORMTYPE_TEXT,
                "value" => $agregateur->getReference(), 
            ];

            
            $entitycore->addDformjs($action);
            $entitycore->addjs(Dvups_agregateur::classpath('Ressource/js/agregateurForm'));
            
            return $entitycore;
        }
        
        public static function __renderForm($dataform, $button = false) {
            return FormFactory::__renderForm(Dvups_agregateurForm::formBuilder($dataform,  $button));
        }
        
        public static function getFormData($id = null, $action = "create")
        {
            if (!$id):
                $agregateur = new Dvups_agregateur();
                
                return [
                    'success' => true,
                    'agregateur' => $agregateur,
                    'action' => "create",
                ];
            endif;
            
            $agregateur = Dvups_agregateur::find($id);
            return [
                'success' => true,
                'agregateur' => $agregateur,
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
            Genesis::renderView("agregateur.formWidget", self::getFormData($id, $action));
        }
        
    }
    