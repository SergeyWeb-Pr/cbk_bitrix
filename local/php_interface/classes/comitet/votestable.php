<?php
namespace Comitet;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) { die();
}


use Bitrix\Main\Loader;
use Bitrix\Main;
use Bitrix\Main\Application;
use Bitrix\Main\Entity;

use Comitet\Users;
use Lst\Site;
Loader::includeModule('iblock');


Class VotesTable extends Entity\DataManager
{
    protected $_tableName = 'votes';
    protected static $_instance = null;


    protected $_fieldsMap = [
        'ID' => array(
            'data_type' => 'integer',
            'primary' => true,
            'autocomplete' => true,
        ),
        'UF_USER_ID' => array(
          'data_type' => 'integer',
          'required' => true,
          'save' => true,
          'content' => 'ID пользователя',
        ),
        'UF_OBJECT_ID' => array(
          'data_type' => 'integer',
          'required' => true,
          'save' => true,
          'content' => 'ID объекта',
        ),
        'UF_VOTE' => array(
          'data_type' => 'integer',
          'required' => true,
          'save' => true,
          'content' => 'Голос',
        ),
    ];
    
    final public static function getMap()
    {
        $instance = static::getInstance();
        $fieldsMap = $instance->_fieldsMap;
        return $fieldsMap;
    }
    
    final public static function getTableName()
    {
        $instance = static::getInstance();
        return $instance->_tableName;
    }


    final public static function getInstance()
    {
        if (!static::$_instance) {
            static::$_instance = new static();
        }
        return static::$_instance;
    }
    

    public function add_vote($object_id,$user_id,$vote)
    {
      $result = $this->add(['UF_USER_ID'=>$user_id,'UF_OBJECT_ID'=>$object_id,'UF_VOTE'=>$vote]);
      if($result)
      {
        $object = Site::get_element_by_id(OBJECTS_IBLOCK_ID,$object_id);
        $object = $object[0];

        if($vote == 1)
        {
          $votes_for = (int) $object['PROPERTIES']['VOTES_COUNT_FOR']['VALUE'];
          $votes_for++;
          \CIBlockElement::SetPropertyValues($object_id,OBJECTS_IBLOCK_ID,$votes_for,'VOTES_COUNT_FOR');
        }
        
        if($vote == 2)
        {
          $votes_againts = (int) $object['PROPERTIES']['VOTES_COUNT_AGAINST']['VALUE'];
          $votes_againts++;
          \CIBlockElement::SetPropertyValues($object_id, OBJECTS_IBLOCK_ID, $votes_againts,'VOTES_COUNT_AGAINST');
        }
        
        $obCache = new \CPHPCache();
        $obCache->CleanDir();

        return true;
      }
      else
      {
        return false;
      }
    }
    
    public function check_user_area()
    {
      $user_data = Users::get_user_data();
      if(empty($user_data['area']))
        return false;
      else
        return true;
    }
    
    public function check_user_birthday()
    {
      $user_data = Users::get_user_data();
      if(empty($user_data['birthday']))
        return false;
      else
        return true;
    }
    
    public function check_user_age()
    {
      $user_data = Users::get_user_data();
      $birthday = $user_data['birthday'];
      $now = time();
      
      $date1 = new \DateTime($birthday);
      $date2 = new \DateTime(date('d.m.Y'));

      $diff = $date2->diff($date1);
      
      if($diff->y>=14)
        return true;
      else
        return false;
    }    
    
    public function check_user_vote($object_id,$user_id)
    {
      $row = self::getRow(array(
          'select' => array('ID'),
          'filter' => array('UF_OBJECT_ID' => $object_id, 'UF_USER_ID' => $user_id),
      ));
      
      if(!empty($row))
        return true;
      else
        return false;
    }
    
    
}