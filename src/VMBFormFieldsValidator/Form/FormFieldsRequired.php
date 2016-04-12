<?php
namespace VMBFormFieldsValidator\Form;

use Zend\InputFilter\InputFilter;

class FormFieldsRequired extends InputFilter
{

    private $fields = array();

    public function __construct(array $fields)
    {
        $this->fields = $fields;
    }

    public function fieldsRequired()
    {
        if(isset($this->fields['fieldsRequired'])){
            
        }
        throw new \Exception("index 'fieldsRequired' is missing");
    }

}