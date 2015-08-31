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

        }

        function setName($new_name)
        {

        }

        function getLocation()
        {

        }

        function setLocation($new_location)
        {

        }

        function getLink()
        {

        }

        function setLink($new_link)
        {

        }

        function getId()
        {

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
