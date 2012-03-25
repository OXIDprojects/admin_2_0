<?php
class Admin2_Loader_ModuleLoader
{
    /**
     * Instance of the autoloader.
     *
     * @var Admin2_Loader_Autoloader
     */
    private static $_instance;

    /**
     * Namespace of the modules.
     *
     * @var string
     */
    protected $_namespace;

    /**
     * Paths for the modules.
     *
     * <code>
     * $paths = array(
     *      'models' => '/path/to/api/rest/models',
     * );
     * </code>
     *
     * @var array
     */
    protected $_paths;

    /**
     * Class constructor.
     * Register the autoloader function via SPL.
     *
     * @param string $namespace Namespace for the modules.
     * @param array  $paths     Path definitions.
     *
     * @see $_paths
     *
     * @return Admin2_Loader_ModuleLoader
     */
    private function __construct($namespace = 'Application', $paths = null)
    {
        $this->_paths = array(
            'model' => APPLICATION_PATH . '/models',
        );

        if ($paths !== null && is_array($paths)) {
            foreach ($paths as $module => $path) {
                $this->_paths[$module] = rtrim($path, '/');
            }
        }

        $this->_namespace = (string) $namespace;

        spl_autoload_register(array($this, 'loadClass'));
    }

    /**
     * Retrives the module loader instance.
     *
     * @param string $namespace Namespace for the modules.
     * @param array  $paths     Path definitions.
     *
     * @see $_paths
     *
     * @return Admin2_Loader_Autoloader
     */
    public static function getInstance($namespace = 'Application', $paths = null)
    {
        if (self::$_instance === null) {
            self::$_instance = new self($namespace, $paths);
        }

        return self::$_instance;
    }

    /**
     * Loads the PHP file within the class definition.
     *
     * @param string $className Name of the class.
     *
     * @throws Admin2_Loader_Exception
     *
     * @return null
     */
    protected function loadClass($className)
    {
        $spacedClassName = str_replace(array('\\', '_'), ' ', $className);
        $firstSpace = strpos($spacedClassName, ' ');
        if ($firstSpace === false) {
            return;
        }

        $namespace = substr($spacedClassName, 0, $firstSpace);

        if ($namespace != $this->_namespace) {
            return;
        }

        $secondSpace = strpos($spacedClassName, ' ', $firstSpace + 1);
        $rawModuleName = substr($spacedClassName, $firstSpace + 1, $secondSpace - $firstSpace - 1);
        $moduleName = strtolower($rawModuleName);

        if (!isset($this->_paths[$moduleName])) {
            return;
        }

        $fileName = $this->_paths[$moduleName] . '/' . substr($spacedClassName, $secondSpace + 1);
        $fileName = str_replace(' ', DIRECTORY_SEPARATOR, ucwords($fileName)) . '.php';

        if (!file_exists($fileName) || !is_readable($fileName)) {
            require_once 'Admin2/Loader/Exception.php';
            throw new Admin2_Loader_Exception("File '$fileName' does not exists.");
        }

        include_once $fileName;
    }

}
