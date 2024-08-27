<?php

namespace LayoutEditor\Blocks;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

class TopContactsBlock extends Component
{
    protected static $type = 'component';
    protected static $tab_name = 'Контакты';
    protected static $label = 'Блок шапка';

    public static function get_fields()
    {
        $arFields = [

            [
                'type' => 'text',
                'settings' => [
                    'name' => 'title',
                    'label' => 'Заголовок',
                    'group' => 'Заголовок',
                ],
            ],
            [
                'type' => 'group',
                'settings' => [
                    'label' => 'Табы',
                    'group' => 'Табы',
                    'name' => 'tabs_links',
                    'fields' => [
                        [
                            'type' => 'text',
                            'settings' => [
                                'name' => 'link',
                                'label' => 'Якорь таба',
                            ],
                        ],
                        [
                            'type' => 'text',
                            'settings' => [
                                'name' => 'name',
                                'label' => 'Название таба',
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

            <section class="contacts-preview">
                <? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "breadcrumbs", array(
                    "PATH" => "",    // Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
                    "SITE_ID" => "s1",    // Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
                    "START_FROM" => "0",    // Номер пункта, начиная с которого будет построена навигационная цепочка
                ),
                    false
                ); ?>

                <div class="container">
                    <div class="contacts-preview__content">
                        <h1 class="contacts-preview__title h1">Контактная информация</h1>
                        <div class="contacts-preview__anchors">
                            <?php foreach ($tabs_links as $key => $arItem): ?>
                                <a href="#<?= $arItem['link'] ?>"
                                   class="contacts-preview__button button-tab js-button-tab<?= ($key === 0) ? ' active' : '' ?>">
                                    <?= $arItem['name'] ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </section>

        </div>
        <?php
    }
}
