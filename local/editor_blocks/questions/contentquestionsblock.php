<?php

namespace LayoutEditor\Blocks;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

class ContentQuestionsBlock extends Component
{
    protected static $type = 'component';
    protected static $tab_name = 'Часто задаваемые вопросы';
    protected static $label = 'Блок Контент';

    public static function get_fields()
    {
        $arFields = [
            [
                'type' => 'text',
                'settings' => [
                    'name' => 'title',
                    'label' => 'Заголвовок',
                    'group' => 'Вопросы',
                ],
            ],
            [
                'type' => 'group',
                'settings' => [
                    'label' => 'Вопросы',
                    'group' => 'Вопросы',
                    'name' => 'questions_items',
                    'fields' => [
                        [
                            'type' => 'text',
                            'settings' => [
                                'name' => 'question_name',
                                'label' => 'Вопрос',
                            ],
                        ],
                        [
                            'type' => 'wysiwyg',
                            'settings' => [
                                'name' => 'question_text',
                                'label' => 'Ответ',
                            ],
                        ],
                    ],
                ],
            ],


        ];

        return $arFields;
    }

    public function render()
    {
        if (!empty($this->args)) {
            extract($this->args);
        }

        global $APPLICATION;

        $fields = self::prepare_fields($fields);
        extract($fields);

        $block_classes = $this->custom_css_class;

        ?>

        <div <?php if (!empty($fields['block_id'])): ?> id="<?php echo $fields['block_id']; ?>" <?php endif; ?>
            class="relative <?php echo $block_classes; ?>">

            <section class="questions">
                <? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "breadcrumbs", array(
                    "PATH" => "",    // Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
                    "SITE_ID" => "s1",    // Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
                    "START_FROM" => "0",    // Номер пункта, начиная с которого будет построена навигационная цепочка
                ),
                    false
                ); ?>

                <div class="container questions__container">
                    <div class="questions__inner">
                        <?php if (!empty($title)): ?>
                            <h1 class="questions__title h1"><?php echo $title; ?></h1>
                        <?php endif; ?>
                        <div class="accordion">
                            <?php foreach ($questions_items as $arItem): ?>
                                <?php
                                $question_name = '';
                                $question_text = '';
                                if (!empty($arItem['question_name'])):
                                    $question_name = $arItem['question_name'];
                                endif;
                                if (!empty($arItem['question_text'])):
                                    $question_text = $arItem['question_text'];
                                endif;
                                ?><?php if (!empty($question_name)): ?>
                                    <div class="accordion__item">

                                        <h6 class="accordion__header h6"><?php echo $question_name; ?></h6>

                                        <?php if (!empty($question_text)): ?>
                                            <div class="accordion__body">
                                                <div class="accordion__content"><?php echo $question_text; ?></div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </section>

        </div>
        <?php
    }
}
