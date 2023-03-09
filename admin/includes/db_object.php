<?php




class Db_object {

    public $tmp_path;
    public $upload_directory = "images";
    public $errors;
    public $upload_errors_array = array(
                                        UPLOAD_ERR_OK           => "There is no error",
                                        UPLOAD_ERR_INI_SIZE     => "The uploaded file exceeds the upload_max_filesize directive in php.ini",
                                        UPLOAD_ERR_FORM_SIZE    => "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML file",
                                        UPLOAD_ERR_PARTIAL      => "The upload file was only partially uploaded.",
                                        UPLOAD_ERR_NO_FILE      => "No file was uploaded.",
                                        UPLOAD_ERR_NO_TMP_DIR   => "Missing a temporary folder.",
                                        UPLOAD_ERR_CANT_WRITE   => "Failed to write file to disk.",
                                        UPLOAD_ERR_EXTENSION    => "A PHP extension stopped the file upload."
                                        ); //End of upload_errors_arrays                                                                                   



	public static function find_all(){
		return static::find_by_query("SELECT * FROM " . static::$db_table . " ");

	}//END OF FIND_ALL METHOD


    public static function find_by_id($id){
    	$the_result_array = static::find_by_query("SELECT * FROM " . static::$db_table . " WHERE id = $id LIMIT 1");
        return !empty($the_result_array) ? array_shift($the_result_array) : false;

    }//END OF FIND_BY_ID METHOD



    public static function find_by_query($sql){
    	global $database;
    	$result_set = $database->query($sql);
    	$the_object_array = array();
    	while($row = mysqli_fetch_array($result_set)) {
    		$the_object_array[] = static::instantiation($row); 
    	}
    	return $the_object_array;
    }//END OF FIND_BY_QUERY METHOD



     public static function instantiation($the_record){
        $calling_class = get_called_class();
    	$the_object = new $calling_class;

        foreach ($the_record as $the_attribute => $value) {
        	if($the_object->has_the_attribute($the_attribute)){
        		$the_object->$the_attribute = $value;
        	}
        }
	    return $the_object;
    }//END OF INSTANTIATION METHOD

  
    private function has_the_attribute($the_attribute){
    	$object_properties = get_object_vars($this);
    	return array_key_exists($the_attribute, $object_properties);
    }//END OF HAS THE ATTRIBUTE METHOD



    protected function properties(){
        $properties = array();
        foreach (static::$db_table_fields as $db_field) {
            if(property_exists($this, $db_field)){
                $properties[$db_field] = $this->$db_field;
            }
        }
        return $properties;
    }//END OF PROPERTIES METHOD



    protected function clean_properties(){
        global $database;

        $clean_properties = array();

        foreach ($this->properties() as $key => $value) {
            $clean_properties[$key] = $database->escape_string($value);
        }
        return $clean_properties;
    }//END OF CLEAN PROPERTIES METHOD



    public function save(){
        return isset($this->id) ? $this->update() : $this->create();
    }//END OF SAVE METHOD


    public function create(){
        global $database;

        $properties = $this->clean_properties();

        $sql = "INSERT INTO " . static::$db_table . "(" . implode(",", array_keys($properties))  . ")";
        $sql .= "VALUE ('" . implode("','", array_values($properties)) . "')";

        if($database->query($sql)){
            $this->id = $database->the_insert_id();
            return true;
        }else{
            return die("Query Failed" .  mysqli_connect_error());
            //return false;
        }

    }//END OF CREATE METHOD

   

    public function update(){
        global $database;

        $properties = $this->clean_properties();
        $properties_pairs = array();

        foreach ($properties as $key => $value) {
            $properties_pairs[] = "{$key}='{$value}'";
        }

        $sql = "UPDATE " . static::$db_table . " SET ";
        $sql .= implode(",", $properties_pairs);
        $sql .= " WHERE id = " . $database->escape_string($this->id);

        $database->query($sql);
        return (mysqli_affected_rows($database->connection) == 1) ? true : false;

    }//END OF UPDATE METHOD



    public function delete(){
        global $database;

        $sql = "DELETE FROM " . static::$db_table . " ";
        $sql .= "WHERE id = " . $database->escape_string($this->id);
        $sql .=" LIMIT 1";

        $database->query($sql);
        return (mysqli_affected_rows($database->connection) ==1) ? true : die("Query failed");

    }//END OF DELETE METHOD





    // This is passing $_FILES['uploaded_file'] as an argument
    public function set_file($file){
        if(empty($file) || !$file || !is_array($file)){
            $this->errors[] = "There was no file uploaded";
            return false;

        }elseif($file['error'] != 0){
            $this->errors[] = $this->upload_errors_array[$file['error']];
            return false;

        }else{
            $this->filename = basename($file['name']);
            $this->tmp_path = $file['tmp_name'];
            $this->type     = $file['type'];
            $this->size     = $file['size'];

        }


    }// END OF SET_FILE METHOD


    public function picture_path(){
        return $this->upload_directory.DS.$this->filename;
    }



    public function save_file(){
        if($this->id){
            $this->update();
        }else{
            if(!empty($this->errors)){
                return false;
            }

            if(empty($this->filename) || empty($this->tmp_path)){
                $this->errors[] = "The file was not available";
                return false;
            }

            $target_path = SITE_ROOT . DS . 'admin' . DS . $this->upload_directory . DS . $this->filename;
            //$target_path = 'C:/xampp/htdocs/galleryx/admin/'. $this->upload_directory. '/' . $this->filename;

            if(file_exists($target_path)){
                $this->errors[] = "The file {$this->filename} already exist";
                return false;
            }

            if(move_uploaded_file($this->tmp_path, $target_path)){
                if($this->create()){
                    unset($this->tmp_path);
                    return true;

                }
            }else{
                $this->errors[] = "The file directory probably does not have permision";
                return false;
            }


        }
    }// END OF SAVE METHOD



    public static function counter(){
       global $database;
       $sql = "SELECT COUNT(*) FROM " . static::$db_table; 
       $result_set = $database->query($sql);
       $row = mysqli_fetch_array($result_set);

       return array_shift($row);

    }// END OF COUNTER METHOD



    public static function user_photo_counter($user_id){
        global $database;
        $sql = $database->query("SELECT COUNT(*) FROM photos WHERE user_id =" . $user_id);
        $result_set = mysqli_fetch_array($sql);
        return array_shift($result_set);
    }







}// END OF DB_OBJECT CLASS









?>