<?php

namespace LayoutEditor\Blocks;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

use Lst\Site;

class ContentVacanciesBlock extends Component
{
    protected static $type = 'component';
    protected static $tab_name = 'Вакансии';
    protected static $label = 'Блок Вакансии';

    public static function get_fields()
    {
        $vacancies = Site::convert_to_select_params(Site::get_elements_by_iblock_id(Site::get_iblock_id_by_code('vacancies')));
        $arFields = [

            [
                'type' => 'text',
                'settings' => [
                    'name' => 'title',
                    'label' => 'Заголовок',
                    'group' => 'Вакансии',
                ],
            ],
            [
                'type' => 'group',
                'settings' => [
                    'label' => 'Вакансии',
                    'group' => 'Вакансии',
                    'name' => 'vacancies',
                    'fields' => [
                        [
                            'type' => 'select',
                            'settings' => [
                                'name' => 'vacancy_id',
                                'label' => 'Вакансия',
                                'params' => $vacancies
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

            <section class="vacancies">
                <? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "breadcrumbs", array(
                    "PATH" => "",    // Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
                    "SITE_ID" => "s1",    // Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
                    "START_FROM" => "0",    // Номер пункта, начиная с которого будет построена навигационная цепочка
                ),
                    false
                ); ?>

                <div class="container">
                    <?php if (!empty($title)): ?>
                        <h1 class="vacancies__title h1"><?php echo $title; ?></h1>
                    <?php endif; ?>
                    <div class="vacancies__items">
                        <?php foreach ($vacancies as $vacancy): ?>
                            <?php
                            $employee = Site::get_element_by_id(Site::get_iblock_id_by_code('vacancies'), $vacancy['vacancy_id']);
                            $employee_name = $employee['NAME'];
                            if (!empty($employee['PROPERTIES']['VACANCIES_TEXT']['~VALUE']['TEXT'])) {
                                $employee_text = $employee['PROPERTIES']['VACANCIES_TEXT']['~VALUE']['TEXT'];
                            }
                            ?>

                            <div class="vacancies__item">
                                <div class="vacancies__item-content">
                                    <?php if (!empty($employee_name)): ?>
                                        <a href="#" class="vacancies__item-name js-vacancies-item-name h6"><?php echo $employee_name; ?></a>
                                    <?php endif; ?>
                                    <?php if (!empty($employee_text)): ?>
                                        <div class="vacancies__item-descr"><?php echo $employee_text; ?></div>
                                    <?php endif; ?>
                                </div>
                                <button class="btn-reset button-doc vacancies__item-button js-vacancies-item-button" data-graph-path="modal2">
                                    Откликнуться
                                </button>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>

        </div>
        <?php
    }
}
