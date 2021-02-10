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

$cssCardStyles = array(
    "services_icon_1" => "card-service--with-icon-1",
    "services_icon_2" => "card-service--with-icon-2",
    "services_icon_3" => "card-service--with-icon-3",
    "services_icon_4" => "card-service--with-icon-4",
);
$arSections = $arResult["ITEMS"];
?>
<div class="home__services-controlls-block">
    <div class="grid-2column--revert">
        <div class="grid__column">
            <h2 class="home__services-title">
                Услуги и сервисы
            </h2>
        </div>
        <div class="grid__column">
            <div class="page-switch__wrapper">
                <div class="page-switch">
                    <? foreach ( $arSections as $key => $ar_Value): ?>

                        <div class="page-switch__option-button" data-tab-name="<?echo $ar_Value["ID"]?>">
                            <div class="page-switch__option <? if ($key == 0): ?>page-switch__option--active<? endif; ?>">
                                <div class="page-switch__option-text">
                                    <?echo $ar_Value["NAME"]?>
                                </div>
                                <div class="page-switch__option-line"></div>
                            </div>
                        </div>
                    <? endforeach; ?>
                    <a href="/uslugi/munitsipalnye-i-gosudarstvennye-uslugi/elektronnye-uslugi-i-servisy"
                       class="page-switch__option-button">
                        <div class="page-switch__option">
                            <div class="page-switch__option-text">
                                Все услуги
                            </div>
                            <div class="page-switch__option-line"></div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="menu-structure-wrapper home-services-tabs--mobile">
                <button
                        class="base-button-transparent--middle base-button--with-icon menu-structure-button menu-structure-button--active">
                    <div class="base-button__text">Услуги и сервисы</div>
                    <div class="base-button__icon">
                        <div class="base-icon-block">
                            <div class="base-icon-block menu-structure__main-link-arrow">
                                <? $APPLICATION->IncludeFile("/includes/svg/main_link_icon.html") ?>
                            </div>
                        </div>
                    </div>
                </button>

                <div class="menu-structure page-switch_option-contollers" style="display: none;">
                    <? foreach ( $arSections as $key => $ar_Value): ?>
                    <div class="menu-structure__section section page-switch__option-button" data-tab-name="<?echo $ar_Value["ID"]?>">
                        <div class="menu-structure__main-link-block page-switch__option">
                            <div class="menu-structure__main-link">
                                <?echo $ar_Value["NAME"]?>
                            </div>
                        </div>
                    </div>
                    <? endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    
</div>

<div class="home__services-list-block">


        <?foreach ( $arSections as  $ar_Value ):?>
            <? if (count($ar_Value["ELEMENTS"]) > 0):?>
                <div class="page-switch__content-block <?echo $ar_Value["ID"] ?>_tab">
                    <div class="grid-3column">
                    <?foreach ($ar_Value["ELEMENTS"] as $arElement):?>
                    <div class="grid__column">
                        <a href="<?echo $arElement["PROPERTIES"]["PRIORITY_LINK"]["VALUE"]?>" target="_blank" class="card-service <?echo $cssCardStyles[$arElement["PROPERTIES"]["PRIORITY_PICTURE"]["~VALUE"]];?>">
                            <div class="card-service__text">
                                <div class="card-service__title">
                                    <?echo $arElement["NAME"]?>
                                </div>

                                <div class="card-service__addition">
                                    <? echo $arElement["PROPERTIES"]["ADDITIONAL_TEXT"]["VALUE"] ?>
                                </div>

                            </div>
                            <div class="card-service__icons">
                                <div class="card-service__icon">
                                    <?echo $arElement["PROPERTIES"]["PRIORITY_PICTURE"]["VALUE"]["UF_SVG_CODE"]?>
                                </div>
                                <div class="card-service__link-icon">
                                    <? $APPLICATION->IncludeFile("/includes/svg/link_icon.html") ?>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?endforeach;?>
                </div>
            </div>
            <?endif;?>
        <?endforeach;?>

        <div class="mfc-banner card-service grid-home-news">
            <div class="mfc-banner__image-wrapper">
                <img src="../assets/images/development/mfc_logo.png" />
                <div class="mfc-banner__line"></div>
            </div>
            <div class="mfc-banner__description">
                Все услуги по принципу «одного окна» в ближайшем МФЦ
                <div class="mfc-banner__button-wrapper--table">
                    <a href="http://www.mfc-yurga.ru/" target="_blank" rel="noopener" class="base-button-transparent--middle mfc-banner__link">
                        Записаться в МФЦ
                    </a>
                </div>
            </div>
            <div class="mfc-banner__button-wrapper">
                <a href="http://www.mfc-yurga.ru/" target="_blank" rel="noopener" class="base-button-transparent--middle mfc-banner__link">
                    Записаться в МФЦ
                </a>
            </div>
        </div>


</div>

