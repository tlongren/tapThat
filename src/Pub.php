<?php
    class Pub
    {
        private $name;
        private $location;
        private $link;
        private $id;

        function __construct($name, $location, $link, $id = null)
        {
            $this->name = $name;
            $this->location = $location;
            $this->link = $link;
            $this->id = $id;
        }

        //getters and setters
        function getName()
        {
            return $this->name;
        }

        function setName($new_name)
        {
            $this->name = (string) $new_name;
        }

        function getLocation()
        {
            return $this->location;
        }

        function setLocation($new_location)
        {
            $this->location = (string) $new_location;
        }

        function getLink()
        {
            return $this->link;
        }

        function setLink($new_link)
        {
            $this->link = (string) $new_link;
        }

        function getId()
        {
            return $this->id;
        }

        //database methods
        function save()
        {

        }

        function update()
        {

        }

        function delete()
        {

        }

        //class interaction methods (on tap, beers_drunks)


        //static methods
        static function getAll()
        {

        }

        static function deleteAll()
        {

        }

        static function find()
        {

        }

    }

?>
