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


        function test_getLocation()
        {
            //Arrange
            $name = "Paddys";
            $location = "462 Over There Way";
            $link = "www.paddyspub.com";
            $test_pub = new Pub($name, $location, $link);

            //Act
            $result = $test_pub->getLocation();

            //Assert
            $this->assertEquals($location, $result);
        }

        function test_setLocation()
        {
            //Arrange
            $name = "Paddys";
            $location = "462 Over There Way";
            $link = "www.paddyspub.com";
            $test_pub = new Pub($name, $location, $link);

            $new_location = "234 Get There Place";

            //Act
            $test_pub->setLocation($new_location);
            $result = $test_pub->getLocation();

            //Assert
            $this->assertEquals($new_location, $result);
        }


        function test_getLink()
        {
            //Arrange
            $name = "Paddys";
            $location = "462 Over There Way";
            $link = "www.paddyspub.com";
            $test_pub = new Pub($name, $location, $link);

            //Act
            $result = $test_pub->getLink();

            //Assert
            $this->assertEquals($link, $result);
        }

        function test_setLink()
        {
            //Arrange
            $name = "Paddys";
            $location = "462 Over There Way";
            $link = "www.paddyspub.com";
            $test_pub = new Pub($name, $location, $link);

            $new_link = "www.thebar.com";

            //Act
            $test_pub->setLink($new_link);
            $result = $test_pub->getLink();

            //Assert
            $this->assertEquals($new_link, $result);
        }

        function test_getId()
        {
            //Arrange
            $name = "Paddys";
            $location = "462 Over There Way";
            $link = "www.paddyspub.com";
            $id = 1;
            $test_pub = new Pub($name, $location, $link, $id);

            //Act
            $result = $test_pub->getId();

            //Assert
            $this->assertEquals($id, $result);
        }
    }

?>
