<?php

namespace app\word;

/**
 * Class responsible for loading the file with words and
 * putting it in memory for later reading
 *
 * @author Lucas Lima <lucasdevelopmaster@gmail.com>
 * @version 1.0.0
 */
class WordManager
{
    /**
     * Name of the file to be loaded
     *
     * @var string
     */
    private $fileName = null;

    /**
     * Default path where the file is located
     */
    const PATH_FILE = __DIR__ . "/../static_files/";

    /**
     * Standard builder of class
     *
     * @param string $fileName
     */
    public function __construct($fileName)
    {
        $this->setFileName(self::PATH_FILE . $fileName);
    }

    /**
     * Load the static file
     *
     * @return void
     */
    public function loadFile()
    {
        $data = file_get_contents($this->getFileName());
        $data = json_decode($data);
        return $data;
    }

    /**
     * Get the value of fileName
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * Set the value of fileName
     *
     * @return  self
     */
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;

        return $this;
    }
}
