<?php

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
        }
    }

 ?>
