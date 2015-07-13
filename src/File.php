<?php
/**
 * @author Leo
 */ 
class File{
	private $contentObject;
	private $directory;
	private $fileName;
	
	/**
	 * Set up the instance
	 * @param string $directory The directory
	 * @param string $fileName The name of the file
	 */
	public function __construct($directory, $fileName){
		$this->directory = $directory;
		$this->fileName = $fileName;
		$this->checkDir();
	}
	
	private function checkDir(){
		$dirs = explode(DIRECTORY_SEPARATOR, $this->directory);
		$path = "";
		foreach($dirs as $dir){
                    if(!file_exists($path.$dir)){
                            mkdir($path.$dir, 0777);
                    }
                    if($path == ""){
                        $path = $dir.DIRECTORY_SEPARATOR;
                    }else{
                        $path = $path.$dir.DIRECTORY_SEPARATOR;
                    }
		}
	}
	
	/**
	 * True if the file is a directory
	 */
	public function isDirectory(){
            return is_dir($this->getPath());
	}
	
	/**
	 * @return unknown The content of the file
	 */
	public function getContent(){
		//Load file
		$content = file_get_contents($this->getPath());
		return $content;
	}
	
	/**
	 * Returns the path of the file
	 * @return string
	 */
	private function getPath($name = null){
		if($name == null){
			$name = $this->fileName;
		}
		$path = $this->directory.DIRECTORY_SEPARATOR.$name;
		return $path;
	}
	
	/**
	 * Save the content to the file
	 * @param object $content The object to save as serialized json
	 */
	public function setContent($content){
            //asign the content
            $this->contentObject = $content;

            //save to disk as serialized
            $json = json_encode($this->contentObject);
            if($this->exists()){
               file_put_contents($this->getPath(), $json);
            }
	}
	
	/**
	 * Checks if the file exists
	 * @return boolean True if the file exists, false in other case
	 */
	public function exists(){
		$fichName = $this->getPath();
		return file_exists($fichName);
	}
	
	/**
	 * Deletes the file
	 */
	public function delete(){
		try{
			unlink($this->getPath());
		}
		catch(Exception $exc){
			//ApsUtilsDebug::Debug("Error deleting file ".$this->getPath().": ".print_r($exc));
		}
	}
	
	/**
	 * Renames the file
	 */
	public function rename($newName){
		rename($this->getPath(), $this->getPath($newName));
		$this->fileName = $newName;
	}
	
}
?>