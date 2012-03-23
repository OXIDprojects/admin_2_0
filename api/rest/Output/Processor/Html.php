<?php
class Admin2_Output_Processor_Html implements Admin2_Output_Processor_Interface
{

    public function process(Admin2_Controller_Result $result)
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
