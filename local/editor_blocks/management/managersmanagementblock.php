<?php

namespace LayoutEditor\Blocks;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

use Lst\Site;

class ManagersManagementBlock extends Component
{
    protected static $type = 'component';
    protected static $tab_name = 'Руководство компании';
    protected static $label = 'Блок Руководители';

    public static function get_fields()
    {
        $managers = Site::convert_to_select_params(Site::get_elements_by_iblock_id(Site::get_iblock_id_by_code('managers')));
        $arFields = [

            [
                'type' => 'group',
                'settings' => [
                    'label' => 'Руководители',
                    'group' => 'Руководители',
                    'name' => 'managers',
                    'fields' => [
                        [
                            'type' => 'select',
                            'settings' => [
                                'name' => 'managers_id',
                                'label' => 'Руководитель',
                                'params' => $managers
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
            <?php foreach ($managers as $manager): ?>
                <section class="section-color management-gallery">
                    <div class="container management-gallery__items">
                        <?php foreach ($managers as $manager): ?>
                            <?php
                            $employee = Site::get_element_by_id(Site::get_iblock_id_by_code('managers'), $manager['managers_id']);
                            $employee_name = $employee['NAME'];
                            $employee_position = $employee['PROPERTIES']['POSITION']['VALUE'];
                            $employee_image = \CFile::GetPath($employee['PROPERTIES']['IMAGE']['VALUE']);
                            ?>
                            <div class="management-gallery__item">
                                <div class="management-gallery__item-image">
                                    <?php if (!empty($employee_image)): ?>
                                        <img loading="lazy" src="<?php echo $employee_image; ?>" class="image" width="" height="" alt="">
                                    <?php else: ?>
                                        <img loading="lazy" src="<?= SITE_TEMPLATE_PATH ?>/assets/img/png/collaborators/stub.png"
                                            class="image" width="" height="" alt="">
                                    <?php endif; ?>
                                </div>
                                <div class="management-gallery__item-content">
                                    <?php if (!empty($employee_name)): ?>
                                        <div class="management-gallery__item-name">
                                            <?php echo $employee_name; ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (!empty($employee_position)): ?>
                                        <div class="management-gallery__item-post">
                                            <?php echo $employee_position; ?>
                                        </div>
                                    <?php endif; ?>

                                </div>
                            </div>
                        <?php endforeach; ?>
                        <!-- <button class="btn-reset management-gallery__button"><span>Скрыть всех руководителей</span></button>-->
                    </div>
                </section>
            <?php endforeach; ?>
        </div>
        <?php
    }
}
