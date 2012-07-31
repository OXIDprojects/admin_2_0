<?php
class Admin2_Signature_PhpArray extends Admin2_Signature_SignatureAbstract
{
    /**
     * Create a new signature based on the given data.
     *
     * @param Admin2_Signature_HashInterface $hash Class for hash creation.
     *
     * @return string
     */
    public function createSignature(Admin2_Signature_HashInterface $hash)
    {
        $data = $this->getData();
        $imploded = $this->implodeArray($data);
        return $hash->createHash($imploded);
    }

    public function implodeArray($array, $prefix = '', $level = 1)
    {
        if (is_scalar($array)) {
            return $array;
        }

        if (empty($array)) {
            return '&' . $prefix . '=';
        }

        ksort($array);

        $imploded = '';
        foreach ($array as $key => $value) {
            if ($level == 1) {
                $imploded .= "&";
                $newPrefix = $key;
            } else {
                $newPrefix = $prefix . '[' . $key . ']';
            }

            if (is_array($value)) {
                $imploded .= $this->implodeArray($value, $newPrefix, $level + 1);
            }

            if (is_scalar($value)) {
                $imploded .= '&' . $newPrefix . '=' . $value;
            }
        }

        return ltrim($imploded, '&');
    }
}
