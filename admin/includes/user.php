<?php

class User{

    //Set Props
    public $id;
    public $username;
    public $password;
    public $first_name;
    public $last_name;

    public static function find_all_users(){
       return self::find_this_query("Select * From users");
    }

    public static function find_user_by_id($id){        
        //Set Global Db
        global $database;

        //Get User By ID
        $query = "Select * From Users Where id = $id Limit 1";
        $the_result_array = self::find_this_query($query);

        //Ternay Syntax //fist condition ? do : else
        return !empty($the_result_array) ? array_shift($the_result_array) : false;      
    }

    public static function find_this_query($sql){
        //Set DB Global
        global $database;

        //Execute Query
        $result_set = $database->query($sql);

        //Object Array
        $the_object_array = array();

        //Fetch Records
        while ($row = mysqli_fetch_array($result_set)){
            $the_object_array[] = self::instantation($row);
        }

        //Return Objects
        return $the_object_array;
    }

    public static function instantation($the_record){
        $obj = new Self();
        
        //Loop
        foreach ($the_record as $the_attribute => $value){
            //Check Object Property
            if($obj->has_the_attribute($the_attribute)){
                $obj->$the_attribute = $value;
            }
        }

        return $obj;
    }

    //Check Object Has Attribute
    private function has_the_attribute($the_attribute){

        //Get Object Properties
        $object_properties = get_object_vars($this);

        //Return Boolean On Key Exsists
        return array_key_exists($the_attribute, $object_properties);

    }


}

?>