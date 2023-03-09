<?php




class Photo extends Db_object {

	protected static $db_table = "photos";
    protected static $db_table_fields = array('id','title','caption', 'description', 'filename','alternate_text', 'type', 'size', 'user_id');
    public $id;
    public $title;
    public $caption;
    public $description;
    public $filename;
    public $alternate_text;
    public $type;
    public $size;




    public function picture_path(){
    	return $this->upload_directory.DS.$this->filename;
    }




    public function delete_photo(){
    	if($this->delete()){
    		$target_path = SITE_ROOT . DS . 'admin' . DS . $this->picture_path();
    		return unlink($target_path) ? true : false;
    	}else{
    		return false;
    	}
    }



    public static function display_sidebar_data($photo_id){
        $photo = Photo::find_by_id($photo_id);

        $output = "<a class='thumbnails' href='#'> <img width='100' src='{$photo->picture_path()}'> </a>";
        $output .= "<br><br><p><b>Filename:</b> {$photo->filename}</p>";
        $output .= "<p><b>File type:</b> {$photo->type}</p>";
        $output .= "<p><b>Size:</b> {$photo->size}</p>";

        echo $output;

    }







}// END OF PHOTO CLASS










?>