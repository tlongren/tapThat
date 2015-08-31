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

        }

        static function getAll()
        {

        }
        static function deleteAll()
        {
            
        }
    }

?>
