<?php
abstract class Admin2_Signature_SignatureAbstract
{
    /**
     * Data for signature creation.
     *
     * @var mixed
     */
    private $data;

    /**
     * Create a new signature based on the given data.
     *
     * @param Admin2_Signature_HashInterface $hash Class for hash creation.
     *
     * @abstract
     * @return string
     */
    abstract public function createSignature(Admin2_Signature_HashInterface $hash);

    /**
     * Sets the data for the signature creation.
     *
     * @param mixed $data Data to create the signature for.
     *
     * @return void
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * Returns the data for the signature creation.
     *
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }
}
