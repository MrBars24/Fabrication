<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Fupload{

	private $store_folder;
	private $files = array();
	private $accepted = array();
	private $crop_width = 80;
	private $crop_height = 80;


	public function __construct(){

	}

	/**
	* 
	* Set Directory
	* @params path --> location path to save uploaded files
	*/
	public function setFolder($path){
		$this->store_folder = $path;
	}

	/**
	* 
	* Process Upload
	* @params $key --> name of the input file
	*/
	public function processUpload($key,$type = 'native'){
		if($type == 'native'){
			return $this->nativeUpload($key);
		}else{
			$this->base64Upload();
		}
	}

	public function revert(){
		if(!empty($this->file)){
			if(is_array($this->file)){
				foreach($this->file as $f){
					unlink($f['path']);
				}
			}else{
				unlink($this->file['path']);
			}
		}
	}

	public function setAcceptedType($type){
		if(is_array($type)){
			$this->accepted = array_merge($this->accepted,$type);
		}else{
			array_push($this->accepted, $type);
		}
	}

	private function createThumbnail($key,$filename){
		$folder = $this->store_folder .DIRECTORY_SEPARATOR.'thumbnails'.DIRECTORY_SEPARATOR;

		if (!file_exists($folder)) {
		    mkdir($folder, 0777, true);
		}

		$file = $this->store_folder .DIRECTORY_SEPARATOR. $filename;
		list( $width,$height,$type ) = getimagesize( $file );
		$this->setScale($width,$height);
		$thumb = imagecreatetruecolor($this->crop_width,$this->crop_height);
		
		switch ($type) {
            case IMAGETYPE_PNG:
                $source = imagecreatefrompng($file);
                $copy = imagecopyresampled($thumb,$source,0,0,0,0,$this->crop_width,$this->crop_height, $width,$height);
                imagepng($thumb,$folder. 'thumb_' . $filename);
                break;

            case IMAGETYPE_GIF:
                $source = imagecreatefromgif($file);
                $copy = imagecopyresampled($thumb,$source,0,0,0,0,$this->crop_width,$this->crop_height, $width,$height);
                imagegif($thumb,$folder. 'thumb_' . $filename);
                break;

            case IMAGETYPE_JPEG:
                $source = imagecreatefromjpeg($file);
                $copy = imagecopyresampled($thumb,$source,0,0,0,0,$this->crop_width,$this->crop_height, $width,$height);
                imagejpeg($thumb,$folder. 'thumb_' . $filename);
                break;

            default:
                trigger_error("Invalid Image Type", E_USER_ERROR);
                break;
        }
	}

	private function base64Upload(){

	}

	private function nativeUpload($key){
		$this->files = array();
		if (!empty($_FILES)) {
			if (!file_exists($this->store_folder)) {
			    mkdir($this->store_folder, 0777, true);
			}

			if(is_array($_FILES[$key]['name'])){
		      	$f = $_FILES[$key];
		     	for($i=0; $i<count($f['name']); $i++){

		     		$type = $_FILES[$key]['type'][$i];
		     		if(!empty($this->accepted)){
						if(!in_array($type, $this->accepted)) {
							trigger_error("Uploaded file type is not allowed", E_USER_ERROR);
						}
					}

			        $tempFile = $_FILES[$key]['tmp_name'][$i];
			        $file = time() .'_'. $_FILES[$key]['name'][$i];
			        $targetPath = $this->store_folder .DIRECTORY_SEPARATOR;  //4
			        $targetFile =  $targetPath. $file;
			        $path = $_FILES[$key]['name'][$i];
					$ext = pathinfo($path, PATHINFO_EXTENSION);
					$size = $_FILES[$key]['size'][$i];

			        if(move_uploaded_file($tempFile,$targetFile)){
			        	$this->createThumbnail($key,$file);
			          	array_push($this->files,
			          		array(
			          			"path"=>"/".$targetFile,
			          			"filename"=>$file,
			          			"extension"=>$ext,
			          			"size"=>$size,
			          			"type"=>$type
			          		)
			          	);
			        }else{
			        	$this->revert();
			        	return [];
			        }
		      	}

		      	return $this->files;
				

			}else{

				$type = $_FILES[$key]['type'];
	     		if(!empty($this->accepted)){
					if(!in_array($type, $this->accepted)) {
						trigger_error("Uploaded file type is not allowed", E_USER_ERROR);
					}
				}

				$tempFile = $_FILES[$key]['tmp_name'];
		        $file = time() .'_'. $_FILES[$key]['name'];
		        $targetPath = $this->store_folder .DIRECTORY_SEPARATOR;  //4
		        $targetFile =  $targetPath. $file;
		        $path = $_FILES[$key]['name'];
				$ext = pathinfo($path, PATHINFO_EXTENSION);
				$size = $_FILES[$key]['size'];

		        if(move_uploaded_file($tempFile,$targetFile)){
		        	$this->createThumbnail($key,$file);
		          	$this->files["path"] = "/".$targetFile;
	          		$this->files["filename"]=$file;
          			$this->files["extension"]=$ext;
          			$this->files["size"]=$size;
          			$this->files["type"]=$type;
		        }else{
		        	$this->revert();
		        	return [];
		        }

		        return $this->files;
			}
		}

		return [];
	}

	private function setScale($w,$h){
		if($w > $h){
			$tmp = $h / $this->crop_height;
			$this->crop_width = $w / $tmp;
		}else{
			$tmp = $w / $this->crop_width;
			$this->crop_height = $h / $tmp;
		}
	}

}