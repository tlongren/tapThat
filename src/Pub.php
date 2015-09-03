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

        function update($column_to_update, $new_info)
        {
            $GLOBALS['DB']->exec("UPDATE pubs SET {$column_to_update} = '{$new_info}' WHERE id = {$this->getId()};");
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM pubs WHERE id = {$this->getId()};");
            $GLOBALS['DB']->exec("DELETE FROM on_tap WHERE id = {$this->getId()};");
        }

        //class interaction methods
        function addBeer($new_beer)
        {
            $GLOBALS['DB']->exec("INSERT INTO on_tap (pub_id, beer_id) VALUES (
                {$this->getId()},
                {$new_beer->getId()}
            );");
        }

        function deleteBeer($beer)
        {
            $GLOBALS['DB']->exec("DELETE FROM on_tap WHERE pub_id = {$this->getId()} AND beer_id = {$beer->getId()};");
        }

        function getBeers()
        {
            $beers_query = $GLOBALS['DB']->query(
                "SELECT beers.* FROM
                    pubs JOIN on_tap ON (on_tap.pub_id = pubs.id)
                         JOIN beers  ON (on_tap.beer_id = beers.id)
                WHERE pubs.id = {$this->getId()};
                ");

            $matching_beers = array();
            foreach ($beers_query as $beer) {
                $id = $beer['id'];
                $name = $beer['name'];
                $type = $beer['type'];
                $abv = $beer['abv'];
                $ibu = $beer['ibu'];
                $region = $beer['region'];
                $brewery_id = $beer['brewery_id'];
                $new_beer = new Beer($id, $name, $type, $abv, $ibu, $region, $brewery_id);
                array_push ($matching_beers, $new_beer);
            }
            return $matching_beers;
        }

        function deleteAllBeers()
        {
            $GLOBALS['DB']->exec("DELETE FROM on_tap WHERE pub_id = {$this->getId()};");
        }

        //static methods
        static function getAll()
        {
            $pubs_query = $GLOBALS['DB']->query("SELECT * FROM pubs ORDER BY name ASC;");
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
            $GLOBALS['DB']->exec("DELETE FROM on_tap;");
        }

        static function find($search_id)
        {
            $found_pub = null;
            $all_pubs = Pub::getAll();
            foreach ($all_pubs as $pub) {
                if ($pub->getId() == $search_id) {
                    $found_pub = $pub;
                }
            }
            return $found_pub;
        }

    }

?>
