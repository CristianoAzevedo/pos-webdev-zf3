<?php

namespace Application\Form;

use Zend\Form\Element;
use Zend\Form\Form;

class Login extends Form
{
    public function __construct()
    {
        parent::__construct();

        $this->add([
            'name' => 'name',
            'options' => [
                'label' => 'Nome:',
            ],
            'type' => 'Text',
            'attributes' => [
                'class' => 'form-control'
            ]
        ]);
        $this->add([
            'name' => 'password',
            'options' => [
                'label' => 'Senha:',
            ],
            'type' => 'Password',
            'attributes' => [
                'class' => 'form-control'
            ]
        ]);

        $this->add([
            'name' => 'send',
            'type' => 'Submit',
            'attributes' => [
                'value' => 'Login',
                'class' => 'btn btn-sucess'
            ],
        ]);

        $this->setAttribute('action', '/login');
        $this->setAttribute('method', 'post');
    }
}
