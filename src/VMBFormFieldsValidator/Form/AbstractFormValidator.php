<?php
namespace VMBFormFieldsValidator\Form;

use Zend\InputFilter\InputFilter;

abstract class AbstractFormValidator extends InputFilter
{

    private $fields = array();

    public function __construct(array $fields)
    {
        $this->fields = $fields;
        $this->fieldsRequired();
        $this->passwordValidator();
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
        } else {
            throw new \Exception("index 'fieldsRequired' is missing");
        }

    }

    private function passwordValidator()
    {

        if (isset($this->fields['passwordValidator'])) {

            $labelConfirmation = $this->fields['passwordValidator']['confirmation']['label'];
            $labelPassword = $this->fields['passwordValidator']['password']['label'];

            $this->add(array(
                'name' => $this->fields['passwordValidator']['confirmation']['name'],
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name' => 'Identical',
                        'options' => array(
                            'token' => $this->fields['passwordValidator']['password']['name'],
                            'message' => "O campo <b>'{$labelPassword}'</b> não pode ser diferente do campo <b>'{$labelConfirmation}'</b>"
                        )
                    ),
                    array(
                        'name' => 'notEmpty',
                        'options' => array(
                            'message' => "The field <b>{$labelConfirmation}</b> cannot be null"
                        )
                    )
                )
            ));

            $this->add(array(
                'name' => $this->fields['passwordValidator']['password']['name'],
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name' => 'notEmpty',
                        'options' => array(
                            'message' => "The field <b>{$labelPassword}</b> cannot be null"
                        )
                    )
                )
            ));

        }
    }

}