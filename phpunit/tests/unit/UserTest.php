<?php 
use PHPUnit\Framework\TestCase;

    //class for testing functions of users
    class UserTest extends TestCase
    {
        protected $user;
        protected $house;
        protected $usermessage;
        protected $flat;
        protected $favroom;
        protected $ordland;

       //creating object of class user
        public function setUp(){
        $this->user= new App\Models\User; 
        $this->house= new App\Models\House;
        $this->usermessage= new App\Models\UserMessage;
        $this->flat= new App\Models\Flat;
        $this->favroom= new App\Models\FavouriteRoom;
        $this->ordland= new App\Models\OrderedLand;
        }

        /*function to test user login
        by providing email and password 
        that is stored in database */

        /** @test1 */
        public function testLogin(){
        $this->user->setEmail('bibashkatel4@gmail.com');
        $this->user->setPassword('KaT12345');
        $this->assertTrue($this->user->login(), true);

        $this->user->setEmail('bikash123@gmail.com');
        $this->user->setPassword('12345Bib');
        $this->assertTrue($this->user->login(), true);
        }

        /*function to test that multiple
        user cannot be registred */

        /** @test2 */
        public function testRegister(){
        $this->user->setEmail('Yashim@gmail.com');
        $this->assertNotEquals($this->user->checkRegister(), 'Yashim@gmail.com');
        }

        //checking that house id starts with 'H'
        /** @test3 */
        public function testHouseId(){
            $this->house->setHouseId('H2');
            $this->assertStringStartsWith('H', $this->house->selectHouse());
        }

        //checking that the message is not empty
        /** @test4 */
        public function testUserMessage(){
            $this->usermessage->setUserEmail('suman.katel.7@gmail.com');
            $this->assertNotNull($this->usermessage->checkMessage());
        }

        //test for searching flat
        /** @test5 */
        public function testSearchFlat(){
            //setting search keyword as flat id
            $this->flat->setSearchFlatKeyWord('F1');
            $this->assertNotNull($this->flat->searchFlat());

            //setting search keyword as approximate flat price
            $this->flat->setSearchFlatKeyWord('160');
            $this->assertNotNull($this->flat->searchFlat());

            //setting search keyowrd as approximate flat location 
            $this->flat->setSearchFlatKeyWord('birat');
            $this->assertNotNull($this->flat->searchFlat());
        }


        //test for multiple user can add single room to favourite list
        /** @test 6 */
        public function testFavouriteRoom(){
            $this->favroom->setUserEmail('shikhashrestha740@gmail.com');
            $this->favroom->setRoomId('R1');
            $this->assertTrue($this->favroom->selectFavouriteRoom());

            $this->favroom->setUserEmail('bibashkatel4@gmail.com');
            $this->favroom->setRoomId('R1');
            $this->assertTrue($this->favroom->selectFavouriteRoom());
        }

        //test for multiple user cannot place order for single land
        /** @test 7 */
        public function testOrderedLand(){
       
        $this->ordland->setLandId('L1'); 
        $this->ordland->setUserEmail('bibashkatel4@gmail.com');
        $this->assertFalse($this->ordland->selectOrderedLand());

        $this->ordland->setLandId('L1');
        $this->ordland->setUserEmail('suman.katel.7@gmail.com');
        $this->assertFalse($this->ordland->selectOrderedLand()); 
    }

}

?>