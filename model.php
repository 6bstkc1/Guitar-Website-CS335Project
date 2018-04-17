<?php
    class DatabaseAdapter
    {
        private $DB; // Instance variable
        
        /*
         *  Constructor 
         *  DB name, guitar_site
         */
        public function __construct()
        {
            $db = 'mysql:dbname=guitar_site; host=127.0.0.1; charset=utf8';
            $user = 'root';
            $pass = '';
            try 
            {
                $this->DB = new PDO( $db, $user, $pass);
                $this->DB->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
            } 
            catch (PDOException $e)
            {
                echo "Connection to guitar_site failed!";
                exit();
            }
        }
    
        
        /*
         *  Returns all of the users from the 'users' table 
         *  
         *  users
         *  ID | username | hash
         *  
         *  @returns: the array of users
         */
        public function getAllUsers()
        {
            $stmt = $this->DB->prepare("SELECT * FROM users");
            $stmt->execute();
            $usrs = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $usrs;
        }
        
        /*
         *  Returns all of the guitars from the 'guitars' table
         *
         *  guitars
         *  ID(integer) | brand(string) | name | price(float) | electric(int) 1 or 0
         *  
         *  @returns: all of the guitar items
         */
        public function getAllGuitars()
        {
            $stmt = $this->DB->prepare("SELECT * FROM guitars");
            $stmt->execute();
            $guitars = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $guitars;
        }
        
        /*
         *  Returns all of the items in the user's purchases by their id
         *  Note: can have mutiple userIDs!
         *  
         *  carts
         *  userID | ItemID  | Amount
         *  
         *  @params:
         *      $userID: the id of the user
         *      
         *  @returns:
         *      the items in the user's cart
         */
        public function getUserPurchases($userID)
        {
            $stmt = $this->DB->prepare("SELECT * FROM purchases WHERE userID=".$userID);
            $stmt->execute();
            $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $items;
        }
        
        /*
         *  This function creates a new user, it checks if the user already exists, if so,
         *  it fails, otherwise it hashes the user's password then adds the data to the database
         *
         *  @params:
         *      $usr: the username
         *      $pwd: the password
         *
         *  @returns:
         *      1 on successful user creation
         *      0 on failed user creation
         */
        public function createAccount($usr,$pwd)
        {
            $stmt = $this->DB->prepare("SELECT * FROM users WHERE user='$usr'");
            $stmt->execute();
            $name = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if($name) //user already exists
                return 0;
                else
                {
                    // Creating the new user
                    $id = $this->getUserAmount() + 1; // set the id
                    $hash = password_hash($pwd,PASSWORD_DEFAULT); // hash the password
                    $insert = $this->DB->prepare("INSERT INTO users VALUES ('$id','$usr','$hash')"); // Store
                    $insert->execute();
                    return 1;
                }
        }
        
        
        
        /*
         *  Called on user login. Checks if a user exists in the database
         *  and if the password they typed is correct.
         *
         *  @params
         *      $usr: the username
         *      $pwd: the password
         *
         *  @returns
         *      0 on successful login
         *      1 on username not existing
         *      2 on incorrect password
         *
         *      works
         */
        public function verifyCredentials($usr,$pwd)
        {
            $stmt = $this->DB->prepare("SELECT * FROM users WHERE user='$usr'");
            $stmt->execute();
            $user = $stmt->fetch( PDO::FETCH_ASSOC );
            
            if(!$user) //user doesn't exist
               return 1;
            else if(!password_verify($pwd, $user['hash'])) //passwords don't match
               return 2;
            else
               return 0;
        }
        
        /*
         *  Gets the amount of records in users
         *
         *  @params: none
         *
         *  @returns:
         *      the number of users
         */
        public function getUserAmount()
        {
            $count = $this->DB->prepare("SELECT * FROM users");
            $count->execute();
            return $count->rowCount();
        }
        
        /*TODO: Add more functions here*/
        
    } // end of DataBaseAdapter
    
    //The Object
    $theDBA = new DatabaseAdapter();
    
    //Testcases down here COMMENT WHEN DONE TESTING!
    
    /*$arr = $theDBA->getUserPurchases(1);
    print_r($arr);
    $arr = $theDBA->getAllUsers();
    print_r($arr);
    $arr = $theDBA->getAllGuitars();
    print_r($arr);*/
    
    /*$rt = $theDBA->createAccount("orange", "orange");
    echo $rt;
    
    rt = $theDBA->createAccount("Steve", "Steve");
    echo $rt;
    
    $rt = $theDBA->verifyCredentials("Nope", "Steve");
    echo $rt;
    $rt = $theDBA->verifyCredentials("Steve", "Nope");
    echo $rt;
    $rt = $theDBA->verifyCredentials("orange", "orange");
    echo $rt;*/
    
    
 ?>