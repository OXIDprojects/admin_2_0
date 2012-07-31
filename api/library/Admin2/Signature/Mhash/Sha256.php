<?php
class Admin2_Signature_Mhash_Sha256 implements Admin2_Signature_HashInterface
{
    /**
     * Generates a SHA-26 hash using "mhash" function.
     *
     * @param string $string String to create the hash for.
     *
     * @return string
     */
    public function createHash($string)
    {
        $rawHash = mhash(MHASH_SHA256, $string);
        $unpacked = unpack("H*", $rawHash);
        return strtoupper(array_shift($unpacked));
    }
}
