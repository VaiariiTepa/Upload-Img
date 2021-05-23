<?php 
    require __DIR__ . '/../connexion/connexiondb.php';
    include 'classDescription.php';

    /**
     * Manage **Img** objects
     * @extends Description
     * @property string $img_name
     */
    class Image extends Description
    {
        
        public $img_name;
        
        /**
         * create img into 'img' table
         *
         * 
         */
        public function createImg(){
    
            global $conn;
            $p_description = $this->getDescription();

            $req_res = "INSERT INTO `img` (`name`, `description`) VALUES ('".$this->img_name."','".$p_description."')";
            $conn->query($req_res);

        }

        public function getImg(){
            global $conn;

            $requ_select = "SELECT * from `img`";
            $res_select = $conn->query($requ_select);
            
            return $res_select;
        }
        
    }


    