<?php

    class Brew
    {
        private $beer_id;
        private $drunk_id;
        private $pub_id;
        private $beer_rating;
        private $brew_date;
        private $id;

        function __construct($beer_id, $drunk_id, $pub_id, $beer_rating, $brew_date, $id = null)
        {
            $this->beer_id = $beer_id;
            $this->drunk_id = $drunk_id;
            $this->pub_id = $pub_id;
            $this->beer_rating = $beer_rating;
            $this->brew_date = $brew_date;
            $this->id = $id;
        }

        ///Getters and Setters

        function getBeerId()
        {
            return $this->beer_id;
        }

        function setBeerId($new_beer_id)
        {
            $this->beer_id = $new_beer_id;
        }

        function getDrunkId()
        {
            return $this->drunk_id;
        }

        function setDrunkId($new_drunk_id)
        {
            $this->drunk_id = $new_drunk_id;
        }

        function getPubId()
        {
            return $this->pub_id;
        }

        function setPubId($new_pub_id)
        {
            $this->pub_id = $new_pub_id;
        }

        function getBeerRating()
        {
            return $this->beer_rating;
        }

        function setBeerRating($new_beer_rating)
        {
            $this->beer_rating = $new_beer_rating;
        }

        function getBrewDate()
        {
            return $this->brew_date;
        }

        function setBrewDate($new_brew_date)
        {
            $this->date = $new_brew_date;
        }

        function getId()
        {
            return $this->id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO brews (beer_id, drunk_id, pub_id, beer_rating, brew_date) VALUES ({$this->beer_id}, {$this->drunk_id}, {$this->pub_id}, {$this->beer_rating}, '{$this->brew_date}') ");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        function update($column_to_update, $new_info)
        {
            if (is_string($new_info)) {
                $GLOBALS['DB']->exec("UPDATE brews SET {$column_to_update} = '{$new_info}' WHERE id = {$this->id}");
            } else {
                $GLOBALS['DB']->exec("UPDATE brews SET {$column_to_update} = {$new_info} WHERE id = {$this->id}");
            }
        }

        //////////////Static Functions//////////////////

        static function getAll()
        {
            $returned_brews = $GLOBALS['DB']->query("SELECT * FROM brews");
            $brews = array();
            foreach($returned_brews as $brew) {
                $beer_id = $brew['beer_id'];
                $drunk_id = $brew['drunk_id'];
                $pub_id = $brew['pub_id'];
                $beer_rating = $brew['beer_rating'];
                $brew_date = $brew['brew_date'];
                $id = $brew['id'];
                $new_brew = new Brew($beer_id, $drunk_id, $pub_id, $beer_rating, $brew_date, $id);
                array_push($brews, $new_brew);
            }
            return $brews;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM brews");
        }

        static function find($search_id)
        {
            $brews = Brew::getAll();
            $found_brew = null;
            foreach($brews as $brew) {
                $brew_id = $brew->getId();
                if ($brew_id == $search_id) {
                    $found_brew = $brew;
                }
            }
            return $found_brew;
        }


    }


 ?>
