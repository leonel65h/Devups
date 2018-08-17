<?php 
    /**
     * @Entity @Table(name="testentity")
     * */
    class Testentity extends \Model implements JsonSerializable{

        /**
         * @Id @GeneratedValue @Column(type="integer")
         * @var int
         * */
        protected $id;
        /**
         * @Column(name="name", type="string" , length=25 )
         * @var string
         **/
        private $name;
        /**
         * @Column(name="additionalfield", type="string" , length=25 )
         * @var string
         **/
        private $additionalfield;
        /**
         * @Column(name="description", type="text"  )
         * @var text
         **/
        private $description; 
        

        
        public function __construct($id = null){
            
                if( $id ) { $this->id = $id; }   
                          
}

        public function getId() {
            return $this->id;
        }
        public function getName() {
            return $this->name;
        }

        public function setName($name) {
            $this->name = $name;
        }
        
        public function getAdditionalfield() {
            return $this->additionalfield;
        }

        public function setAdditionalfield($additionalfield) {
            $this->additionalfield = $additionalfield;
        }
        
        public function getDescription() {
            return $this->description;
        }

        public function setDescription($description) {
            $this->description = $description;
        }
        
        
        public function jsonSerialize() {
                return [
                        'id' => $this->id,
                                'name' => $this->name,
                                'additionalfield' => $this->additionalfield,
                                'description' => $this->description,
                ];
        }
        
}