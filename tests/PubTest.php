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
            Pub::deleteAll();
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

        //save test
        function test_save()
        {
            //Arrange
            $name = "Paddys";
            $location = "462 Over There Way";
            $link = "www.paddyspub.com";
            $test_pub = new Pub($name, $location, $link);

            //Act
            $test_pub->save();

            //Assert
            $result = Pub::getAll();
            $this->assertEquals($test_pub, $result[0]);
        }

        //get all test
        function test_getAll()
        {
            //Arrange
            $name = "Paddys";
            $location = "462 Over There Way";
            $link = "www.paddyspub.com";
            $test_pub = new Pub($name, $location, $link);
            $test_pub->save();

            $name2 = "Moon & Raven";
            $location2 = "42 Williams St.";
            $link2 = "www.moonraven.com";
            $test_pub2 = new Pub($name, $location, $link);
            $test_pub2->save();

            //Act
            $result = Pub::getAll();

            //Assert
            $this->assertEquals([$test_pub, $test_pub2], $result);
        }

        //delete all test
        function test_deleteAll()
        {
            //Arrange
            $name = "Paddys";
            $location = "462 Over There Way";
            $link = "www.paddyspub.com";
            $test_pub = new Pub($name, $location, $link);
            $test_pub->save();

            $name2 = "Moon & Raven";
            $location2 = "42 Williams St.";
            $link2 = "www.moonraven.com";
            $test_pub2 = new Pub($name, $location, $link);
            $test_pub2->save();

            //Act
            Pub::deleteAll();

            //Assert
            $result = Pub::getAll();
            $this->assertEquals([], $result);
        }

        //find test
        function test_find()
        {
            //Arrange
            $name = "Paddys";
            $location = "462 Over There Way";
            $link = "www.paddyspub.com";
            $test_pub = new Pub($name, $location, $link);
            $test_pub->save();

            $name2 = "Moon & Raven";
            $location2 = "42 Williams St.";
            $link2 = "www.moonraven.com";
            $test_pub2 = new Pub($name, $location, $link);
            $test_pub2->save();

            //Act
            $result = Pub::find($test_pub2->getId());

            //Assert
            $this->assertEquals($test_pub2, $result);
        }

        function test_update()
        {
            //Arrange
            $name = "Paddys";
            $location = "462 Over There Way";
            $link = "www.paddyspub.com";
            $test_pub = new Pub($name, $location, $link);
            $test_pub->save();

            $column_to_update = "name";
            $new_info = "Peggy Suze Booze";

            //Act
            $test_pub->update($column_to_update, $new_info);

            //Assert
            $result = Pub::getAll();
            $this->assertEquals($new_info, $result[0]->getName());

        }

        function test_delete()
        {
            //Arrange
            $name = "Paddys";
            $location = "462 Over There Way";
            $link = "www.paddyspub.com";
            $test_pub = new Pub($name, $location, $link);
            $test_pub->save();

            $name2 = "Moon & Raven";
            $location2 = "42 Williams St.";
            $link2 = "www.moonraven.com";
            $test_pub2 = new Pub($name, $location, $link);
            $test_pub2->save();

            //Act
            $test_pub->delete();

            //Assert
            $result = Pub::getAll();
            $this->assertEquals([$test_pub2], $result);
        }
    }

?>
