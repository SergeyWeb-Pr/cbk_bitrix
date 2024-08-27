<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<?php if (!empty($arResult)) { ?>
    <section class="menu-section">
        <div class="head-container">
            <nav class="menu" title="">
                <div class="menu__title js-menu-button">
                    <!-- выводится текущее название страницы -->
                    <div class="menu__title-name">Устойчивое развитие</div>
                    <button class="btn-reset menu__title-button"></button>
                </div>
                <ul class="list-reset menu__list js-menu-list">
                    <?php $count = count($arResult); ?>
                    <?php foreach ($arResult as $key => $item) : ?>
                        <?php if ($item["SELECTED"]) : ?>
                            <li class="menu__item">
                                <a href="<?= $item['LINK'] ?>" class="menu__link active"><?= $item['TEXT'] ?></a>
                            </li>
                        <?php else : ?>
                            <li class="menu__item">
                                <a href="<?= $item['LINK'] ?>" class="menu__link"><?= $item['TEXT'] ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if ($key < $count - 1) : ?>
                            <div class="menu__separator"></div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            </nav>
        </div>
    </section>
<?php } ?>