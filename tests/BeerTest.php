<?php

    /**
    * @backupGlobals disabled
    * @backupStatic Attributes disabled
    */

    require_once 'src/Beer.php';
    require_once 'src/Pub.php';
    require_once 'src/Brew.php';

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

        function testDeleteBeer()
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
            $test_beer2 = new Beer($id, $name, $type, $abv, $ibu, $region, $brewery_id);
            $test_beer2->save();

            //Act
            $test_beer->delete();

            //Assert
            $result = Beer::getAll();
            $this->assertEquals([$test_beer2], $result);
        }

        function testGetPubs()
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

            $name = "The Outback Steakhouse";
            $location = "300NW Outback Steak Rd";
            $link = "http://www.outback.com/";
            $test_pub = new Pub($name, $location, $link);
            $test_pub->save();

            $test_pub->addBeer($test_beer);

            //Act
            $result = $test_beer->getPubs();

            //Assert
            $this->assertEquals([$test_pub], $result);
        }

        function test_getRating()
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

            $beer_id = $test_beer->getId();
            $drunk_id = 1;
            $pub_id = 1;
            $beer_rating = 2;
            $brew_date = "2015-04-03";
            $new_brew = new Brew($beer_id, $drunk_id, $pub_id, $beer_rating, $brew_date);
            $new_brew->save();

            $beer_id2 = $test_beer->getId();
            $drunk_id2 = 2;
            $pub_id2 = 2;
            $beer_rating2 = 4;
            $brew_date2 = "2015-04-03";
            $new_brew2 = new Brew($beer_id2, $drunk_id2, $pub_id2, $beer_rating2, $brew_date2);
            $new_brew2->save();

            //Act
            $result = $test_beer->getRating();

            //Assert
            $this->assertEquals(3, $result);

        }

        function test_findByName()
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
            $result = Beer::findByName($test_beer->getName());

            //Assert
            $this->assertEquals($test_beer, $result);
        }
    }
?>
