<?php
/**
 * @author Cristiano Azevedo <cristianoazevedo@vivaweb.net>
 * @copyright 2005-2016 Vivaweb Internet LTDA
 * @version 1.0
 * @see http://www.vivaintra.com
 *
 * Date: 07/07/2016
 * Time: 19:14
 */

namespace Application\Model;


use Zend\InputFilter\InputFilter;

class Login
{
    public $name;
    public $password;

    public function getInputFilter()
    {
        $inputFilter = new InputFilter();
        $inputFilter->add(array(
            'name' => 'name',
            'required' => true,
            'filters' => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array(
                    'name' => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'min' => 1,
                        'max' => 255,
                    ),
                ),
            ),
        ));
        $inputFilter->add(array(
            'name' => 'password',
            'required' => true,
            'filters' => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array(
                    'name' => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'min' => 1,
                        'max' => 100,
                    ),
                ),
            ),
        ));
        return $inputFilter;
    }
}