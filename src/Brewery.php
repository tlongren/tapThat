<?php
    class Brewery
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
            $GLOBALS['DB']->exec("INSERT INTO breweries (name, location, link) VALUES ('{$this->getName()}', '{$this->getLocation()}', '{$this->getLink()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        function update($column_to_update, $new_info)
        {
            $GLOBALS['DB']->exec("UPDATE breweries SET {$column_to_update} = '{$new_info}' WHERE id = {$this->getId()};");
        }

        function delete()
        {

        }
        //Class integration methods?

        //static methods
        static function getAll()
        {
            $breweries_query = $GLOBALS['DB']->query("SELECT * FROM breweries;");
            $all_breweries = array();
            foreach ($breweries_query as $brewery) {
                $name = $brewery['name'];
                $location = $brewery['location'];
                $link = $brewery['link'];
                $id = $brewery['id'];
                $new_brewery = new Brewery($name, $location, $link, $id);
                array_push($all_breweries, $new_brewery);
            }
            return $all_breweries;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM breweries;");
        }

        static function find($search_id)
        {
            $found_brewery = null;
            $all_breweries = Brewery::getAll();
            foreach ($all_breweries as $brewery) {
                if ($brewery->getId() == $search_id) {
                    $found_brewery = $brewery;
                }
            }
            return $found_brewery;
        }
    }

 ?>
