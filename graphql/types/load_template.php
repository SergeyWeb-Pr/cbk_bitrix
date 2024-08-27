<?php
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use Lst\Site;

$load_template_answer = Type::listOf(new ObjectType([
    'name' => 'LoadTemplate',
    'fields' => [
        'name' => Type::string(),
        'id' => Type::int(),
        'json' => Type::string()
    ]
]));

$load_template = [
    'type' => $load_template_answer,
    'args' => [
        'name' => Type::string(),
    ],
    'resolve' => function ($rootValue, $args) {

        global $DB;

        $strSql = 'SELECT * FROM b_iblock_element WHERE NAME LIKE "%' . $args['name'] . '%" AND IBLOCK_ID = ' . Site::get_iblock_id_by_code('templates');

        $err_mess = '';
        
        $templates = $DB->Query($strSql, false, $err_mess);

        $response = [];

        while ($element = $templates->Fetch()) {
            $element_tmp = Site::get_element_by_id(Site::get_iblock_id_by_code('templates'), $element['ID']);
            $response[] = [
                "name" => $element['NAME'],
                'id' => $element['ID'],
                'json' => html_entity_decode($element_tmp['PROPERTIES']['LAYOUT_EDITOR']['VALUE'])
            ];
        }
    
        return $response;
    }
];