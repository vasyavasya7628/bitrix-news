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
?>
<a href="<?=$arResult["DISPLAY_PROPERTIES"]["LINK"]["VALUE"]?>" class="banner banner-births home-news__important-news--mobile banner--green">
    <div class="banner__text--left">
        <?=$arResult["DISPLAY_PROPERTIES"]["NAME"]["VALUE"]?>
    </div>
    <!--    <div class="banner__text--right">-->
    <!--        25.03-->
    <!--    </div>-->
    <!--                <div class="banner__icon">-->
    <!--									--><?//$APPLICATION->IncludeFile("/includes/svg/75_min.html")?>
    <!--                </div>-->
</a>