<?php
namespace Application\Service;

use Zend\Authentication\AuthenticationService;

class Auth
{
    private $request;
    private $adapter;

    public function __construct($request, $adapter)
    {
        $this->request = $request;
        $this->adapter = $adapter;
    }

    public function isAuthorized()
    {
        $auth = new AuthenticationService();
        
        if ($auth->hasIdentity()) {
            return true;
        }

        return false;
    }

}
