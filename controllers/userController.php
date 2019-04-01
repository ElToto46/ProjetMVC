<?php
class userController {
    function loginAction(){
        $login= filter_input(INPUT_POST , 'login',FILTER_SANITIZE_EMAIL);
        $password = filter_input(INPUT_POST, 'password' , FILTER_SANITIZE_SPECIAL_CHARS);
        
        
        $objUser = new user();
        $objUser->setLogin($login);
        $objUser->setPassword($password);
       
        $resultCheck = $this->checkAction($objUser);
        if($resultCheck){
            $oBdd = new dbController();
            $user = $oBdd->findOneBy(
            $objUser,
                array(
                    'champs'=> array(
                        'id',
                    ),
                    'criteria'=> array(
                        'login'=> $objUser->getLogin(),
                    )
                ));

            $_SESSION['msgStyle'] = 'success';
            $_SESSION['msgTxt'] = 'Vous êtes connecté';
            $_SESSION['connected']= true;
            $_SESSION['userid']= $user['id'];
            return array ('view'=>'willkommen');
        }
    }
    function createAction(){
                   
        $user = new user();
        $oBdd = new dbController();

        $userPost = array(
                    'login' => FILTER_SANITIZE_EMAIL,
                    'password' => FILTER_SANITIZE_ENCODED
        );
        $userTab = filter_input_array(INPUT_POST, $userPost);
        $userTab['password'] = password_hash($userTab['password'],PASSWORD_BCRYPT);
        
        $id = $oBdd->newRecord($user,$userTab);
        
            if($id === 0) {
                $_SESSION['msgStyle'] = 'danger';
                $_SESSION['msgText'] = 'Erreur lors de la création de l\'utilisateur';
                return 0;
            }
            $_SESSION['msgStyle'] = 'Success';
                $_SESSION['msgText'] = 'Compte correctement créé';
        return $id;
    }


    //test les paramètres de connexion de l'user
    function checkAction(user $user){
      $oBdd = new dbController();
 //       $tabUser = $oBdd->findOneById($user , 1);
        $tabUser = $oBdd->findOneBy(
                $user,
                array(
                    'champs'=>array('password'),
                    //'login'
                            'criteria'=>array(
                                    'login'=>$user->getLogin(),
                                    //'password'=>$user->getPassword(),
                    ))
                );
        if(empty($tabUser)){
        return false;}
        return (password_verify($user->getPassword(),$tabUser['password']))?true:false;
        }

    function logoutAction(){
        $_SESSION['connected']=false;
        session_destroy();
        return null;
    }
    function editAction(){
        $oBdd = new dbController();
        $user = new user();
        $oBdd->findObjectById($user,$_SESSION['userid']);
       return array('view'=>'edituser','user'=>$user );
        }
}
