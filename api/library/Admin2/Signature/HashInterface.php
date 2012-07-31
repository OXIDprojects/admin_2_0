<?php
interface Admin2_Signature_HashInterface
{
    /**
     * Generate a hash for a string.
     *
     * @param string $string String to create the hash for.
     *
     * @abstract
     * @return string
     */
    public function createHash($string);
}
