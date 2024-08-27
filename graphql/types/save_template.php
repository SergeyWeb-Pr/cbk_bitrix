<?php
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use Lst\Site;

$save_template_answer = new ObjectType([
    'name' => 'SaveTemplate',
    'fields' => [
        'status' => Type::string(),
    ]
]);

$save_template = [
    'type' => $save_template_answer,
    'args' => [
        'name' => Type::string(),
        'json' => Type::string(),
        'id' => Type::int(),
    ],
    'resolve' => function ($rootValue, $args) {

        $element = Site::get_element_by_id(Site::get_iblock_id_by_code('templates'), $args['id']);
        $block_element = new \CIBlockElement;

        if (!empty($element)) {

            $properties = CIBlockElement::GetProperty(Site::get_iblock_id_by_code('templates'), $args['id'], false, ['NAME' => 'LAYOUT_EDITOR']);

            $property = $properties->GetNext();

            $page = [
                'PROPERTY_VALUES' => [
                    $property['ID'] => [
                        'n0' => $args['json']
                    ]
                ]
            ];

            $block_element->Update($args['id'], $page, true, true, true);

        } else {

            $properties = \CIBlockProperty::GetList(false, ['IBLOCK_CODE' => 'templates', 'CODE' => 'LAYOUT_EDITOR']);
            $property = $properties->GetNext();

            $block_element = new \CIBlockElement;

            $page = [
                'NAME' => $args['name'],
                "IBLOCK_ID" => Site::get_iblock_id_by_code('templates'),
                'PROPERTY_VALUES' => [
                    $property['ID'] => [
                        'n0' => $args['json']
                    ]
                ]
            ];

            $status = $block_element->Add($page, true, true, true);
        }

        $response = [
            'status' => 'ok'
        ];

        return $response;
    }
];