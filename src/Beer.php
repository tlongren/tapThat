<?php

    class Beer
    {
        private $id;
        private $name;
        private $type;
        private $abv;
        private $ibu;
        private $region;
        private $brewery_id;

        function __construct($id = null, $name, $type, $abv, $ibu, $region, $brewery_id)
        {
            $this->id = $id;
            $this->name = $name;
            $this->type = $type;
            $this->abv = $abv;
            $this->ibu = $ibu;
            $this->region = $region;
            $this->brewery_id = $brewery_id;
        }

        function getId()
        {
            return $this->id;
        }
        function getName()
        {
            return $this->name;
        }
        function getType()
        {
            return $this->type;
        }
        function getAbv()
        {
            return $this->abv;
        }
        function getIbu()
        {
            return $this->ibu;
        }
        function getRegion()
        {
            return $this->region;
        }
        function getBreweryId()
        {
            return $this->brewery_id;
        }

        function setName($new_name)
        {
            $this->name = $new_name;
        }
        function setType($new_type)
        {
            $this->type = $new_type;
        }
        function setAbv($new_abv)
        {
            $this->abv = $new_abv;
        }
        function setIbu($new_ibu)
        {
            $this->ibu = $new_ibu;
        }
        function setRegion($new_region)
        {
            $this->region = $new_region;
        }
        function setBreweryId($new_brewery_id)
        {
            $this->brewery_id = $new_brewery_id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO beers (name, type, abv, region, ibu, brewery_id) VALUES (
                '{$this->getName()}',
                '{$this->getType()}',
                {$this->getAbv()},
                '{$this->getRegion()}',
                {$this->getIbu()},
                {$this->getBreweryId()});");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        function update($field, $new_value)
        {
            if (is_string($new_value)) {
                $GLOBALS['DB']->exec("UPDATE beers SET {$field} = '{$new_value}' WHERE id = {$this->getId()};");
            } else {
                $GLOBALS['DB']->exec("UPDATE beers SET {$field} = {$new_value} WHERE id = {$this->getId()};");
            }
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM beers WHERE id = {$this->getId()};");
        }

        static function getAll()
        {
            $returned_beers = $GLOBALS['DB']->query("SELECT * FROM beers ORDER BY name ASC;");
            $beers = array();
            foreach ($returned_beers as $beer) {
                $id = $beer['id'];
                $name = $beer['name'];
                $type = $beer['type'];
                $abv = $beer['abv'];
                $ibu = $beer['ibu'];
                $region = $beer['region'];
                $brewery_id = $beer['brewery_id'];
                $new_beer = new Beer($id, $name, $type, $abv, $ibu, $region, $brewery_id);
                array_push($beers, $new_beer);
            }
            return $beers;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM beers;");
        }

        static function find($search_id)
        {
            $found_beer = null;
            $beers = Beer::getAll();
            foreach ($beers as $beer) {
                $beer_id = $beer->getId();
                if ($beer_id == $search_id) {
                    $found_beer = $beer;
                }
            }
            return $found_beer;
        }

        static function findByName($beer_name)
        {
            $found_beer = null;
            $beers = Beer::getAll();
            foreach ($beers as $beer) {
                if ($beer->getName() == $beer_name) {
                    $found_beer = $beer;
                }
            }
            return $found_beer;
        }

        //Inter-class methods
        function getPubs()
        {
            $query = $GLOBALS['DB']->query(
                "SELECT pubs.* FROM
                    beers JOIN on_tap ON (beers.id = on_tap.beer_id)
                    JOIN pubs ON (on_tap.pub_id = pubs.id)
                    WHERE beers.id = {$this->getId()};
                ");
            $pubs = array();
            foreach ($query as $pub) {
                $name = $pub['name'];
                $location = $pub['location'];
                $link = $pub['link'];
                $id = $pub['id'];
                $new_pub = new Pub($name, $location, $link, $id);
                array_push($pubs, $new_pub);
            }
            return $pubs;
        }

        function getRating()
        {
            $statement = $GLOBALS['DB']->query("SELECT AVG(beer_rating) AS average FROM brews WHERE beer_id = {$this->getId()};");
            $average = $statement->fetchColumn();
            return $average;
        }
    }
?>
