<?php

    /**
    * @backupGlobals disabled
    * @backupStatic Attributes disabled
    */

    require_once 'src/Brew.php';
    require_once 'src/Pub.php';
    require_once 'src/Drunk.php';

    $server = 'mysql:host=localhost:8889;dbname=tap_that_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);


    class BrewTest extends PHPUnit_Framework_TestCase
    {
        function teardown()
        {
            Brew::deleteAll();
        }

        function testSave()
        {
            //Arrange
            $beer_id = 1;
            $drunk_id = 1;
            $pub_id = 1;
            $beer_rating = 4.5;
            $brew_date = "2015-04-03";
            $new_brew = new Brew($beer_id, $drunk_id, $pub_id, $beer_rating, $brew_date);

            //Act
            $new_brew->save();
            $result = Brew::getAll();


            //Assert
            $this->assertEquals($new_brew, $result[0]);

        }

        function testGetAll()
        {
            //Arrange
            $beer_id = 1;
            $drunk_id = 1;
            $pub_id = 1;
            $beer_rating = 4.5;
            $brew_date = "2015-04-03";
            $new_brew = new Brew($beer_id, $drunk_id, $pub_id, $beer_rating, $brew_date);
            $new_brew->save();

            $beer_id2 = 2;
            $drunk_id2 = 2;
            $pub_id2 = 2;
            $beer_rating2 = 4.5;
            $brew_date2 = "2015-04-03";
            $new_brew2 = new Brew($beer_id2, $drunk_id2, $pub_id2, $beer_rating2, $brew_date2);
            $new_brew2->save();

            //Act
            $result = Brew::getAll();


            //Assert
            $this->assertEquals([$new_brew, $new_brew2], $result);
        }

        function testDeleteAll()
        {
            //Arrange
            $beer_id = 1;
            $drunk_id = 1;
            $pub_id = 1;
            $beer_rating = 4.5;
            $brew_date = "2015-04-03";
            $new_brew = new Brew($beer_id, $drunk_id, $pub_id, $beer_rating, $brew_date);
            $new_brew->save();

            $beer_id2 = 2;
            $drunk_id2 = 2;
            $pub_id2 = 2;
            $beer_rating2 = 4.5;
            $brew_date2 = "2015-04-03";
            $new_brew2 = new Brew($beer_id2, $drunk_id2, $pub_id2, $beer_rating2, $brew_date2);
            $new_brew2->save;

            //Act
            Brew::deleteAll();
            $result = Brew::getAll();

            //Assert
            $this->assertEquals([], $result);
        }

        function testFind()
        {
            //Arrange
            $beer_id = 1;
            $drunk_id = 1;
            $pub_id = 1;
            $beer_rating = 4.5;
            $brew_date = "2015-04-03";
            $new_brew = new Brew($beer_id, $drunk_id, $pub_id, $beer_rating, $brew_date);
            $new_brew->save();

            $beer_id2 = 2;
            $drunk_id2 = 2;
            $pub_id2 = 2;
            $beer_rating2 = 4.5;
            $brew_date2 = "2015-04-03";
            $new_brew2 = new Brew($beer_id2, $drunk_id2, $pub_id2, $beer_rating2, $brew_date2);
            $new_brew2->save();

            //Act
            $result = Brew::find($new_brew2->getId());


            //Assert
            $this->assertEquals($new_brew2, $result);
        }

        function testUpdate()
        {
            //Arrange
            $beer_id = 1;
            $drunk_id = 1;
            $pub_id = 1;
            $beer_rating = 4.5;
            $brew_date = "2015-04-03";
            $new_brew = new Brew($beer_id, $drunk_id, $pub_id, $beer_rating, $brew_date);
            $new_brew->save();

            //Act
            $new_brew->update('brew_date', '2011-09-01');
            $result = Brew::getAll();


            //Assert
            $this->assertEquals($result[0]->getBrewDate(), "2011-09-01");

        }

    }




 ?>
