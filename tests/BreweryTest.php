<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Pub.php";
    require_once "src/Beer.php";
    require_once "src/Brewery.php";

    $server = "mysql:host=localhost;dbname=tap_that_test";
    $username = "root";
    $password = "root";
    $DB = new PDO($server, $username, $password);

    class BreweryTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Brewery::deleteAll();
        }

        function test_getName()
        {
            //Arrange
            $name = "Bullfrog Brewery";
            $location = "Somewhere in Williamsport";
            $link = "www.bullfrogbrewing.com";
            $test_brewery = new Brewery ($name, $location, $link);

            //Act
            $result = $test_brewery->getName();

            //Assert
            $this->assertEquals($name, $result);
        }

        function test_save()
        {
            //Arrange
            $name = "Bullfrog Brewery";
            $location = "Somewhere in Williamsport";
            $link = "www.bullfrogbrewing.com";
            $test_brewery = new Brewery ($name, $location, $link);

            //Act
            $test_brewery->save();

            //Assert
            $result = Brewery::getAll();
            $this->assertEquals($test_brewery, $result[0]);
        }

        function test_getAll()
        {
            //Arrange
            $name = "Bullfrog Brewery";
            $location = "Somewhere in Williamsport";
            $link = "www.bullfrogbrewing.com";
            $test_brewery = new Brewery ($name, $location, $link);
            $test_brewery->save();

            $name = "Yards Brewing Co.";
            $location = "Philthadone";
            $link = "www.makebeer.com";
            $test_brewery2 = new Brewery ($name, $location, $link);
            $test_brewery2->save();

            //Act
            $result = Brewery::getAll();

            //Assert
            $this->assertEquals([$test_brewery, $test_brewery2], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $name = "Bullfrog Brewery";
            $location = "Somewhere in Williamsport";
            $link = "www.bullfrogbrewing.com";
            $test_brewery = new Brewery ($name, $location, $link);
            $test_brewery->save();

            $name = "Yards Brewing Co.";
            $location = "Philthadone";
            $link = "www.makebeer.com";
            $test_brewery2 = new Brewery ($name, $location, $link);
            $test_brewery2->save();

            //Act
            Brewery::deleteAll();

            //Assert
            $result = Brewery::getAll();
            $this->assertEquals([], $result);
        }

        function test_find()
        {
            //Arrange
            $name = "Bullfrog Brewery";
            $location = "Somewhere in Williamsport";
            $link = "www.bullfrogbrewing.com";
            $test_brewery = new Brewery ($name, $location, $link);
            $test_brewery->save();

            $name = "Yards Brewing Co.";
            $location = "Philthadone";
            $link = "www.makebeer.com";
            $test_brewery2 = new Brewery ($name, $location, $link);
            $test_brewery2->save();

            //Act
            $result = Brewery::find($test_brewery->getId());

            //Assert
            $this->assertEquals($test_brewery, $result);
        }

        function test_update()
        {
            //Arrange
            $name = "Bullfrog Brewery";
            $location = "Somewhere in Williamsport";
            $link = "www.bullfrogbrewing.com";
            $test_brewery = new Brewery ($name, $location, $link);
            $test_brewery->save();

            $column_to_update = "name";
            $new_info = "Corgi Craft Coolers";

            //Act
            $test_brewery->update($column_to_update, $new_info);

            //Assert
            $result = Brewery::getAll();
            $this->assertEquals($new_info, $result[0]->getName());
        }

        function test_delete()
        {
            //Arrange
            $name = "Bullfrog Brewery";
            $location = "Somewhere in Williamsport";
            $link = "www.bullfrogbrewing.com";
            $test_brewery = new Brewery ($name, $location, $link);
            $test_brewery->save();

            $name = "Yards Brewing Co.";
            $location = "Philthadone";
            $link = "www.makebeer.com";
            $test_brewery2 = new Brewery ($name, $location, $link);
            $test_brewery2->save();

            //Act
            $test_brewery->delete();

            //Assert
            $result = Brewery::getAll();
            $this->assertEquals([$test_brewery2], $result);
        }
    }

 ?>
