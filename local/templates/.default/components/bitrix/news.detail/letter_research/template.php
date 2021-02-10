<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
$popup_query = parse_url($_SERVER["REQUEST_URI"])["query"];
?>
<div class="static-page letter-research-page">
    <!--<div class="static-page__mask"></div> Используется на всплывахе, подсвечивает поля-->
    <? if ($popup_query == "ajax_load_page=true") : ?>
        <div class="static-page__mask"></div>
    <? else: ?>
        <a class="static-page__mask" href="/lichnyy-kabinet"></a>
    <? endif; ?>
    <div class="container static-page__wrapper">
        <div class="static-page__content-wrapper">
            <div class="static-page-block__wrapper">
                <? if ($popup_query == "ajax_load_page=true") : ?>
                    <button class="button-close-block base-icon-block js-button-close-block">
                        <?$APPLICATION->IncludeFile("/includes/svg/close_icon.html")?>
                    </button>
                <? else: ?>
                    <a class="button-close-block base-icon-block js-button-close-block" href="/lichnyy-kabinet">
                        <?$APPLICATION->IncludeFile("/includes/svg/close_icon.html")?>
                    </a>
                <? endif; ?>
                <div class="static-page__head">
                    <div class="static-page__container static-content">
                        <div class="static-page__top-label tag-text">Обращение от <?echo CIBlockFormatProperties::DateFormat("j F Y", MakeTimeStamp($arResult["DATE_CREATE"], CSite::GetDateFormat()));?></div>
                        <h1><?=$arResult["DISPLAY_PROPERTIES"]["FORM_TEXT_30"]["DISPLAY_VALUE"];?></h1>
                        <div class="letter-research__letter-text">
                            <?=$arResult["DISPLAY_PROPERTIES"]["FORM_TEXTAREA_28"]["DISPLAY_VALUE"];?>
                        </div>
                    </div>
                </div>
                <?foreach ($arResult["ANSWER"] as $key => $arAnswer): ?>
                    <div class="static-page__container letter-research__container">
                        <div class="treatment__status-block letter-research__treatment">
                            <div class="treatment__status-icon">
                            </div>

                            <div class="treatment__status-text-block">
                                <div class="treatment-item__status-text">
                                    <?=$arAnswer["NAME"]?>
                                </div>

                                <div class="treatment__status-date">
                                    <?echo CIBlockFormatProperties::DateFormat("j F Y", MakeTimeStamp($arAnswer["DATE_CREATE"], CSite::GetDateFormat()));?>
                                </div>
                            </div>
                        </div>

                        <div class="letter-research__reply-text">
                            <?=$arAnswer["PREVIEW_TEXT"]?>
                        </div>

                        <!-- Информация об авторе отвечающего  -->
                        <div class="card-person-post">
                            <div class="card-person-post__title">
                                <?=$arAnswer["ADMINISTRATION"]["POSITION"]["VALUE"]?>
                            </div>

                            <div class="card-person-post__content">
                                <div class="card-person-post__person">
                                    <div class="card-person-post__person-image">
                                        <img src="<?=$arAnswer["ADMINISTRATION"]["IMG"]["SRC"]?>">
                                    </div>

                                    <div class="card-person-post__person-name-block">
                                        <div class="card-person-post__person-first-name">
                                            <?=$arAnswer["ADMINISTRATION"]["SECOND_NAME"]["VALUE"]?>
                                        </div>

                                        <div class="card-person-post__person-last-name">
                                            <?=$arAnswer["ADMINISTRATION"]["FIRST_NAME"]["VALUE"]?> <?=$arProps["PATRO_NAME"]["VALUE"]?>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-person-post__contacts">
                                    <div class="card-person-post__phone">
                                        <?=$arAnswer["ADMINISTRATION"]["PHONE"]["VALUE"]?>
                                    </div>

                                    <div class="card-person-post__address">
                                        <?=$arAnswer["ADMINISTRATION"]["ADDRESS"]["VALUE"]?>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- Информация об авторе отвечающего  -->
                    </div>
                <?endforeach;?>
            </div>
            <div class="static-page-block__wrapper">
                <div class="static-page__content-actions">
                    <div class="static-page__container static-page-links__list">
                        <div class="static-page__icon-links">
                            <div class="static-page__link">
                                <a href="#" class="link-with-icon">
                                    <div class="base-icon-block-content">
                                        <?$APPLICATION->IncludeFile("/includes/svg/share_icon.html")?>
                                    </div>
                                    <div class="link-with-icon__text">
                                        Поделиться
                                    </div>
                                </a>
                            </div>
                        </div>

                        <div class="static-page__link last">
                            <a href="" class="link-base-text">
                                Написать новое обращение
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>