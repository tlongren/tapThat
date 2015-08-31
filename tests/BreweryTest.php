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
    }

 ?>
