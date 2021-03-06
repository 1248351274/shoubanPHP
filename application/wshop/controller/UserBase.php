<?php
namespace app\wshop\controller;
use think\Controller;
use think\Session;
use think\Db;
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept,Authorization,loginID");
class UserBase extends Controller
{
    public $flag;
    public $login_id;
    public $token;
    public function __construct()
    {
        parent::__construct();
        $a = array_change_key_case(getallheaders(),CASE_UPPER);
        if(isset($a['AUTHORIZATION'])){
            $this->token = $a['AUTHORIZATION'];
            $this->login_id = $a['LOGINID'];
        }
        $token = Db::table('user')->where('User_Id',$this->login_id)->value('User_Status');
        if($token && $token!='0'){
            if($token == $this->token){
                $this->flag = '1';
                Session::set('login_id',$this->login_id);
            }else{
                $this->flag = '2';
                Session::delete('login_id');
                header('HTTP/1.1 401 Unauthorized'); 
				header('status:401'); 
            }
        }else{
            $this->flag = '3';
        }
    }
    public function getallheaders(){
		
		foreach ($_SERVER as $name => $value){
            if (substr($name, 0, 5) == 'HTTP_'){
                $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
            }
        }
        return $headers;
	}
}
