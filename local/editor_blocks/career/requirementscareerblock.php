<?php

namespace LayoutEditor\Blocks;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

class RequirementsCareerBlock extends Component
{
    protected static $type = 'component';
    protected static $tab_name = 'Карьера';
    protected static $label = 'Блок Требования';

    public static function get_fields()
    {
        $arFields = [
            [
                'type' => 'text',
                'settings' => [
                    'name' => 'title',
                    'label' => 'Заголовок',
                    'group' => 'Требования',
                ],
            ],
            [
                'type' => 'wysiwyg',
                'settings' => [
                    'name' => 'text',
                    'label' => 'Текст',
                    'group' => 'Требования',
                ],
            ],
            [
                'type' => 'file',
                'settings' => [
                    'name' => 'image',
                    'label' => 'Изображение',
                    'group' => 'Требования',
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

            <section class="section-color backgr-circle career-job">
                <div class="container">
                    <div class="career-job__inner">
                        <div class="career-job__content">
                            <?php if (!empty($title)): ?>
                                <h2 class="career-job__content-title h2"><?php echo $title; ?></h2>
                            <?php endif; ?>
                            <?php if (!empty($text)): ?>
                                <div class="career-job__content-text content"><?php echo $text; ?></div>
                            <?php endif; ?>
                        </div>
                        <?php $image = \CFile::GetPath($image); ?>
                        <?php if (!empty($image)): ?>
                            <div class="career-job__image">
                                <img loading="lazy" src="<?php echo $image; ?>"
                                     class="image" width="" height="" alt="">
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </section>

        </div>
        <?php
    }
}
