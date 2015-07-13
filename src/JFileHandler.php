<?php
require_once 'JsonHandler.php';
require_once 'File.php';

/**
 * @author Leo
 */
class JFileHandler {
    
    private $File;
    private $JsonHandler;
    
    /**
     * 
     * @param $file type object
     * @param $JsonHandler type object
     */
    public function __construct($directory,$fileName) {
        
        $this->File=new File($directory, $fileName);
        $this->JsonHandler=new JsonHandler();
    }
    
    public function parseJson(){
        $content=$this->file->getContent();
        $data=$this->JsonHandler->parseToObject($content);
        return $data;
    }
    
    
    
}
