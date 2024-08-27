<?php

namespace LayoutEditor\Blocks;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

class InfoCompanyBlock extends Component
{
    protected static $type = 'component';
    protected static $tab_name = 'О компании';
    protected static $label = 'Блок инфо';

    public static function get_fields()
    {
        $arFields = [

            [
                'type' => 'wysiwyg',
                'settings' => [
                    'name' => 'company_info',
                    'label' => 'Инфо',
                    'group' => 'Инфо',
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
            <section class="company-content">
                <div class="container">
                    <div class="company-content__info content">
                        <?php echo $company_info; ?>
                    </div>
                </div>
            </section>
        </div>
        <?php
    }
}
