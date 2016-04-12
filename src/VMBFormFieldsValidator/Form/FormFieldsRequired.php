<?php
namespace VMBFormFieldsValidator\Form;

use Zend\I18n\Translator\Translator;
use Zend\InputFilter\InputFilter;

class FormFieldsRequired extends InputFilter
{

    private $fields = array();
    private $locale;
    private $translator;

    public function __construct(array $fields, $locale)
    {
        $this->fields = $fields;
        $this->locale = $locale;
        $this->translator = new Translator();
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
                                'message' => $this->translator->translate("The field <b>{$label}</b> cannot be null", "default", $this->locale)
                            )
                        )
                    )
                );

                $this->add($filter);

            }
        }
        throw new \Exception("index 'fieldsRequired' is missing");
    }

}