<?php
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use GraphQL\Upload\UploadType;
use Psr\Http\Message\UploadedFileInterface;


$send_form_answer = new ObjectType([
    'name' => 'SendFormAnswer',
    'fields' => [
        'status' => Type::string()
    ]
]);

$send_form = [
    'type' => $send_form_answer,
    'args' => [
        'data' => Type::string(),
        'files' =>Type::listOf(new UploadType())
    ],
    'resolve' => function($rootValue, $args) {


        if(!empty($args['data']))
        {
            $_POST = json_decode($args['data'],true);
            $_REQUEST = json_decode($args['data'],true);
        }


        if(!empty($_POST['files']))
        {
            foreach($_POST['files'] as $num => $name)
            {
                if(!empty($_FILES[$num+1]))
                    $_FILES[$name] = $_FILES[$num+1];
            }
        }

        $status = 'error';

        if(!empty($_POST['stop_spam']) && $_POST['stop_spam'] == 'true')
        {
            $_REQUEST['web_form_submit'] = 'true';
            $_REQUEST['web_form_apply'] = 'true';

            include($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");


            if (CModule::IncludeModule("form"))
            {
                // if (check_bitrix_sessid())
                // {
                    if($RESULT_ID = CFormResult::Add($_POST["WEB_FORM_ID"], $_POST))
                    {
                        CFormCRM::onResultAdded($_POST["WEB_FORM_ID"], $RESULT_ID);
						CFormResult::SetEvent($RESULT_ID);
						CFormResult::Mail($RESULT_ID);
                        $status = 'ok';
                    }
                // }
                // else {
                //     $status = 'session_expired';
                // }
            }

        }

        return [
            'status' => $status
        ];
    }
];
