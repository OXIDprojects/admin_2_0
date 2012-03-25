<?php
class Admin2_Loader_Autoloader
{
    /**
     * Instance of the autoloader.
     *
     * @var Admin2_Loader_Autoloader
     */
    private static $_instance;

    /**
     * Cache for PHP's exploded include paths.
     *
     * @var array
     */
    private $_includePaths;

    /**
     * Registered namespaces.
     *
     * @var array
     */
    protected $_namespaces = array();

    /**
     * Class constructor.
     * Register the autoloader function via SPL.
     *
     * @return Admin2_Loader_Autoloader
     */
    private function __construct()
    {
        spl_autoload_register(array($this, 'loadClass'));
    }

    /**
     * Retrives the autoloader instance.
     *
     * @return Admin2_Loader_Autoloader
     */
    public static function getInstance()
    {
        if (self::$_instance === null) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    /**
     * Registers a new namespace to the autoloader.
     *
     * @param string $namespace name of the new namespace.
     *
     * @return null
     */
    public function registerNamespace($namespace)
    {
        $this->_namespaces[] = (string) $namespace;
    }

    /**
     * Loads the PHP file within the class definition.
     *
     * @param string $className Name of the class.
     *
     * @throws Admin2_Loader_Exception
     *
     * @return bool
     */
    public function loadClass($className)
    {
        $spacedClassName = str_replace(array('\\', '_'), ' ', $className);
        $firstSpace = strpos($spacedClassName, ' ');
        if ($firstSpace === false) {
            return false;
        }

        $namespace = substr($spacedClassName, 0, $firstSpace);
        if (!in_array($namespace, $this->_namespaces)) {
            return false;
        }

        $fileName = str_replace(' ', DIRECTORY_SEPARATOR, ucwords($spacedClassName)) . '.php';

        if (!$this->fileExists($fileName)) {
            require_once 'Admin2/Loader/Exception.php';
            throw new Admin2_Loader_Exception("Can't find PHP file for class '$className'.");
        }

        include_once $fileName;

        if (!class_exists($className) && !interface_exists($className)) {
            require_once 'Admin2/Loader/Exception.php';
            throw new Admin2_Loader_Exception(
                "The file '$fileName' doesn't contain the class definition for '$className'."
            );
        }

        return true;
    }

    /**
     * Checks if a file exists in the include paths.
     *
     * @param string $fileName Name of the file to check. Can contain relative paths.
     *
     * @return bool
     */
    protected function fileExists($fileName)
    {
        if ($this->_includePaths === null) {
            $this->_includePaths = explode(PATH_SEPARATOR, get_include_path());
        }
        foreach ($this->_includePaths as $includePath) {
            $realFile = rtrim($includePath, '/') . '/' . $fileName;
            if (file_exists($realFile)) {
                return true;
            }
        }
        return false;
    }
}
