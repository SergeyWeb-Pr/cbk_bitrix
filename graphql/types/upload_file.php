<?php
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use GraphQL\Upload\UploadType;
use Psr\Http\Message\UploadedFileInterface;

$upload_file_answer = new ObjectType([
    'name' => 'UploadFile',
    'fields' => [
        'file_id' => Type::int(),
        'file_type' => Type::string(),
        'file_name' => Type::string(),
        'file_path' => Type::string(),
        'error' => Type::string()
    ]
]);


$upload_file = [
    'type' => $upload_file_answer,
    'args' => [
        'file' => new UploadType(['name' => 'upload_file'])
    ],
    'resolve' => function ($rootValue, $args) {

        global $DB;

        $strSql = 'SELECT * FROM b_medialib_collection';

        $err_mess = '';

        $res = $DB->Query($strSql, false, $err_mess);

        $params = [
            'file' => $_FILES[1],
            'path' => false,
            'arFields' => [
                'ID' => 0,
                'NAME' => $_FILES[1]['name'],
                'DESCRIPTION' => $_FILES[1]['name'],
                'KEYWORDS' => '',
            ],
        ];

        
        $result = $res->GetNext();

        if (!empty($result['ID'])) {
            $params['arCollections'][] = $result['ID'];
        }

        $files = CMedialibItem::Edit($params);

        if (!empty($files)) {
            $response = [
                'file_path' => $files['SRC'],
                'file_type' => $files['CONTENT_TYPE'],
                'file_name' => $files['ORIGINAL_NAME'],
                'file_id' => $files['SOURCE_ID']
            ];
        } else {
            $response = [
                'error' => 'Произошла ошибка при загрузке файла!'
            ];
        }


        return $response;
    }
];
