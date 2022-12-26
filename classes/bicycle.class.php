<?php
    class Bicycle{
        //here we are telling the instance of our class about our database
        //which you know that static can be called anywhere without an instance
        //so we will be able to use it within the class name like this self::
        static public $database;

        static protected $db_columns = ['brand','model','year','category','gender','color','price','weight_kg','condition_id','description'];
        //then we need to create a function that set our database
        //it is also going to be a static .. which will will call the function inside the
        //connection.php, so that we can pass the argument from there to use inside our function parameter
        //the $database inside this set_database($database) is a parameter, which we can give any name
        //then  return self::$database = $database for this, the self::$database is from the property defined up
        //static public $database;
        //so we will go inside the connection.php to call this function and pass in an argument
        //like this Bicycle::set_database($connection); .. the $connection is the argument

        // this variable holds all our errors
        public $errors = [];
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

        public const CATEGORIES = ['Road', 'Mountain', 'Hybrid', 'Cruiser', 'City', 'BMX'];


        public const GENDERS = ['Men', 'Women', 'Unisex'];

        public const CONDITION_OPTIONS = [
            1 => 'Beat Up',
            2 => 'Decent',
            3 => 'Good',
            4 => 'Great',
            5 => 'Used',
            6 => 'New'

        ];

        // just to hold the bicycle details in one function, when we call it

        public function name() {
            return "{$this->brand} {$this->model} {$this->year}";
          }

         //we created the construct methods, which executes immediately we instantiate
         //that is the first thing that runs
        //pass in an $args=[] as the parameter, 
        //which holds all the parameter that we want to pass to it, instead of passing it one by one
        //inside the __construct function, we then call each of the  properties that we set , which is
        // $this->brand and then set each to the brand we are getting from the new.php
        // cos we will be instantiating there, so look at the new.php, where we are creating the new bicycle

        public function __construct($args=[])
        {
            
            $this->brand = $args['brand'] ?? "";
            $this->model = $args['model'] ?? "";
            $this->year = $args['year'] ?? "";
            $this->category = $args['category'] ?? "";
            $this->color = $args['color'] ?? "";
            $this->description = $args['description'] ?? "";
            $this->gender = $args['gender'] ?? "";
            $this->price = $args['price'] ?? "";
            $this->weight_kg = $args['weight_kg'] ?? "";
            $this->condition_id = $args['condition_id'] ?? "";
        }


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

             //function for validating our form

             protected function validate(){

                $this->errors = [];

                if (empty($this->brand) || $this->brand === "") {
                    
                    $this->errors[] = "Brand cannot be empty";
                }

                if (empty($this->model) || $this->model === "") {
                    
                    $this->errors[] = "Model cannot be empty";
                }
                

                
                return $this->errors;

             }

        // writing the create function,
        //to insert the values from the form inside the database table called bicycle
        //after inserting and we queried , which is this             $result = self::$database->query($sql);
        //then if we get back the result to be true, let's get the id of the inserted data by using the insert_id
        //that is provided for us automatically by php (which is an inbuilt function)
        //then store the id into the property id
        //then  go back to the new.php to check if the result is true, then return another message
        
//let's modify our code , firstly let's create a property called db_columns, which is for all the columns in our table
//all this brand,model,year,category,gender,color,price,weight_kg,condition_id,description  , we store it in an array
//which will be static protected $db_columns = ['brand','model','year','category','gender','color','price','weight_kg','condition_id','description'];

    //we created it at the top   

    //so this line of code  $sql = "INSERT INTO bicycles (brand,model,year,category,gender,color,price,weight_kg,condition_id,description) ";
// will change to the below
//            $sql = "INSERT INTO bicycles join(', ' , self::$db_columns) ";


// we will also modify this line too
//$sql .= "VALUES('$this->brand','$this->model','$this->year','$this->category','$this->gender','$this->color','$this->price','$this->weight_kg','$this->condition_id','$this->description' )";
// by creating a function or method.. that gives is that.. which will be called attributes() , we will write it down here
// inside here now , we are using this         $attributes = $this->attributes();
//which means all our attributes are not yet sanitize, to do that, we will create a function to sanitize that 
//and this will be changed from $attributes = $this->attributes(); to $attributes = $this->sanitize_attributes();
//so let's create the sanitize_attributes() function below

protected function create(){
    //calling the validate function

    $this->validate();

    if (!empty($this->errors)) {
        $output = "<div>";
        $output .= "Please fix the following errors:";
        $output .= "<ul>";
        foreach($this->errors as $error) {
          $output .= "<li>" . $error . "</li>";
        }
        $output .= "</ul>";
        $output .= "</div>";
        echo $output;
        return false;
    }

    //firstly let's get the attributes value
        // $attributes = $this->attributes(); change to this
        $attributes = $this->sanitize_attributes();
        

            $sql = "INSERT INTO bicycles (";
            $sql .= join(', ' , self::$db_columns) ;
            // $sql .= "VALUES('$this->brand','$this->model','$this->year','$this->category','$this->gender','$this->color','$this->price','$this->weight_kg','$this->condition_id','$this->description' )";
             $sql .= ") VALUES ('" ;
             $sql .= join("', '", array_values($attributes));
             $sql .= "')";

           
           
            $result = self::$database->query($sql);


            // checking if the result is true, which mean if it insert the data
            //then get us the id of the last inserted data
            //then store the id into the property id
            
            if ($result) {
                $this->id = self::$database->insert_id;
            }

            return $result;
        }

        // we set an empty array, which is going to be an associative array
        //which will have a key and a value
        //to get the key and the value, will will loop through the $db_columns .. that has all the fields
        //inside this $db_columns array, we also have id, which we don't want it to loop for us.. 
        //which means we will skip it by doing
        // if ($column == 'id') {  continue; }

        public function attributes(){
            $attributes = [];

            foreach (self::$db_columns as $column) {

                if ($column == 'id') { continue; }

                $attributes[$column] = $this->$column;
            }

            return $attributes;
        }


        //this is the function that sanitizes the data
        // we create an empty array and store inside a variable $sanitize
        //loop through the attributes and get the key and the function
        // each key is equal to the value and then we used the escape_string() function s that cleans our code up
        // then we can now go to the create function to use the sanitize_attributes()
        public function sanitize_attributes(){
            $sanitize = [];

            foreach ($this->attributes() as $key => $value) {
                $sanitize[$key] = self::$database->escape_string($value);
            }
            return $sanitize;
        }


        //for update
        protected function update(){

             //calling the validate function

    $this->validate();
    
            //we call the sanitize attributes
            $attributes = $this->sanitize_attributes();
            //we set a pair of attributes
            $attributes_pairs = [];
            foreach ($attributes as $key => $value) {
                $attributes_pairs[] = "{$key} = '{$value}' ";

            }

            $sql = "UPDATE bicycles SET ";
            $sql .= join(', ' , $attributes_pairs);
            $sql .= "WHERE id ='" . self::$database->escape_string($this->id) . " '";
            $sql .= "LIMIT 1";
        
            $result = self::$database->query($sql);
         
           
            return $result;
        }

        //for merge attribute
        public function merge_attributes($args=[]){
            foreach ($args as $key => $value) {
            if (property_exists($this, $key) && !is_null($value)) {
                #
                $this->$key = $value;
            }
            }

        }

        // lets add a function called save() , this will always be called after
        // we finish querying when we are updating or create , so for everywhere we have called
        //create() or update() , we will change it to save() and the function of the create() and update(), will be changed to protected

        public function save() {
                if (isset($this->id)) {
                    
                    return $this->update();
                }else{
                    return $this->create();
                }
        }


        // the delete function

        public function delete(){

            $sql = "DELETE FROM bicycles ";
            $sql .= "WHERE id='" . self::$database->escape_string($this->id) . "' ";

            $sql .= "LIMIT 1";
          
            $result = self::$database->query($sql);

          
            return $result;

            //After deleting , the instance of the object will still
            //exist, even though the database record does not
            // this can be useful as in
            // echo $user->first_name ." was deleted";
            // but we have to be careful
            //we can't call $user->update() after we call $user->delete();
        }
       
    }
?>