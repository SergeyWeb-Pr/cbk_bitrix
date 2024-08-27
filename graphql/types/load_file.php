<?php
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use GraphQL\Upload\UploadType;
use Psr\Http\Message\UploadedFileInterface;

$load_file_answer = new ObjectType([
    'name' => 'LoadFile',
    'fields' => [
        'file_type' => Type::string(),
        'file_name' => Type::string(),
        'file_path' => Type::string(),
        'file_id' => Type::int(),
        'error' => Type::string()
    ]
]);

$load_file = [
    'type' => $load_file_answer,
    'args' => [
        'id' => Type::int(),
    ],
    'resolve' => function ($rootValue, $args) {

        $file = CFile::GetByID($args['id']);
        $file = $file->GetNext();

        if ($file['height'] > 100) {
            $arResized = CFile::ResizeImageGet($file, ['width' => 500], BX_RESIZE_IMAGE_PROPORTIONAL, false);
            $thumb_path = $arResized['src'];
        } else {
            $thumb_path = CFile::GetPath($args['id']);
        }

        if (!empty($file) && !empty($thumb_path)) {
            $response = [
                'file_path' => $thumb_path,
                'file_type' => $file['CONTENT_TYPE'],
                'file_name' => $file['ORIGINAL_NAME'],
                'file_id' => $args['id']
            ];
        } else {
            $response = [
                'error' => 'Произошла ошибка при загрузке файла!'
            ];
        }
    
        return $response;
    }
];
