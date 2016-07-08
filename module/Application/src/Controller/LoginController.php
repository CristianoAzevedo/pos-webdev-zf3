<?php
/**
 * @author Cristiano Azevedo <cristianoazevedo@vivaweb.net>
 * @copyright 2005-2016 Vivaweb Internet LTDA
 * @version 1.0
 * @see http://www.vivaintra.com
 *
 * Date: 07/07/2016
 * Time: 19:11
 */

namespace Application\Controller;


use Zend\Authentication\Adapter\DbTable\CredentialTreatmentAdapter as AuthAdapter;
use Zend\Authentication\AuthenticationService;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class LoginController extends AbstractActionController
{
    public $tableGateway;

    public function __construct(\Zend\Db\TableGateway\TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function indexAction()
    {
        $form = new \Application\Form\Login();

        $request = $this->getRequest();
        /* se a requisição é post os dados foram enviados via formulário*/
        if ($request->isPost()) {
            $login = new \Application\Model\Login();
            /* configura a validação do formulário com os filtros e validators da entidade*/
            $form->setInputFilter($login->getInputFilter());
            /* preenche o formulário com os dados que o usuário digitou na tela*/
            $form->setData($request->getPost());
            /* faz a validação do formulário*/
            if ($form->isValid()) {
                $data = $request->getPost()->toArray();

                $authAdapter = new AuthAdapter($this->tableGateway->getAdapter());

                $authAdapter
                    ->setTableName('login')
                    ->setIdentityColumn('name')
                    ->setCredentialColumn('password');

                $authAdapter
                    ->setIdentity($data['name'])
                    ->setCredential(md5($data['password']));

                $auth = new AuthenticationService();

                $result = $auth->authenticate($authAdapter);

                if ($result->isValid()) {
                    $user = $authAdapter->getIdentity();
                    $auth->getStorage()->clear();
                    $auth->getStorage()->write($user);

                    return $this->redirect()->toRoute('beer');
                }

                return $this->redirect()->toRoute('login');
            }
        }

        $view = new ViewModel();
        $view->setVariable('form', $form);

        return $view;
    }

    public function logoutAction()
    {
        $auth = new AuthenticationService();

        if ($auth->hasIdentity()) {
            $auth->getStorage()->clear();

            return $this->redirect()->toRoute('login');
        }

        return $this->redirect()->toRoute('home');


    }
}