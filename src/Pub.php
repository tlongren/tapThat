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
            $GLOBALS['DB']->exec("INSERT INTO pubs (name, location, link) VALUES (
            '{$this->getName()}', '{$this->getLocation()}', '{$this->getLink()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
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
            $pubs_query = $GLOBALS['DB']->query("SELECT * FROM pubs;");
            $all_pubs = array();
            foreach ($pubs_query as $pub) {
                $name = $pub['name'];
                $location = $pub['location'];
                $link = $pub['link'];
                $id = $pub['id'];
                $new_pub = new Pub($name, $location, $link, $id);
                array_push($all_pubs, $new_pub);
            }
            return $all_pubs;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM pubs;");
        }

        static function find()
        {

        }

    }

?>
