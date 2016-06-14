# ZF2 Form Fields Validator

## How to install
`php composer.phar require vitorbarros/vmb-zf2-form-fields-validator`

## How to use

    namespace People\Form;
    
    use VMBFormFieldsValidator\Form\FormFilter;
    use Zend\Form\Form;
    
    class ClientForm extends Form
    {
    
        /**
         * ClientForm constructor.
         * @param null $name
         * @param array $options
         */
        public function __construct($name = null, array $options = array())
        {
            $this->setInputFilter(new FormFilter(array(
                //You fill this array with all required fields
                'fieldsRequired' => array(
                    'client_name' => 'Nome',
                    'client_credit_aprovated_at' => 'Data de aprovação do crédito',
                    'client_birthday' => 'Data de nascimento',
                    'address_name' => 'Endereço',
                    'address_neighborhood' => 'Bairro',
                    'address_city' => 'Cidade',
                    'address_state' => 'Estado',
                    'address_zipcode' => 'Cep',
                    'contact_name' => 'Contato',
                    'contact_phone_1' => 'Telefone 1',
                    'client_activity' => 'Atividade',
                    'operator' => 'Operador responsável'
                ),
                //You only put this array if you need passeord validation
                'passwordValidator' => array(
                    'password' => array(
                        'name' => 'user_password',
                        'label' => 'Senha'
                    ),
                    'confirmation' => array(
                        'name' => 'user_password_confirm',
                        'label' => 'Confirmar senha'
                    )
                )
            )));
        }
    }
