<?php
    class Bicycle{
        //here we are telling the instance of our class about our database
        //which you know that static can be called anywhere without an instance
        //so we will be able to use it within the class name like this self::
        static public $database;

        //then we need to create a function that set our database
        //it is also going to be a static .. which will will call the function inside the
        //connection.php, so that we can pass the argument from there to use inside our function parameter
        //the $database inside this set_database($database) is a parameter, which we can give any name
        //then  return self::$database = $database for this, the self::$database is from the property defined up
        //static public $database;
        //so we will go inside the connection.php to call this function and pass in an argument
        //like this Bicycle::set_database($connection); .. the $connection is the argument

    
        public $id;
        public $brand;
        public $model;
        public $year;
        public $category;
        public $color;
        public $description;
        public $gender;
        public $price;
        public $weight_kg;
        public $condition_id;

        static public function set_database($database){
            self::$database = $database;
        }


        // this is the function that performs the query 
        //which we can now call inside where we need to fetch all the bicycles from the db
        //since we have our query inside here now, all we need to do , is to change our database to protected
        //i mean this    static public $database; to this         static protected $database;
        // which will now change the             return Bicycle::$database->query($sql);
        //to   return self::$database->query($sql); 
        //because it is now protected and we can access it inside the same class as self::



        // let's modify our code from the below

        // static public function find_all(){
        //     $sql = "SELECT * FROM bicycles";
        //     return self::$database->query($sql);
        // }


        //to this, because in future we might want to find even just a single item and not all
        //we also check for error for the result

        static public function find_by_sql($sql){
            $result = self::$database->query($sql);

            if (!$result) {
                exit("Could not retrieve all result");
            }
            // return $result;

            //we need to convert the result to an array
            //set an empty object array 
            //let's create a while loop , while we are fetching the $result
            //which is this $records = $result->fetch_assoc()
            //then we need to append the $records inside the array ,this $object_array = []; 
            //lik this $object_array[] = $records;
            // but we need to instantiate it with the class, which will be performed by another function
            // like this $object_array[] = self::instantiate($records);
            //instantiate is a name of a function, which we will also create

            $object_array = [];
            while ($record = $result->fetch_assoc()) {
                $object_array[] = self::instantiate($record);
            }

            
            $result->free();
            return $object_array;
        }


        //the function instantiate

        static public function instantiate($record){

            //this  $object = new Bicycle; is the same as this $object = new self;
            // we are creating the instatnce of the class $object = new self;
            $object = new self;

            //we could assign the value of all the property in the class manually to it like this
            //$object->id = $record['id'];
            //$object->brand = $record['id'];
            //but it will take long, we can do it automatically like this
            //we will loop through the $record and it is going to be associative array

            foreach ($record as $property => $value) {
               //then we check if the property exist
               //using this property_exists($object, $property)
               // the $object is from the instance created from above , this   $object = new self;
               // and the second which is $property is from the foreach
               //so if it exist let's set the value
               //$object->$property = $value;  -- $object->$property will be $object->brand , $object->model
               //$object->year , which we assign the value that we got from the database to it, 
               //that means we have automatically assign values to the properties we created in our class
               //then we return the object

               // then let's go back to our index.php to call it out

               if (property_exists($object, $property)) {
                        $object->$property = $value;
               }
            }

           
            return $object;

        }

        //this function is to find all the bicycle we have in the database
        //we select all from bicycle
        //then to execute it, we return the method/function self::find_by_sql($getAllBicycle); and then pass $getAllBicycle
        //which calls the find_by_sql($sql) above to run the query

        static public function find_all(){
            $getAllBicycle = "SELECT * FROM bicycles";
            return self::find_by_sql($getAllBicycle);
        }

        //get a single data
        //by doing it this way
        //  $getSingleBicycle = "SELECT * FROM bicycles WHERE id = '" . $id . " ' ";
        // but by avoiding sql injection
        // $getSingleBicycle = "SELECT * FROM bicycles WHERE id = '"  . self::$database->escape_string($id) . " ' ";

        // then return the function to run the query inside the variable  $obj_array
        //   $obj_array = self::find_by_sql($getSingleBicycle);
        // then we check if it is not empty , the it can return the first value  



        static public function find_by_id($id){
            $getSingleBicycle = "SELECT * FROM bicycles WHERE id = '"  . self::$database->escape_string($id) . " ' ";
            $obj_array = self::find_by_sql($getSingleBicycle);

            
       

            if (!empty($obj_array)) {
                return array_shift($obj_array);
               
            }else {
                return false;
            }
        }

    }
?>