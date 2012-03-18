<?php
class Admin2_Autoloader
{
    private static $_instance;

    private $_includePaths;

    private function __construct()
    {
        spl_autoload_register(array($this, 'loadClass'));
        $this->_includePaths = explode(PATH_SEPARATOR, get_include_path());
    }

    public static function getInstance()
    {
        if (self::$_instance === null) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    public function loadClass($className)
    {
        if (substr($className, 0, 7) != 'Admin2_') {
            return false;
        }

        $fileName = substr($className, 7);
        $fileName = str_replace('_', DIRECTORY_SEPARATOR, $fileName) . '.php';
        $realFile = null;
        foreach ($this->_includePaths as $includePath) {
            $realFile = rtrim($includePath, '/') . '/' . $fileName;
            if (file_exists($realFile)) {
                break;
            }
        }

        if ($realFile === null) {
            throw new Admin2_Autoloader_Exception("Can't find PHP file for class '$className'.");
        }

        include_once $realFile;

        if (!class_exists($className) && !interface_exists($className)) {
            throw new Admin2_Autoloader_Exception(
                "The file '$realFile' doesn't contain the class definition for '$className'."
            );
        }
    }
}
