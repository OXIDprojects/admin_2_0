<?php
class Admin2_Signature_Hash_Sha256 implements Admin2_Signature_HashInterface
{
    /**
     * Generates a SHA-26 hash using "hash" function.
     *
     * @param string $string String to create the hash for.
     *
     * @return string
     */
    public function createHash($string)
    {
        $hash = hash("sha256", $string);
        return strtoupper($hash);
    }
}
