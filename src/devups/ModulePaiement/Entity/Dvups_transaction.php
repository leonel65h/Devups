<?php 
    /**
     * @Entity @Table(name="dvups_transaction")
     * */
    class Dvups_transaction extends \Model implements JsonSerializable{

        /**
         * @Id @GeneratedValue @Column(type="integer")
         * @var int
         * */
        protected $id;
        /**
         * @Column(name="heure", type="datetime"  )
         * @var datetime
         **/
        private $heure;
        /**
         * @Column(name="montant", type="float"  )
         * @var float
         **/
        private $montant; 
        
        /**
         * @ManyToOne(targetEntity="\Dvups_agregateur")
         * , inversedBy="reporter"
         * @var \Dvups_agregateur
         */
        public $Dvups_agregateur;


        
        public function __construct($id = null){
            
                if( $id ) { $this->id = $id; }   
                          
	$this->Dvups_agregateur = new Dvups_agregateur();
}

        public function getId() {
            return $this->id;
        }
        public function getHeure() {
            return $this->heure;
        }

        public function setHeure($heure) {
            $this->heure = $heure;
        }
        
        public function getMontant() {
            return $this->montant;
        }

        public function setMontant($montant) {
            $this->montant = $montant;
        }
        
        
        /**
         *  manyToOne
         *	@return \Dvups_agregateur
         */
        function getDvups_agregateur() {
            //$this->Dvups_agregateur = $this->__belongto("Dvups_agregateur");
            return $this->Dvups_agregateur;
        }
        
        function setDvups_agregateur(\Dvups_agregateur $Dvups_agregateur) {
            $this->Dvups_agregateur = $Dvups_agregateur;
        }
                        
        
        public function jsonSerialize() {
                return [
                        'id' => $this->id,
                                'heure' => $this->heure,
                                'montant' => $this->montant,
                                'Dvups_agregateur' => $this->Dvups_agregateur,
                ];
        }
        
}
