<?php

    /**
    * @backupGlobals disabled
    * @backupStatic Attributes disabled
    */

    require_once 'src/Beer.php';

    $server = 'mysql:host=localhost;dbname=tap_that_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class BeerTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Beer::deleteAll();
        }

        function testSave()
        {
            //Arrange
            $id = null;
            $name = "Lip Blaster";
            $type = "IPA";
            $abv = 4.2;
            $ibu = 10;
            $region = "Pacific Northwest";
            $brewery_id = 1;
            $test_beer = new Beer($id, $name, $type, $abv, $ibu, $region, $brewery_id);

            //Act
            $test_beer->save();

            //Assert
            $result = Beer::getAll();
            $this->assertEquals([$test_beer], $result);

        }

        function testGetAll()
        {
            //Arrange
            $id = null;
            $name = "Lip Blaster";
            $type = "IPA";
            $abv = 4.2;
            $ibu = 10;
            $region = "Pacific Northwest";
            $brewery_id = 1;
            $test_beer = new Beer($id, $name, $type, $abv, $ibu, $region, $brewery_id);
            $test_beer->save();

            $id = null;
            $name = "Hip Hops";
            $type = "Pale Ale";
            $abv = 3.2;
            $ibu = 4;
            $region = "South Central LA";
            $brewery_id = 2;
            $test_beer2 = new Beer($id, $name, $type, $abv, $ibu, $region, $brewery_id);
            $test_beer2->save();

            //Act
            $result = Beer::getAll();


            //Assert
            $this->assertEquals([$test_beer, $test_beer2], $result);

        }

        function testDeleteAll()
        {
            //Arrange
            $id = null;
            $name = "Lip Blaster";
            $type = "IPA";
            $abv = 4.2;
            $ibu = 10;
            $region = "Pacific Northwest";
            $brewery_id = 1;
            $test_beer = new Beer($id, $name, $type, $abv, $ibu, $region, $brewery_id);
            $test_beer->save();

            $id = null;
            $name = "Hip Hops";
            $type = "Pale Ale";
            $abv = 3.2;
            $ibu = 4;
            $region = "South Central LA";
            $brewery_id = 2;
            $test_beer2 = new Beer($id, $name, $type, $abv, $ibu, $region, $brewery_id);
            $test_beer2->save();

            //Act
            Beer::deleteAll();

            //Assert
            $result = Beer::getAll();
            $this->assertEquals([], $result);

        }


    }

?>
