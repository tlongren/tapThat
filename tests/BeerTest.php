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
            $name2 = "Hip Hops";
            $type2 = "Pale Ale";
            $abv2 = 3.2;
            $ibu2 = 4;
            $region2 = "South Central LA";
            $brewery_id2 = 2;
            $test_beer2 = new Beer($id, $name2, $type2, $abv2, $ibu2, $region2, $brewery_id2);
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

        function testFind()
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
            $result = Beer::find($test_beer->getId());

            //Assert
            $this->assertEquals($test_beer, $result);
        }

        function testUpdate()
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

            $new_name = "Hip Hops";
            $new_type = "Pale Ale";
            $new_abv = 3.2;
            $new_ibu = 4;
            $new_region = "South Central LA";
            $new_brewery_id = 2;

            //Act
            $test_beer->update("name", $new_name);
            $test_beer->update("type", $new_type);
            $test_beer->update("abv", $new_abv);
            $test_beer->update("ibu", $new_ibu);
            $test_beer->update("region", $new_region);
            $test_beer->update("brewery_id", $new_brewery_id);

            //Assert
            $all_beers = Beer::getAll();
            $result = new Beer($test_beer->getId(), $new_name, $new_type, $new_abv, $new_ibu, $new_region, $new_brewery_id);
            $test_beer = $all_beers[0];
            $this->assertEquals($test_beer, $result);
        }



    }

?>
