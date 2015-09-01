<?php

    class Brew
    {
        private beer_id;
        private drunk_id;
        private pub_id;
        private beer_rating;
        private date;
        private id;

        function __construct($beer_id, $drunk_id, $pub_id, $beer_rating, $date, $id = null)
        {
            $this->beer_id = $beer_id;
            $this->drunk_id = $drunk_id;
            $this->pub_id = $pub_id;
            $this->beer_rating = $beer_rating;
            $this->date = $date;
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

        function getDate()
        {
            return $this->date;
        }

        function setDate($new_date)
        {
            $this->date = $new_date;
        }

        function getId()
        {
            return $this->id;
        }


    }


 ?>
