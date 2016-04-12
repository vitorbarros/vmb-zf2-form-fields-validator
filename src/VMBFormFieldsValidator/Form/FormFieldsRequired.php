<?php
namespace VMBFormFieldsValidator\Form;

use Zend\InputFilter\InputFilter;

class FormFieldsRequired extends InputFilter
{

    private $fields = array();

    public function __construct(array $fields)
    {
        $this->fields = $fields;
        $this->fieldsRequired();
    }

    private function fieldsRequired()
    {
        if (isset($this->fields['fieldsRequired'])) {
            foreach ($this->fields['fieldsRequired'] as $name => $label) {

                $filter = array(
                    'name' => $name,
                    'require' => true,
                    'filters' => array(
                        array('name' => 'StripTags'),
                        array('name' => 'StringTrim')
                    ),
                    'validators' => array(
                        array(
                            'name' => 'notEmpty',
                            'options' => array(
                                'message' => "The field <b>{$label}</b> cannot be null"
                            )
                        )
                    )
                );

                $this->add($filter);

            }
        }else{
            throw new \Exception("index 'fieldsRequired' is missing");
        }

    }

}