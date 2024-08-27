<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
IncludeTemplateLangFile(__FILE__);
?>
</main>
<div class="block_shadow"></div>
<div class="graph-modal">
    <div class="graph-modal__container" role="dialog" aria-modal="true" data-graph-target="modal1">
        <button class="btn-reset js-modal-close graph-modal__close" aria-label="Закрыть модальное окно"></button>
        <div class="graph-modal__content text">
            Сайт находится в стадии разработки. <br>Выбранный раздел временно не доступен
        </div>
    </div>

    <div class="graph-modal__container modal-container1" role="dialog" aria-modal="true" data-graph-target="modal2">
        <button class="btn-reset js-modal-close graph-modal__close" aria-label="Закрыть модальное окно"></button>
        <div class="graph-modal__content">
            <? $APPLICATION->IncludeComponent(
                "cbk:main.feedback",
                "vacancies-form",
                array(
                    "EMAIL_TO" => "greben.sergey1@gmail.com",    // E-mail, на который будет отправлено письмо
                    "EVENT_MESSAGE_ID" => array("16"),
                    "OK_TEXT" => "Спасибо, ваше сообщение принято.",    // Сообщение, выводимое пользователю после отправки
                    "REQUIRED_FIELDS" => array(    // Обязательные поля для заполнения
                        0 => "",
                    ),
                    "USE_CAPTCHA" => "N",    // Использовать защиту от автоматических сообщений (CAPTCHA) для неавторизованных пользователей
                ),
                false
            ); ?>
        </div>
    </div>
    <div class="graph-modal__container modal-container1" role="dialog" aria-modal="true" data-graph-target="modal3">
        <button class="btn-reset js-modal-close graph-modal__close" aria-label="Закрыть модальное окно"></button>
        <div class="graph-modal__content">
            <? $APPLICATION->IncludeComponent(
	"cbk:main.feedback", 
	"provision-form", 
	array(
        "AJAX_MODE" => "Y",
        "AJAX_OPTION_STYLE" => "Y",
		"EMAIL_TO" => "greben.sergey1@gmail.com",
		"EVENT_MESSAGE_ID" => array(
			0 => "15",
		),
		"OK_TEXT" => "Спасибо, ваше сообщение принято.",
		"REQUIRED_FIELDS" => array(
			0 => "NAME",
			1 => "PHONE",
			2 => "EMAIL",
		),
		"USE_CAPTCHA" => "N",
		"COMPONENT_TEMPLATE" => "provision-form"
	),
	false
); ?>
        </div>
    </div>
    <div class="graph-modal__container modal-container1" role="dialog" aria-modal="true" data-graph-target="modal4">
        <button class="btn-reset js-modal-close graph-modal__close" aria-label="Закрыть модальное окно"></button>
        <div class="graph-modal__content">
            <? $APPLICATION->IncludeComponent(
                "cbk:main.feedback",
                "materials-form",
                array(
                    "AJAX_MODE" => "Y",
                    "AJAX_OPTION_STYLE" => "Y",
                    "EMAIL_TO" => "greben.sergey1@gmail.com",    // E-mail, на который будет отправлено письмо
                    "EVENT_MESSAGE_ID" => array("14"),
                    "OK_TEXT" => "Спасибо, ваше сообщение принято.",    // Сообщение, выводимое пользователю после отправки
                    "REQUIRED_FIELDS" => array(    // Обязательные поля для заполнения
                        0 => "NAME",
                        1 => "PHONE",
                        2 => "EMAIL",
                    ),
                    "USE_CAPTCHA" => "N",    // Использовать защиту от автоматических сообщений (CAPTCHA) для неавторизованных пользователей
                ),
                false
            ); ?>
        </div>
    </div>
    <div class="graph-modal__container modal-container2" role="dialog" aria-modal="true" data-graph-target="modal5">
        <button class="btn-reset js-modal-close graph-modal__close" aria-label="Закрыть модальное окно"></button>
        <div class="graph-modal__content modal-content">
            <div class="modal-content__image">
                <img loading="lazy" src="<?= SITE_TEMPLATE_PATH ?>/assets/img/jpg/image/image70.jpg" class="image"
                     width="" height="" alt="">
            </div>
            <div class="modal-content__content content">
                <p>В компании разработана <a href="#">система должной добросовестности</a>, в которой указано,
                    как мы контролируем происхождение
                    древесины.</p>
                <p>Мы выезжаем к поставщикам, проводим аудиты, проверяем легальность заготовки, соответствие необходимым
                    требованиям и правилам, соблюдение экологических требований, консультируемся с представителями
                    местных
                    сообществ.</p>
            </div>
        </div>
    </div>
    <div class="graph-modal__container modal-container2" role="dialog" aria-modal="true" data-graph-target="modal6">
        <button class="btn-reset js-modal-close graph-modal__close" aria-label="Закрыть модальное окно"></button>
        <div class="graph-modal__content modal-content">
            <div class="modal-content__image">
                <img loading="lazy" src="<?= SITE_TEMPLATE_PATH ?>/assets/img/jpg/image/image71.jpg" class="image"
                     width="" height="" alt="">
            </div>
            <div class="modal-content__content content">
                <p>Для качественного лесовосстановления нужно сделать все возможное, чтобы высаженный сеянец превратился
                    в здоровое
                    молодое дерево.</p>
                <p>Поэтому мы тщательно ухаживаем за молодняком на протяжении всего цикла его роста, проводим выборочные
                    рубки
                    ухода — часть ослабленных деревьев, которые мешают расти другим деревьям, убираем. При этом
                    образуется
                    сырьё
                    для ЦБК, и остаётся красивый ухоженный лес, в котором приятно отдыхать, собирать грибы и ягоды.</p>
            </div>
        </div>
    </div>
    <div class="graph-modal__container modal-container2" role="dialog" aria-modal="true" data-graph-target="modal7">
        <button class="btn-reset js-modal-close graph-modal__close" aria-label="Закрыть модальное окно"></button>
        <div class="graph-modal__content modal-content">
            <div class="modal-content__image">
                <img loading="lazy" src="<?= SITE_TEMPLATE_PATH ?>/assets/img/jpg/image/image72.jpg" class="image"
                     width="" height="" alt="">
            </div>
            <div class="modal-content__content content">
                <p>Наша компания регулярно проводит уборку мусора на территории своих лесных аренд и ликвидирует
                    незаконные
                    свалки,
                    образовавшиеся рядом с населёнными пунктами. Поэтому наши леса чистые и ухоженные, похожи на парки.
                    И в них
                    так приятно проводить время.</p>
                <p>А чтобы уберечь лес и его посетителей от пожаров, мы проводим регулярные патрулирования территории,
                    создаём
                    пожарные водоёмы и противопожарные (минеральные) полосы.</p>
            </div>
        </div>
    </div>
    <div class="graph-modal__container modal-container2" role="dialog" aria-modal="true" data-graph-target="modal8">
        <button class="btn-reset js-modal-close graph-modal__close" aria-label="Закрыть модальное окно"></button>
        <div class="graph-modal__content modal-content">
            <div class="modal-content__slider">
                <div class="swiper swiper-style modal-content__swiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide modal-content__slide">
                            <div class="modal-content__slide-image">
                                <img loading="lazy" src="<?= SITE_TEMPLATE_PATH ?>/assets/img/jpg/image/image72.jpg"
                                     class="image" width="" height="" alt="">
                            </div>
                        </div>
                        <div class="swiper-slide modal-content__slide">
                            <div class="modal-content__slide-image">
                                <img loading="lazy" src="<?= SITE_TEMPLATE_PATH ?>/assets/img/jpg/image/image72.jpg"
                                     class="image" width="" height="" alt="">
                            </div>
                        </div>
                        <div class="swiper-slide modal-content__slide">
                            <div class="modal-content__slide-image">
                                <img loading="lazy" src="<?= SITE_TEMPLATE_PATH ?>/assets/img/jpg/image/image72.jpg"
                                     class="image" width="" height="" alt="">
                            </div>
                        </div>
                        <div class="swiper-slide modal-content__slide">
                            <div class="modal-content__slide-image">
                                <img loading="lazy" src="<?= SITE_TEMPLATE_PATH ?>/assets/img/jpg/image/image72.jpg"
                                     class="image" width="" height="" alt="">
                            </div>
                        </div>
                        <div class="swiper-slide modal-content__slide">
                            <div class="modal-content__slide-image">
                                <img loading="lazy" src="<?= SITE_TEMPLATE_PATH ?>/assets/img/jpg/image/image73.jpg"
                                     class="image" width="" height="" alt="">
                            </div>
                        </div>
                        <div class="swiper-slide modal-content__slide">
                            <div class="modal-content__slide-image">
                                <img loading="lazy" src="<?= SITE_TEMPLATE_PATH ?>/assets/img/jpg/image/image72.jpg"
                                     class="image" width="" height="" alt="">
                            </div>
                        </div>
                        <div class="swiper-slide modal-content__slide">
                            <div class="modal-content__slide-image">
                                <img loading="lazy" src="<?= SITE_TEMPLATE_PATH ?>/assets/img/jpg/image/image74.jpg"
                                     class="image" width="" height="" alt="">
                            </div>
                        </div>
                        <div class="swiper-slide modal-content__slide">
                            <div class="modal-content__slide-image">
                                <img loading="lazy" src="<?= SITE_TEMPLATE_PATH ?>/assets/img/jpg/image/image75.jpg"
                                     class="image" width="" height="" alt="">
                            </div>
                        </div>
                        <div class="swiper-slide modal-content__slide">
                            <div class="modal-content__slide-image">
                                <img loading="lazy" src="<?= SITE_TEMPLATE_PATH ?>/assets/img/jpg/image/image72.jpg"
                                     class="image" width="" height="" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper swiper-style modal-content__swiper-thumbs">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide modal-content__slide">
                            <div class="modal-content__slide-image">
                                <img loading="lazy" src="<?= SITE_TEMPLATE_PATH ?>/assets/img/jpg/image/image72.jpg"
                                     class="image" width="" height="" alt="">
                            </div>
                        </div>
                        <div class="swiper-slide modal-content__slide">
                            <div class="modal-content__slide-image">
                                <img loading="lazy" src="<?= SITE_TEMPLATE_PATH ?>/assets/img/jpg/image/image72.jpg"
                                     class="image" width="" height="" alt="">
                            </div>
                        </div>
                        <div class="swiper-slide modal-content__slide">
                            <div class="modal-content__slide-image">
                                <img loading="lazy" src="<?= SITE_TEMPLATE_PATH ?>/assets/img/jpg/image/image72.jpg"
                                     class="image" width="" height="" alt="">
                            </div>
                        </div>
                        <div class="swiper-slide modal-content__slide">
                            <div class="modal-content__slide-image">
                                <img loading="lazy" src="<?= SITE_TEMPLATE_PATH ?>/assets/img/jpg/image/image72.jpg"
                                     class="image" width="" height="" alt="">
                            </div>
                        </div>
                        <div class="swiper-slide modal-content__slide">
                            <div class="modal-content__slide-image">
                                <img loading="lazy" src="<?= SITE_TEMPLATE_PATH ?>/assets/img/jpg/image/image73.jpg"
                                     class="image" width="" height="" alt="">
                            </div>
                        </div>
                        <div class="swiper-slide modal-content__slide">
                            <div class="modal-content__slide-image">
                                <img loading="lazy" src="<?= SITE_TEMPLATE_PATH ?>/assets/img/jpg/image/image72.jpg"
                                     class="image" width="" height="" alt="">
                            </div>
                        </div>
                        <div class="swiper-slide modal-content__slide">
                            <div class="modal-content__slide-image">
                                <img loading="lazy" src="<?= SITE_TEMPLATE_PATH ?>/assets/img/jpg/image/image74.jpg"
                                     class="image" width="" height="" alt="">
                            </div>
                        </div>
                        <div class="swiper-slide modal-content__slide">
                            <div class="modal-content__slide-image">
                                <img loading="lazy" src="<?= SITE_TEMPLATE_PATH ?>/assets/img/jpg/image/image75.jpg"
                                     class="image" width="" height="" alt="">
                            </div>
                        </div>
                        <div class="swiper-slide modal-content__slide">
                            <div class="modal-content__slide-image">
                                <img loading="lazy" src="<?= SITE_TEMPLATE_PATH ?>/assets/img/jpg/image/image72.jpg"
                                     class="image" width="" height="" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="swiper-style__bottom">
                        <div class="swiper-button-prev modal-content__swiper-button-prev"></div>
                        <div class="swiper-pagination modal-content__swiper-pagination"></div>
                        <div class="swiper-button-next modal-content__swiper-button-next"></div>
                    </div>
                </div>
            </div>
            <div class="modal-content__content content">
                <p>Проявляя заботу о пернатых, ежегодно устанавливаем кормушки, скворечники и гнездовья для птиц.
                    На территории
                    наших лесных аренд можно увидеть таких редких птиц, как дупель или серый журавль, встретить не менее
                    редкие растения — «настоящий башмачок Венеры» или «угловатый лук».</p>
            </div>
        </div>
    </div>
    <div class="graph-modal__container modal-container3" role="dialog" aria-modal="true" data-graph-target="modal9">
        <button class="btn-reset js-modal-close graph-modal__close" aria-label="Закрыть модальное окно"></button>
        <div class="graph-modal__content modal-content">
            <div class="modal-content__content content">
                <p>Мы получили сертификат «Лесной эталон», который подтверждает, что при заготовке древесины не только
                    соблюдается лесное законодательство, но и выполняются дополнительные экологические и социальные
                    требования
                </p>
            </div>
            <div class="modal-content__cert">
                <div class="modal-content__cert-image">
                    <img loading="lazy" src="<?= SITE_TEMPLATE_PATH ?>/assets/img/png/certificates/cert1.png"
                         class="image" width="" height="" alt="">
                </div>
                <div class="modal-content__cert-name">
                    Сертификат «Лесной эталон»
                </div>
            </div>
        </div>
    </div>
    <div class="graph-modal__container modal-container2" role="dialog" aria-modal="true"
         data-graph-target="modal-image-full">
        <button class="btn-reset js-modal-close graph-modal__close" aria-label="Закрыть модальное окно"></button>
        <div class="graph-modal__content modal-content modal-image-full">
            <div class="modal-content__image">
                <img loading="lazy" src="<?= SITE_TEMPLATE_PATH ?>/assets/img/jpg/image/image70.jpg"
                     id="js-history-image" class="image" width="" height="" alt="">
            </div>
        </div>
    </div>
    <div class="graph-modal__container modal-search" role="dialog" aria-modal="true" data-graph-target="modal-search">
        <button class="btn-reset js-modal-close graph-modal__close" aria-label="Закрыть модальное окно"></button>
        <div class="search__block">
            <div class="search__block-name">Поисковый запрос</div>
            <form action="/search/" method="get" class="form form-search">
                <label class="form__label">
                    <input type="text" name="q" value="<?= $arResult["REQUEST"]["QUERY"] ?>"
                           class="input-reset form__input" placeholder="Поиск">
                </label>
                <input class="btn-reset btn form__btn" type="submit" value="Поиск"/>
                <input type="hidden" name="how" value="<? echo $arResult["REQUEST"]["HOW"] == "d" ? "d" : "r" ?>"/>
            </form>
        </div>
    </div>
    <div class="graph-modal__container modal-search" role="dialog" aria-modal="true" data-graph-target="modal-video">
        <button class="btn-reset js-modal-close graph-modal__close" aria-label="Закрыть модальное окно"></button>
        <div class="modal-video">
            <iframe id="modal-video" width="560" height="315"
                    src=""
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen>
            </iframe>
        </div>
    </div>

    <div class="graph-modal__container modal-search-container" role="dialog" aria-modal="true" data-graph-target="modal-sales">
        <button class="btn-reset js-modal-close graph-modal__close" aria-label="Закрыть модальное окно"></button>
        <div class="modal-sales">
            <? $APPLICATION->IncludeComponent(
                "cbk:main.feedback",
                "sales-form",
                array(
                    "EMAIL_TO" => "greben.sergey1@mail.ru",
                    "EVENT_MESSAGE_ID" => array("18"),
                    "OK_TEXT" => "Спасибо, ваше сообщение принято.",
                    "REQUIRED_FIELDS" => array(
                        0 => "",
                    ),
                    "USE_CAPTCHA" => "N",                        ),
                false
            ); ?>
        </div>
    </div>
</div>

<no-typography>
    <footer class="footer">
        <div class="container">
            <div class="footer__menu">
                <div class="footer__row">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:menu",
                        "company-menu",
                        array(
                            "ALLOW_MULTI_SELECT" => "N",
                            "CHILD_MENU_TYPE" => "",
                            "DELAY" => "N",
                            "MAX_LEVEL" => "1",
                            "MENU_CACHE_GET_VARS" => array(),
                            "MENU_CACHE_TIME" => "3600",
                            "MENU_CACHE_TYPE" => "N",
                            "MENU_CACHE_USE_GROUPS" => "N",
                            "ROOT_MENU_TYPE" => "company",
                            "USE_EXT" => "N",
                            "COMPONENT_TEMPLATE" => "company-menu"
                        ),
                        false
                    ); ?>
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:menu",
                        "development-menu",
                        array(
                            "ALLOW_MULTI_SELECT" => "N",
                            "CHILD_MENU_TYPE" => "",
                            "DELAY" => "N",
                            "MAX_LEVEL" => "1",
                            "MENU_CACHE_GET_VARS" => array(),
                            "MENU_CACHE_TIME" => "3600",
                            "MENU_CACHE_TYPE" => "N",
                            "MENU_CACHE_USE_GROUPS" => "N",
                            "ROOT_MENU_TYPE" => "development",
                            "USE_EXT" => "N",
                            "COMPONENT_TEMPLATE" => "development-menu"
                        ),
                        false
                    ); ?>
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:menu",
                        "products-menu",
                        array(
                            "ALLOW_MULTI_SELECT" => "N",
                            "CHILD_MENU_TYPE" => "",
                            "DELAY" => "N",
                            "MAX_LEVEL" => "1",
                            "MENU_CACHE_GET_VARS" => array(),
                            "MENU_CACHE_TIME" => "3600",
                            "MENU_CACHE_TYPE" => "N",
                            "MENU_CACHE_USE_GROUPS" => "N",
                            "ROOT_MENU_TYPE" => "products",
                            "USE_EXT" => "N",
                            "COMPONENT_TEMPLATE" => "products-menu"
                        ),
                        false
                    ); ?>
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:menu",
                        "career-menu",
                        array(
                            "ALLOW_MULTI_SELECT" => "N",
                            "CHILD_MENU_TYPE" => "",
                            "DELAY" => "N",
                            "MAX_LEVEL" => "1",
                            "MENU_CACHE_GET_VARS" => array(),
                            "MENU_CACHE_TIME" => "3600",
                            "MENU_CACHE_TYPE" => "N",
                            "MENU_CACHE_USE_GROUPS" => "N",
                            "ROOT_MENU_TYPE" => "career",
                            "USE_EXT" => "N",
                            "COMPONENT_TEMPLATE" => "career-menu"
                        ),
                        false
                    ); ?>
                </div>
                <div class="footer__row">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:menu",
                        "news-menu",
                        array(
                            "ALLOW_MULTI_SELECT" => "N",
                            "CHILD_MENU_TYPE" => "",
                            "DELAY" => "N",
                            "MAX_LEVEL" => "1",
                            "MENU_CACHE_GET_VARS" => array(),
                            "MENU_CACHE_TIME" => "3600",
                            "MENU_CACHE_TYPE" => "N",
                            "MENU_CACHE_USE_GROUPS" => "N",
                            "ROOT_MENU_TYPE" => "news",
                            "USE_EXT" => "N",
                            "COMPONENT_TEMPLATE" => "news-menu"
                        ),
                        false
                    ); ?>
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:menu",
                        "suppliers-menu",
                        array(
                            "ALLOW_MULTI_SELECT" => "N",
                            "CHILD_MENU_TYPE" => "",
                            "DELAY" => "N",
                            "MAX_LEVEL" => "1",
                            "MENU_CACHE_GET_VARS" => array(),
                            "MENU_CACHE_TIME" => "3600",
                            "MENU_CACHE_TYPE" => "N",
                            "MENU_CACHE_USE_GROUPS" => "N",
                            "ROOT_MENU_TYPE" => "suppliers",
                            "USE_EXT" => "N",
                            "COMPONENT_TEMPLATE" => "suppliers-menu"
                        ),
                        false
                    ); ?>
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:menu",
                        "support-menu",
                        array(
                            "ALLOW_MULTI_SELECT" => "N",
                            "CHILD_MENU_TYPE" => "",
                            "DELAY" => "N",
                            "MAX_LEVEL" => "1",
                            "MENU_CACHE_GET_VARS" => array(),
                            "MENU_CACHE_TIME" => "3600",
                            "MENU_CACHE_TYPE" => "N",
                            "MENU_CACHE_USE_GROUPS" => "N",
                            "ROOT_MENU_TYPE" => "support",
                            "USE_EXT" => "N",
                            "COMPONENT_TEMPLATE" => "support-menu"
                        ),
                        false
                    ); ?>
                    <div class="footer__column footer__column-mob-show">
                        <a href="/policy/" class="footer__name">Политика конфиденциальности</a>
                    </div>
                    <div class="footer__column footer__column-mob-show">
                        <a href="/fraud/" class="footer__name">Противодействие мошенничеству</a>
                    </div>
                    <div class="footer__column">
                        <div class="tel social-link">
                            <div class="social-link__icon">
                                <img loading="lazy" src="<?= SITE_TEMPLATE_PATH ?>/assets/img/svg/tel.svg" class="image"
                                     width="" height="" alt="">
                            </div>
                            <a href="tel:+7 812 334-57-30">+7 (812) 334-57-30</a>
                        </div>
                        <div class="mail social-link">
                            <div class="social-link__icon">
                                <img loading="lazy" src="<?= SITE_TEMPLATE_PATH ?>/assets/img/svg/mail.svg"
                                     class="image" width="" height="" alt="">
                            </div>
                            <a href="mailto:otvet@svetopaper.com">otvet@svetopaper.com</a>
                        </div>
                        <div class="social">
                            <a href="https://vk.com/svetocbk" class="social__item" target="_blank">
                                <img loading="lazy" src="<?= SITE_TEMPLATE_PATH ?>/assets/img/svg/vk.svg" class="image"
                                     width="" height="" alt="">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer__bottom">
                <div class="footer__copy">© 2024 НПАО «Светогорский ЦБК»</div>
            </div>
        </div>
    </footer>
</no-typography>

<div class="pattern">
    <img loading="lazy" src="<?= SITE_TEMPLATE_PATH ?>/assets/img/png/pattern.png" class="image" width="" height=""
         alt="">
</div>
<?php if (empty($_COOKIE['messages-cookies'])): ?>
    <div class="messages-cookies">
        <div class="container">
            <div class="messages-cookies__content">
                <div class="messages-cookies__info">
                    Мы используем cookie-файлы для улучшения предоставляемых услуг. Продолжая навигацию по сайту,
                    вы соглашаетесь <a href="/policy/">с правилами использования cookie-файлов</a>
                </div>
                <button class="btn-reset button-doc messages-cookies__button">Принять</button>
            </div>
        </div>
    </div>
<?php endif; ?>
</div>
</body>

</html>