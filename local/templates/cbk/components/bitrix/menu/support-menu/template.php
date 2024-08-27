<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<?php if (!empty($arResult)) { ?>
    <div class="footer__column">
        <ul class="list-reset footer__list">
            <?php foreach ($arResult as $item) : ?>
                <li class="footer__item"><a href="<?= $item['LINK'] ?>" class="footer__link"><?= $item['TEXT'] ?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php } ?>



