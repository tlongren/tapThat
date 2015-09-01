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
            $GLOBALS['DB']->exec("DELETE FROM breweries WHERE id = {$this->getId()};");
        }

        //Beer class integration methods

        // shouldn't need this, can just call Beer save method
        // function addBeer($new_beer)
        // {
        //     $GLOBALS['DB']->exec("INSERT INTO beers (name, type, abv, region, ibu, brewery_id) VALUES (
        //         '{$new_beer->getName()}',
        //         '{$new_beer->getType()}',
        //         {$new_beer->getAbv()},
        //         '{$new_beer->getRegion()}',
        //         {$new_beer->getIbu()},
        //         {$this->getId()});");
        //         $new_beer->id = $GLOBALS['DB']->lastInsertId();
        // }

        function getBeers()
        {
            $beers_query = $GLOBALS['DB']->query("SELECT * FROM beers WHERE brewery_id = {$this->getId()};");

            $matching_beers = array();
            foreach ($beers_query as $beer) {
                $id = $beer['id'];
                $name = $beer['name'];
                $type = $beer['type'];
                $abv = $beer['abv'];
                $region = $beer['region'];
                $ibu = $beer['ibu'];
                $brewery_id = $beer['brewery_id'];
                $new_beer = new Beer($id, $name, $type, $abv, $ibu, $region, $brewery_id);
                array_push ($matching_beers, $new_beer);
            }
            return $matching_beers;
        }

        function deleteBeer($beer)
        {
            $GLOBALS['DB']->exec("DELETE FROM beers WHERE id = {$beer->getId()} AND brewery_id = {$this->getId()};");
        }

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
