<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Pub.php";

    $server = "mysql:host=localhost;dbname=tap_that_test";
    $username = "root";
    $password = "root";
    $DB = new PDO($server, $username, $password);

    class PubTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            //Pub::deleteAll();
        }

        function test_getName()
        {
            //Arrange
            $name = "Paddys";
            $location = "462 Over There Way";
            $link = "www.paddyspub.com";
            $test_pub = new Pub($name, $location, $link);

            //Act
            $result = $test_pub->getName();

            //Assert
            $this->assertEquals($name, $result);
        }

        function test_setName()
        {
            //Arrange
            $name = "Paddys";
            $location = "462 Over There Way";
            $link = "www.paddyspub.com";
            $test_pub = new Pub($name, $location, $link);

            $new_name = "The Bar";

            //Act
            $test_pub->setName($new_name);
            $result = $test_pub->getName();

            //Assert
            $this->assertEquals($new_name, $result);
        }
    }

?>
