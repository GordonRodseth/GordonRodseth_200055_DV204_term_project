<?php

    namespace App\Entity;

    class User
    {
        //var
        private $id;
        private $name;
        private $posts;

        public function getId() {return $this->id;}
        public function setId($id) {$this->id = $id;}

        public function getName() {return $this-> name;}
        public function setName($name) {$this->name = $name;}

        public function getPosts()
        {
            if($this->posts ==null){
                $this->posts=array();
            }
            return $this-> posts;
        }

        public function setPosts($post)
        {
            if($this->posts ==null){
                $this->posts=array();
            }
            array_push($this->posts, $post);
        }
    }

?>