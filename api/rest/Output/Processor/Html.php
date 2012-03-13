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
        $htmlSnippet = '<table border="1" style="border-collapse:collapse;"><tr><th>key</th><th>value</th></tr>';
        foreach ($result->getData() as $key => $value) {
            $htmlSnippet .= "<tr><td>$key</td><td>$value</td></tr>";
        }

        $htmlSnippet .= '</table>';

        return sprintf($html, $htmlSnippet);
    }
}
