<?php
/**
 *  This file is part of Admin 2.0 project for OXID eShop CE/PE/EE.
 *
 *  The Admin 2.0 sourcecode is free software: you can redistribute it and/or modify
 *  it under the terms of the MIT License.
 *
 *  @link      http://admin20.de
 *  @copyright (C) 2012 :: Admin 2.0 Developers
 */

/**
 * Handle HTML output
 */
class Admin2_Output_Processor_Html implements Admin2_Output_Processor_Interface
{
    /**
     * Build HTML output
     *
     * @param Admin2_Controller_Response $result Result object
     *
     * @return string
     */
    public function process(Admin2_Controller_Response $result)
    {
        $result->addResponseHeader('Content-Type', 'text/html');
        $html = <<<EOH
<html>
<head>
<title>REST</title>
</head>
<body>
%s
</body>
</html>
EOH;
        $htmlSnippet = $this->implode($result->getData());

        return sprintf($html, $htmlSnippet);
    }

    /**
     * Convert data to HTML output
     *
     * @param array $array The array of data to output
     *
     * @return string
     */
    protected function implode($array)
    {
        $htmlSnippet = '<table border="1" style="border-collapse:collapse;margin:15px;">'
            . '<tr style="background-color:#EEE;"><th>key</th><th>value</th></tr>';
        foreach ($array as $key => $value) {
            if (is_array($value) || $value instanceof Traversable) {
                $value = $this->implode($value);
            }
            $htmlSnippet .= "<tr><td style=\"padding:5px;\">$key</td><td style=\"padding:5px;\">$value</td></tr>";
        }
        $htmlSnippet .= '</table>';

        return $htmlSnippet;
    }
}
