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
    }

 ?>
