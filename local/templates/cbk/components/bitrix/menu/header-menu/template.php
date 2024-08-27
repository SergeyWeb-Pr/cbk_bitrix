<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<?php if (!empty($arResult)) { ?>
    <div class="header__menu" data-menu>
        <nav class="nav" title="">
            <ul class="list-reset nav__list">
                <?php foreach ($arResult as $item) : ?>
                    <?php if ($item["SELECTED"]) : ?>
                        <li class="nav__item"><a href="<?= $item['LINK'] ?>"
                                                 class="nav__link active"><?= $item['TEXT'] ?></a></li>
                    <?php else : ?>
                        <li class="nav__item"><a href="<?= $item['LINK'] ?>" class="nav__link"><?= $item['TEXT'] ?></a>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </nav>
    </div>
<?php } ?>




