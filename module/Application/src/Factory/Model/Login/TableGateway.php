<?php

namespace Application\Factory\Model\Login;

use Interop\Container\ContainerInterface;
use Zend\Db\Adapter\Adapter as ZendAdapter;

class TableGateway
{
    public function __invoke(ContainerInterface $container)
    {
        $adapter = $container->get('Application\Factory\Db\Adapter\Adapter');

        return new \Zend\Db\TableGateway\TableGateway('login', $adapter);
    }
}
