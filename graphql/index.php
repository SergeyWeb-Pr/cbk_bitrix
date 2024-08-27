<?php
$input_request = file_get_contents('php://input');

if (empty($input_request) && !empty($_POST['operations'])) {
    $input_request = $_POST['operations'];
}

if (!empty($input_request)) {
    $input_request = json_decode($input_request, true);
    if (
        !empty($input_request['operationName'])
        &&
        (
            $input_request['operationName'] == 'get_modal_content'
            ||
            $input_request['operationName'] == 'upload_file'
            ||
            $input_request['operationName'] == 'load_file'
            ||
            $input_request['operationName'] == 'save_template'
            ||
            $input_request['operationName'] == 'templates'
            ||
            $input_request['operationName'] == 'objects'
        )
    ) {
        include($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
        require_once('../local/editor/index.php');
        include($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
        require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/fileman/classes/general/medialib.php");
        require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/iblock/prolog.php");
        CModule::IncludeModule("iblock");
        CModule::IncludeModule("fileman");
    }
}


require_once('../local/php_interface/lib/vendor/autoload.php');

require_once('types/load_file.php');
require_once('types/load_template.php');
require_once('types/save_template.php');
require_once('types/send_form.php');
require_once('types/upload_file.php');



use GraphQL\GraphQL;
use GraphQL\Type\Schema;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use GraphQL\Upload\UploadType;
use Psr\Http\Message\UploadedFileInterface;
use GraphQL\Error\DebugFlag;


use GraphQL\Server\StandardServer;
use GraphQL\Upload\UploadMiddleware;
use Laminas\Diactoros\ServerRequestFactory;
use GraphQL\Server\ServerConfig;

$query = new ObjectType([
    'name' => 'Query',
    'fields' => [
        ]
]);

$mutation_methods = [];

if (!empty($GLOBALS["USER"]) && $GLOBALS["USER"]->IsAuthorized() && $GLOBALS["USER"]->IsAdmin()) {
    $mutation_methods = [
        'upload_file' => $upload_file,
        'load_file' => $load_file,
        'send_form' => $send_form,
        'save_template' => $save_template,
        'templates' => $load_template
    ];
} else {
    $mutation_methods = [
        'send_form' => $send_form
    ];
}

$mutation = new ObjectType([
    'name' => 'Mutation',
    'fields' => $mutation_methods
]);


$schema = new Schema([
    'query' => $query,
    'mutation' => $mutation
]);



// $rawInput = file_get_contents('php://input');
// $input = json_decode($rawInput, true);
// $query = $input['query'];
// $variableValues = isset($input['variables']) ? $input['variables'] : null;


try {
    $server_config = ServerConfig::create()
        ->setSchema($schema);
    // ->setContext($myContext);



    // Create request (or get it from a framework)
    $request = ServerRequestFactory::fromGlobals();


    $rawInput = file_get_contents('php://input');

    if (!empty($rawInput)) {
        $input = json_decode($rawInput, true);
    } else {
        $input = $request->getParsedBody();
    }

    $request = $request->withParsedBody($input);

    // Process uploaded files
    $uploadMiddleware = new UploadMiddleware();
    $request = $uploadMiddleware->processRequest($request);


    // Execute request and emits response
    $server = new StandardServer($server_config);
    $result = $server->executePsrRequest($request);
    $server->getHelper()->sendResponse($result);

    // $debug = DebugFlag::INCLUDE_DEBUG_MESSAGE | DebugFlag::INCLUDE_TRACE;

    // $output = $result->toArray($debug);

    // var_dump($output);

    // $debug = DebugFlag::INCLUDE_DEBUG_MESSAGE | DebugFlag::INCLUDE_TRACE;
    //
    // $rootValue = ['prefix' => 'You said: '];
    // $result = GraphQL::executeQuery($schema, $query, $rootValue, null, $variableValues);
    // $output = $result->toArray($debug);
} catch (\Exception $e) {
    $output = [
        'errors' => [
            [
                'message' => $e->getMessage()
            ]
        ]
    ];
}

// header('Content-Type: application/json');
// echo json_encode($output);
