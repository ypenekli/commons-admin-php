<?php
namespace com\yp\admin\model;

include_once CORE_PACKAGE_ROOT . '/core/FnParam.php';
include_once CORE_PACKAGE_ROOT . '/db/DbHandler.php';
include_once CORE_PACKAGE_ROOT . '/db/Result.php';

use com\yp\db\DbHandler;
use com\yp\tools\Configuration;
use com\yp\db\Pager;
use com\yp\db\Result;
use com\yp\core\FnParam;
use com\yp\admin\data\User;
use com\yp\admin\data\LoginHistory;

class UserModel extends DbHandler
{

    public function __construct()
    {
        parent::__construct();
        $filename = SITE_ROOT . '/Queries.properties';
        $this->queries = Configuration::getConfig($filename);
    }

    public function findUsersByName(string $queryName, array $params)
    {
        $findParams = array();        
        $findParams[] = new FnParam("type", User::class);
        $findParams[] =  $params[1];
        $queryName1 = 'Q_USERS7';
        if (count($params) > 2) {
            $param = $param = $params[2];            
            if ($param->value != "") {
                $findParams[] = $param;
                $findParams[] = $param;
                $queryName1 = 'Q_USERS6';
            }
        }      
        return $this->findBy($queryName1, $findParams);
    }


    public function login(string $pQueryName, Array $params)
    {
       // $type = $params[0];
        $email = $params[1];
        $email->value = strtolower($email->value);
        $pwd = $params[2];
        $app = $params[3];
        $remaddress = $params[4];
        
        $now = (new \DateTime())->format('YmdHisv');
        $result = new Result();
        
        $findParams = array(
            new FnParam('type', User::class),
            new FnParam('pager', new Pager()),
            $email
        );
        
        $user = $this->findOne('Q_USERS3', $findParams);        
        if ($user != null) {           
            $loginhistory = null;
            $errorCount = 0;
            $result->setData($user);
            if ($user->get("password") == $pwd->value) {
                $result->setSuccess(true);
                if ($app->value != null) {
                    $loginhistory = new LoginHistory(- 1);
                    $loginhistory->set("app_id", $app->value);
                    $loginhistory->set("user_id", $user->get("id"));
                    $loginhistory->set("login_datetime", $now);
                    $loginhistory->set("client_name", $email->value);
                    $loginhistory->set("client_ip", $remaddress->value);
                    $loginhistory->set("client_datetime", $now);
                }               
                $result->setSuccess(true);
                $result->setMessage('Giriş basarılı');
            } else {
                $errorCount = $user->get("login_error_count") + 1;
                $result->setSuccess(false);
                $result->setErrorcode(10002);
                $result->setMessage('Hatalı parola, parolanızı ' . $errorCount . ' kez hatalı girdiniz');
            }
            $user->accept();
            $user->set("login_error_count", $errorCount);
            $user->set("last_client_name", $email->value);
            $user->set("last_client_ip", $remaddress->value);
            $user->set("last_client_datetime", $now);
            
            $saveParams = array(
                new FnParam("data", $user),
                new FnParam("data", $loginhistory)
            );  
            $this->saveAtomic('saveAtomic', $saveParams);  
        } else {
            $user = new User(- 1);
            $user->set('eposta', $email->value);
            $result->setData($user);
            $result->setErrorcode(10001);
            $result->setMessage('Hatalı kullancı');
        }
        return $result;
    }

}

