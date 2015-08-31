<?php


    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Drunk.php";
    require_once "src/Beer.php";


    $server = 'mysql:host=localhost:8889;dbname=tap_that_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class DrunkTest extends PHPUnit_Framework_TestCase
    {

        protected function teardown()
        {
            Drunk::deleteAll();
        }

        function testGetName()
        {
            //Arrange
            $name = "Person 1";
            $date_of_birth = "1988-03-04";
            $location = "Portland, OR";
            $email = "email@email.com";
            $id = 1;
            $test_drunk = new Drunk($name, $date_of_birth, $location, $email, $id);

            //Act
            $result = $test_drunk->getName();

            //Assert
            $this->assertEquals($name, $result);
        }

        function testSetName()
        {
            //Arrange
            $name = "Person 1";
            $date_of_birth = "1988-03-04";
            $location = "Portland, OR";
            $email = "email@email.com";
            $id = 1;
            $test_drunk = new Drunk($name, $date_of_birth, $location, $email, $id);

            $new_name = "Person 2";

            //Act
            $test_drunk->setName($new_name);
            $result = $test_drunk->getName();

            //Assert
            $this->assertEquals($new_name, $result);
        }

        function testGetDateOfBirth()
        {
            //Arrange
            $name = "Person 1";
            $date_of_birth = "1988-03-04";
            $location = "Portland, OR";
            $email = "email@email.com";
            $id = 1;
            $test_drunk = new Drunk($name, $date_of_birth, $location, $email, $id);

            //Act
            $result = $test_drunk->getDateOfBirth();

            //Assert
            $this->assertEquals($date_of_birth, $result);
        }

        function testSetDateOfBirth()
        {
            //Arrange
            $name = "Person 1";
            $date_of_birth = "1988-03-04";
            $location = "Portland, OR";
            $email = "email@email.com";
            $id = 1;
            $test_drunk = new Drunk($name, $date_of_birth, $location, $email, $id);

            $new_date_of_birth = "1987-08-09";

            //Act
            $test_drunk->setDateOfBirth($new_date_of_birth);
            $result = $test_drunk->getDateOfBirth();

            //Assert
            $this->assertEquals($new_date_of_birth, $result);
        }

        function testGetLocation()
        {
            //Arrange
            $name = "Person 1";
            $date_of_birth = "1988-03-04";
            $location = "Portland, OR";
            $email = "email@email.com";
            $id = 1;
            $test_drunk = new Drunk($name, $date_of_birth, $location, $email, $id);

            //Act
            $result = $test_drunk->getLocation();

            //Assert
            $this->assertEquals($location, $result);
        }

        function testSetLocation()
        {
            //Arrange
            $name = "Person 1";
            $date_of_birth = "1988-03-04";
            $location = "Portland, OR";
            $email = "email@email.com";
            $id = 1;
            $test_drunk = new Drunk($name, $date_of_birth, $location, $email, $id);

            $new_location = "Chapel HIll, NC";

            //Act
            $test_drunk->setLocation($new_location);
            $result = $test_drunk->getLocation();

            //Assert
            $this->assertEquals($new_location, $result);
        }

        function testGetEmail()
        {
            //Arrange
            $name = "Person 1";
            $date_of_birth = "1988-03-04";
            $location = "Portland, OR";
            $email = "email@email.com";
            $id = 1;
            $test_drunk = new Drunk($name, $date_of_birth, $location, $email, $id);

            //Act
            $result = $test_drunk->getEmail();

            //Assert
            $this->assertEquals($email, $result);
        }

        function testSetEmail()
        {
            //Arrange
            $name = "Person 1";
            $date_of_birth = "1988-03-04";
            $location = "Portland, OR";
            $email = "email@email.com";
            $id = 1;
            $test_drunk = new Drunk($name, $date_of_birth, $location, $email, $id);

            $new_email = "this@this.com";

            //Act
            $test_drunk->setEmail($new_email);
            $result = $test_drunk->getEmail();

            //Assert
            $this->assertEquals($new_email, $result);
        }

        function testGetId()
        {
            //Arrange
            $name = "Person 1";
            $date_of_birth = "1988-03-04";
            $location = "Portland, OR";
            $email = "email@email.com";
            $id = 1;
            $test_drunk = new Drunk($name, $date_of_birth, $location, $email, $id);

            //Act
            $result = $test_drunk->getId();

            //Assert
            $this->assertEquals($id, $result);
        }

        function testSave()
        {
            //Arrange
            $name = "Person 1";
            $date_of_birth = "1988-03-04";
            $location = "Portland, OR";
            $email = "email@email.com";
            $id = 1;
            $test_drunk = new Drunk($name, $date_of_birth, $location, $email, $id);

            //Act
            $test_drunk->save();
            $result = Drunk::getAll();


            //Assert
            $this->assertEquals($test_drunk, $result[0]);
        }

        function testGetAll()
        {
            //Arrange
            $name = "Person 1";
            $date_of_birth = "1988-03-04";
            $location = "Portland, OR";
            $email = "email@email.com";
            $id = 1;
            $test_drunk = new Drunk($name, $date_of_birth, $location, $email, $id);
            $test_drunk->save();

            $name2 = "Person 1";
            $date_of_birth2 = "1988-03-04";
            $location2 = "Portland, OR";
            $email2 = "email@email.com";
            $id2 = 1;
            $test_drunk2 = new Drunk($name2, $date_of_birth2, $location2, $email2, $id2);
            $test_drunk2->save();

            //Act
            $result = Drunk::getAll();

            //Assert
            $this->assertEquals([$test_drunk, $test_drunk2], $result);
        }

        function testDeleteAll()
        {
            //Arrange
            $name = "Person 1";
            $date_of_birth = "1988-03-04";
            $location = "Portland, OR";
            $email = "email@email.com";
            $id = 1;
            $test_drunk = new Drunk($name, $date_of_birth, $location, $email, $id);
            $test_drunk->save();

            $name2 = "Person 1";
            $date_of_birth2 = "1988-03-04";
            $location2 = "Portland, OR";
            $email2 = "email@email.com";
            $id2 = 1;
            $test_drunk2 = new Drunk($name2, $date_of_birth2, $location2, $email2, $id2);
            $test_drunk2->save();

            //Act
            Drunk::deleteAll();
            $result = Drunk::getAll();

            //Assert
            $this->assertEquals([], $result);
        }

        function testUpdate()
        {
            //Arrange
            $name = "Person 1";
            $date_of_birth = "1988-03-04";
            $location = "Portland, OR";
            $email = "email@email.com";
            $id = 1;
            $test_drunk = new Drunk($name, $date_of_birth, $location, $email, $id);
            $test_drunk->save();

            $new_name = "Person 2";

            //Act
            $test_drunk->update("name", $new_name);
            $result = Drunk::getALL();


            //Assert
            $this->assertEquals($new_name, $result[0]->getName());
        }

        function testFind()
        {
            //Arrange
            $name = "Person 1";
            $date_of_birth = "1988-03-04";
            $location = "Portland, OR";
            $email = "email@email.com";
            $test_drunk = new Drunk($name, $date_of_birth, $location, $email, $id);
            $test_drunk->save();

            $name2 = "Person 1";
            $date_of_birth2 = "1988-03-04";
            $location2 = "Portland, OR";
            $email2 = "email@email.com";
            $test_drunk2 = new Drunk($name2, $date_of_birth2, $location2, $email2, $id2);
            $test_drunk2->save();

            //Act
            $result = Drunk::find($test_drunk2->getId());

            //Assert

            $this->assertEquals($test_drunk2, $result);
        }

        function testdelete()
        {
            //Arrange
            $name = "Person 1";
            $date_of_birth = "1988-03-04";
            $location = "Portland, OR";
            $email = "email@email.com";
            $test_drunk = new Drunk($name, $date_of_birth, $location, $email, $id);
            $test_drunk->save();

            $name2 = "Person 1";
            $date_of_birth2 = "1988-03-04";
            $location2 = "Portland, OR";
            $email2 = "email@email.com";
            $test_drunk2 = new Drunk($name2, $date_of_birth2, $location2, $email2, $id2);
            $test_drunk2->save();

            //Act
            $test_drunk->delete();
            $result = Drunk::getALL();

            //Assert

            $this->assertEquals([$test_drunk2], $result);
        }

        function testAddBeer()
        {
            //Arrange
            $name = "Person 1";
            $date_of_birth = "1988-03-04";
            $location = "Portland, OR";
            $email = "email@email.com";
            $id = 1;
            $test_drunk = new Drunk($name, $date_of_birth, $location, $email, $id);
            $test_drunk->save();

            $id2 = null;
            $name2 = "Lip Blaster";
            $type = "IPA";
            $abv = 4.2;
            $ibu = 10;
            $region = "Pacific Northwest";
            $brewery_id = 1;
            $test_beer = new Beer($id2, $name2, $type, $abv, $ibu, $region, $brewery_id);
            $test_beer->save();
            

            //Act
            $test_drunk->addBeer($test_beer);
            $result = $test_drunk->getBeers();

            //Assert
            $this->assertEquals([$test_beer], $result[0]);
        }

        function testDeleteBeer()
        {
            //Arrange
            $name = "Person 1";
            $date_of_birth = "1988-03-04";
            $location = "Portland, OR";
            $email = "email@email.com";
            $id = 1;
            $test_drunk = new Drunk($name, $date_of_birth, $location, $email, $id);
            $test_drunk->save();

            $id2 = null;
            $name2 = "Lip Blaster";
            $type = "IPA";
            $abv = 4.2;
            $ibu = 10;
            $region = "Pacific Northwest";
            $brewery_id = 1;
            $test_beer = new Beer($id2, $name2, $type, $abv, $ibu, $region, $brewery_id);
            $test_beer->save();

            $id3 = null;
            $name3 = "Lip Blaster";
            $type3 = "IPA";
            $abv3 = 4.2;
            $ibu3 = 10;
            $region3 = "Pacific Northwest";
            $brewery_id3 = 1;
            $test_beer2 = new Beer($id3, $name3, $type3, $abv3, $ibu3, $region3, $brewery_id3);

            //Act
            $test_drunk->addBeer($test_beer);
            $test_drunk->addBeer($test_beer2);
            $test_drunk->deleteBeer($test_beer);


            //Assert
            $result = $test_drunk->getBeers();
            $this->assertEquals([$test_beer2], $result);
        }

        function testDeleteAllBeers()
        {
            //Arrange
            $name = "Person 1";
            $date_of_birth = "1988-03-04";
            $location = "Portland, OR";
            $email = "email@email.com";
            $id = 1;
            $test_drunk = new Drunk($name, $date_of_birth, $location, $email, $id);
            $test_drunk->save();

            $id2 = null;
            $name2 = "Lip Blaster";
            $type = "IPA";
            $abv = 4.2;
            $ibu = 10;
            $region = "Pacific Northwest";
            $brewery_id = 1;
            $test_beer = new Beer($id2, $name2, $type, $abv, $ibu, $region, $brewery_id);
            $test_beer->save();

            $id3 = null;
            $name3 = "Lip Blaster";
            $type3 = "IPA";
            $abv3 = 4.2;
            $ibu3 = 10;
            $region3 = "Pacific Northwest";
            $brewery_id3 = 1;
            $test_beer2 = new Beer($id3, $name3, $type3, $abv3, $ibu3, $region3, $brewery_id3);

            //Act
            $test_drunk->addBeer($test_beer);
            $test_drunk->addBeer($test_beer2);
            $test_drunk->deleteAllBeers();


            //Assert
            $result = $test_drunk->getBeers();
            $this->assertEquals([], $result);
        }

    }

 ?>
