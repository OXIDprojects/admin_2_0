<?php

class Admin2_Output_Processor_Csv implements Admin2_Output_Processor_Interface
{
    /**
     * Return result set as CSV
     *
     * @param Admin2_Controller_Result $result Result set as array
     *
     * @return string Converted result set as CSV-String with field names in first line
     */
    public function process(Admin2_Controller_Result $result)
    {
        $result->addResponseHeader('Content-Type', 'text/plain', true);
        $data = $result->getData();
        $keys = array_keys($data);
        $key = $keys[0];
        $fields = array_keys($data[$key]);
        $headLine = implode(',', $fields);
        $ret = $headLine ."\n";
        foreach ($data as $line) {
            $ret .= implode('","', str_replace('"', '\"', $line)) . "\n";
        }
        return $ret;
    }
}