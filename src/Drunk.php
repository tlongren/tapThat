<?php
    require_once "Beer.php";
    class Drunk
    {
        private $name;
        private $date_of_birth;
        private $location;
        private $email;
        private $id;


        function __construct($name, $date_of_birth, $location, $email, $id = null)
        {
            $this->name = $name;
            $this->date_of_birth = $date_of_birth;
            $this->location = $location;
            $this->email = $email;
            $this->id = $id;
        }

        ////Getters and Setters

        function getName()
        {
            return $this->name;
        }

        function setName($new_name)
        {
            $this->name = $new_name;
        }

        function getDateOfBirth()
        {
            return $this->date_of_birth;
        }

        function setDateOfBirth($new_date_of_birth)
        {
            $this->date_of_birth = $new_date_of_birth;
        }

        function getLocation()
        {
            return $this->location;
        }

        function setLocation($new_location)
        {
            $this->location = $new_location;
        }

        function getEmail()
        {
            return $this->email;
        }

        function setEmail($new_email)
        {
            $this->email = $new_email;
        }

        function getId()
        {
            return $this->id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO drunks (name, date_of_birth, location, email) VALUES ('{$this->getName()}', '{$this->getDateOfBirth()}', '{$this->getLocation()}', '{$this->getEmail()}')");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        function update($column_to_update, $new_information)
        {
            $GLOBALS['DB']->exec("UPDATE drunks SET {$column_to_update} = '{$new_information}' WHERE id = {$this->getId()}");
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM drunks WHERE id = {$this->getId()}");
            $GLOBALS['DB']->exec("DELETE FROM beers_drunks WHERE drunk_id = {$this->getId()}");
        }

        function addBeer($beer)
        {
            $GLOBALS['DB']->exec("INSERT INTO beers_drunks (beer_id, drunk_id) VALUES ({$beer->getId()}, {$this->getId()})");
        }

        function deleteBeer($beer)
        {
            $GLOBALS['DB']->exec("DELETE FROM beers_drunks WHERE beer_id = {$beer->getId()} AND drunk_id = {$this->getId()}");
        }

        function getBeers()
        {
            $returned_beers = $GLOBALS['DB']->query("SELECT beers.* FROM drunks JOIN beers_drunks ON (drunks.id = beers_drunks.drunk_id) JOIN beers ON (beers.id = beers_drunks.beer_id) WHERE drunk.id = {$this->getId()}");
            $beers = array();
            foreach($returned_beers as $beer) {
                $name = $beer['name'];
                $type = $beer['type'];
                $abv = $beer['abv'];
                $ibu = $beer['ibu'];
                $region = $beer['region'];
                $brewery_id = $beer['brewery_id'];
                $id = $beer['id'];
                $new_beer = new Beer($id, $name, $type, $abv, $ibu, $region, $brewery_id);
                array_push($beers, $new_beer);
            }
            return $beers;
        }

        ////////////Static functions///////////////////

        static function getAll()
        {
            $returned_drunks = $GLOBALS['DB']->query("SELECT * FROM drunks");
            $drunks = array();
            foreach($returned_drunks as $drunk) {
                $name = $drunk['name'];
                $date_of_birth = $drunk['date_of_birth'];
                $location = $drunk['location'];
                $email = $drunk['email'];
                $id = $drunk['id'];
                $new_drunk = new Drunk($name, $date_of_birth, $location, $email, $id);
                array_push($drunks, $new_drunk);
            }
            return $drunks;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM drunks");
            $GLOBALS['DB']->exec("DELETE FROM beers_drunks");
        }

        static function find($search_id)
        {
            $found_drunk = null;
            $returned_drunks = Drunk::getALL();
            foreach($returned_drunks as $drunk) {
                $id = $drunk->getid();
                if($id == $search_id) {
                    $found_drunk = $drunk;
                }
            }
            return $found_drunk;
        }
    }

 ?>
