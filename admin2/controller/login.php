<?php

class login {
    
    // Name of the templatefile
    protected $_templateName = 'login.php';
    
    /**
     * Prepare content and return the output
     *
     * @return rendered output
     */
    public function render()
    {
        return $this->_templateName;
    }
    
}