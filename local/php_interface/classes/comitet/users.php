<?php
namespace Comitet;

 if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

require_once($_SERVER['DOCUMENT_ROOT'].BX_ROOT.'/modules/main/classes/mysql/user.php');

use Bitrix\Main\Mail\Event,
    Bitrix\Main\Localization\Loc;

Class Users
{

  static $_fields = array(
    'name'                 => array('NAME'),
    'last_name'            => array('LAST_NAME'),
    'email'                => 'EMAIL',
    'phone'                => array('UF_PHONE'),
    'area'                 => 'UF_AREA',
    'login'                => 'LOGIN',
    'lid'                  => "LID",
    'active'               => 'ACTIVE',
    'password'             => array('PASSWORD','CONFIRM_PASSWORD'),
    'vk_id'                => 'UF_VK_ID',
    'photo_url'            => 'UF_PHOTO_URL',
    'fb_id'                => 'UF_FB_ID',
    'user_type'            => 'UF_USER_TYPE',
    'org_name'             => 'UF_ORG_NAME',
    'address'              => 'UF_ORG_ADDRESS',
    'second_name'          => 'UF_ORG_SECOND_NAME',
    'birthday'             => 'UF_BIRTHDAY',
    'bank'                 => 'UF_BANK_NAME',
    'rs'                   => 'UF_ACCOUNT_NUMBER',
    'korrs'                => 'UF_KOR_NUMBER',
    'okpo'                 => 'UF_OKPO',
    'inn'                  => 'UF_INN',
    'kpp'                  => 'UF_KPP',
    'bik'                  => 'UF_BIK',
    'delivery_service'     => 'UF_DELIVERY_ID',
    'delivery_fio'         => 'UF_DELIVERY_FIO',
    'delivery_passport'    => 'UF_DELIVERY_PASSPORT',
    'delivery_postal_code' => 'UF_DELIVERY_ZIP',
    'delivery_address'     => 'UF_DELIVERY_ADDRESS',
    'delivery_phone'       => 'UF_DELIVERY_PHONE',
    'discount'             => 'UF_DISCOUNT',
    'groups'               => 'GROUP_ID',
  );
  
  public static function init_social_user($userProfile,$type)
  {
    
    $profile_field_id = '';
    switch($type)
    {
      case 'Vkontakte':
        $profile_field_id = 'vk_id';
        
        if($user = Users::get_user_by_vk_id($userProfile->identifier))
        {
          global $USER;
          $USER->Authorize($user['ID']);
          Users::update_data($user['ID'],['photo_url' => $userProfile->photoURL]);
          LocalRedirect('/account/');
        }

      break;
      
      case 'Facebook':
      
        $profile_field_id = 'fb_id';
        
        if($user = Users::get_user_by_fb_id($userProfile->identifier))
        {
          global $USER;
          $USER->Authorize($user['ID']);
          Users::update_data($user['ID'],['photo_url' => $userProfile->photoURL]);
          LocalRedirect('/account/');
        }

      break;
    }
    
    
    if($user = Users::get_user_by_email($userProfile->email))
    {
      global $USER;
      $USER->Authorize($user['ID']);
      Users::update_data($user['ID'],[$profile_field_id => $userProfile->identifier,'photo_url' => $userProfile->photoURL]);
      LocalRedirect('/account/');
    }
    
    if(!empty($userProfile->email))
    {
      $new_user_data = [
        'lid' => 's1',
        'active' => 'Y',
        'login' => 'user_'.md5(time().rand(0,9999)),
        'email' => $userProfile->email,
        'password' => randString(7)
      ];
      
      if(!empty($userProfile->birthDay) && !empty($userProfile->birthMonth) && $userProfile->birthYear)
      {
        $date = date('d.m.Y',strtotime($userProfile->birthDay.'.'.$userProfile->birthMonth.'.'.$userProfile->birthYear));
        $new_user_data['birthday'] = $date;
      }
      
      if(!empty($userProfile->firstName))
      {
        $new_user_data['name'] = $userProfile->firstName;
      }
      
      if(!empty($userProfile->photoURL))
      {
        $new_user_data['photo_url'] = $userProfile->photoURL;
      }

      if(!empty($userProfile->lastName))
      {
        $new_user_data['last_name'] = $userProfile->lastName;
      }
      
      if(!empty($userProfile->phone))
      {
        $new_user_data['phone'] = $userProfile->phone;
      }
              
      if(Users::reg_new($new_user_data))
      {
        LocalRedirect('/account/');
      }

    }
  }
  
  public static function ajax_reg_new($args)
  {
    if(self::check_email_in_db($args['email']))
    {
      echo json_encode(array('status'=>'error'));
      return false;
    }
    
    $args['birthday'] = str_replace('/','.',$args['birthday']);
    
    $user_data = $args;
    // $user_data['password'] = randString(7);
    $user_data['login'] = 'user_'.md5(time().rand(0,9999));

    if($user_data['person_type'] == 1)
      $user_data['user_type'] = 4;
    if($user_data['person_type'] == 2)
      $user_data['user_type'] = 5;

    $user_data['lid'] = 's1';
    $user_data['active'] = 'Y';

    $user = self::reg_new($user_data);

    if($user)
      echo json_encode(array('status'=>'ok'));
    else
      echo json_encode(array('status'=>'error'));
    die();
  }


  public static function reg_new($args)
  {
    if(!empty($args))
    {
      $user = new \CUser;

      $final_args = array();

      foreach(self::$_fields as $u_field => $b_field)
      {
        if(!empty($args[$u_field]))
        {
          if(is_array($b_field))
          {
            foreach($b_field as $sub_b_field)
            {
                $final_args[$sub_b_field] = $args[$u_field];
            }
          }
          else
            $final_args[$b_field] = $args[$u_field];

        }
      }


      $id = $user->add($final_args);

      if(!empty($id))
      {
        $event_send = Event::send(array(
          "EVENT_NAME" => "USER_INFO",
          "LID" => $args['lid'],
          "C_FIELDS" => array(
            'SERVER_NAME'  => $_SERVER['HTTP_HOST'],
            'SITE_NAME'    => $_SERVER['HTTP_HOST'],
            'USER_ID'      => $id,
            'NAME'         => $final_args['NAME'],
            'LAST_NAME'    => $final_args['LAST_NAME'],
            'EMAIL'        => $final_args['EMAIL'],
            'LOGIN'        => $final_args['LOGIN'],
            'PASSWORD'     => $final_args['PASSWORD'],
            ),
            )
        );

        global $USER;
        $USER->Authorize($id);

        // if($USER->isAuthorized())
        // {
        //
        //   // \CUser::SendUserInfo($USER->GetID(), $args['lid'], Loc::getMessage('INFO_REQ'), true);
        // }
        return $id;
      }
      else
        return false;
    }

    return false;
  }

  public static function check_email_in_db($email)
  {
    require_once($_SERVER['DOCUMENT_ROOT'].BX_ROOT.'/modules/main/classes/mysql/user.php');
    $filter = array("EMAIL" => $email);
    $users = \CUser::GetList(($by="personal_country"), ($order="desc"), $filter);
    $user = $users->GetNext();
    if(!empty($user))
      return true;
    else
      return false;
  }
  
  public static function get_user_by_vk_id($vk_id)
  {
    $filter = array("UF_VK_ID" => $vk_id);
    $by="personal_country";
    $order="desc";
    $users = \CUser::GetList($by,$order,$filter,array('SELECT'=>array('UF_*')));
    $user = $users->GetNext();
    if(!empty($user))
      return $user;
    else
      return false;
  }

  public static function get_user_by_fb_id($fb_id)
  {
    $filter = array("UF_FB_ID" => $fb_id);
    $by="personal_country";
    $order="desc";
    $users = \CUser::GetList($by,$order,$filter,array('SELECT'=>array('UF_*')));
    $user = $users->GetNext();
    if(!empty($user))
      return $user;
    else
      return false;
  }

  public static function get_user_by_email($email)
  {
      $filter = array("EMAIL" => $email);
      $by="personal_country";
      $order="desc";
      $users = \CUser::GetList($by,$order,$filter,array('SELECT'=>array('UF_*')));
      $user = $users->GetNext();
      if(!empty($user))
        return $user;
      else
        return false;
  }
  
  public static function get_user_by_login($login)
  {
      $filter = array("LOGIN" => $login);
      $by="personal_country";
      $order="desc";
      $users = \CUser::GetList($by,$order,$filter,array('SELECT'=>array('UF_*')));
      $user = $users->GetNext();
      if(!empty($user))
        return $user;
      else
        return false;
  }

  public static function get_user_data()
  {
    global $USER;

    if(!self::is_auth())
      return false;

    $filter = array("ID" => $USER->getID());
    $by="personal_country";
    $order="desc";
    $users = \CUser::GetList($by,$order,$filter,array('SELECT'=>array('UF_*')));
    $user = $users->GetNext();

    $user_fields = array();

    foreach(self::$_fields as $ext_field => $inner_field)
    {
      if($ext_field == 'groups')
      {
        $user_groups = \CUser::GetUserGroup($USER->getID());
        $user_fields[$ext_field] = $user_groups;
      }
      else
      {
        if(is_array($inner_field))
        {
          foreach($inner_field as $inner_sub_field)
          {
            $user_fields[$ext_field] = $user[$inner_sub_field];
          }
        }
        else
        {
          if(!empty($user[$inner_field]))
          {
              $user_fields[$ext_field] = $user[$inner_field];
          }
        }
      }
    }

    return $user_fields;
  }

  public static function auth_by_email($email,$password)
  {
    require_once($_SERVER['DOCUMENT_ROOT'].BX_ROOT.'/modules/main/classes/mysql/user.php');
    $filter = array("EMAIL" => $email);
    $users = \CUser::GetList(($by="personal_country"), ($order="desc"), $filter);
    $user = $users->GetNext();

    $salt = substr($user['PASSWORD'], 0, (strlen($user['PASSWORD']) - 32));

    $realPassword = substr($user['PASSWORD'], -32);
    $password = md5($salt.$password);

    if( $password === $realPassword)
    {
      global $USER;
      $USER->Authorize($user['ID']);
      return true;
    }
    else
    {
      return false;
    }
  }

  public static function update_data($user_id,$fields)
  {
    
    $updated_fields = array();

    foreach(self::$_fields as $ext_field => $inner_field)
    {
      if(!empty($fields[$ext_field]))
      {
        if(is_array($inner_field))
        {
          foreach($inner_field as $inner_sub_field)
          {
            $updated_fields[$inner_sub_field] = $fields[$ext_field];
          }
        }
        else
        {
          $updated_fields[$inner_field] = $fields[$ext_field];
        }
      }
    }

    $user_groups = \CUser::GetUserGroup($user_id);

    if($fields['subscribe'] == '1')
    {
      $updated_fields['GROUP_ID'] = $user_groups;
      $updated_fields['GROUP_ID'][] = 9;
    }
    else
    {
      $subscribe_group = array_search(9,$user_groups);
      if(!$subscribe_group === false)
        unset($user_groups[$subscribe_group]);
      $updated_fields['GROUP_ID'] = $user_groups;
    }

    $user = new \CUser;
    
    $user->Update($user_id,$updated_fields);
            
    if(!empty($fields['new_password']) && !empty($fields['new_password_repeat']) && ($fields['new_password'] == $fields['new_password_repeat']) && strlen($fields['new_password'])>=5)
    {
      $checkword = self::gen_checkword($user_id);      
      $return = $user->ChangePassword($user->getLogin(), $checkword, $fields['new_password'], $fields['new_password_repeat']);      
    }
    
    if(!empty($user->LAST_ERROR))
      return false;
    else
      return true;

  }
  
  public static function gen_checkword($user_id)
  {
    global $DB;

    $salt = randString(8, array(
      "abcdefghijklnmopqrstuvwxyz",
      "ABCDEFGHIJKLNMOPQRSTUVWXYZ",
      "0123456789",
      // ",.<>/?;:[]{}\\|~!@#\$%^&*()-_+=",
    ));

    $checkword = md5(\CMain::GetServerUniqID().uniqid());
    $checkword_to_db = $salt.md5($salt.$checkword);

    $strSql = 'UPDATE b_user SET CHECKWORD="'.$checkword_to_db.'" WHERE ID='.$user_id;
    
    $DB->Query($strSql);
    
    return $checkword;
  }

  public static function get_current_id()
  {
    global $USER;
    if(self::is_auth())
      return $USER->getID();
    else
      return false;
  }

  public static function is_auth()
  {
    global $USER;
    if($USER->IsAuthorized())
      return true;
    else
      return false;
  }



}
