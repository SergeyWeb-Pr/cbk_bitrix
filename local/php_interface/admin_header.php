<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
?>

<?php if (preg_match('/iblock_element_edit.php/', $_SERVER['REQUEST_URI'])): ?>


    <script src="https://cloud.tinymce.com/5/tinymce.min.js?apiKey=tda1n55chgov39fbo9roo2r15h42w8yf0guwpglfznu4c5jl"></script>
    <script crossorigin src="https://unpkg.com/react@16/umd/react.production.min.js"></script>
    <script crossorigin src="/local/editor/assets/js/react.production.min.js"></script>
    <script src="/local/editor/assets/js/app.js"></script>
    <link href="/local/editor/assets/css/bootstrap-grid.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="/local/templates/gsz/assets/css/admin.css" rel="stylesheet" type="text/css" />

    <?php
    $fields = \LayoutEditor\Editor::instance()->get_fields();
    $components = \LayoutEditor\Editor::instance()->get_components();
    // unset($components['Row']);
    ?>

    <?php if ($_GET['IBLOCK_ID'] == 106): ?>
        <script>
            <?php

            $new_components = [];
            foreach ($components as $name => $settings) {
                if ($name == 'Menu') {
                    $new_components[$name] = $settings;
                }
            }

            ?>

            pce.components.enabled = <?php echo json_encode($new_components, JSON_UNESCAPED_UNICODE); ?>;

            pce.fields.enabled = <?php echo json_encode($fields); ?>;

            pce.urls.graphql = '/graphql/';

        </script>

    <?php else: ?>
        <script>
            <?php
                unset($components['Menu']);
            ?>
            pce.components.enabled = <?php echo json_encode($components, JSON_UNESCAPED_UNICODE); ?>;

            pce.fields.enabled = <?php echo json_encode($fields); ?>;

            pce.urls.graphql = '/graphql/';

        </script>
    <?php endif; ?>

<?php endif; ?>