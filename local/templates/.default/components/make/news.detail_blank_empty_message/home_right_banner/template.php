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
<a href="<?=$arResult["DISPLAY_PROPERTIES"]["LINK"]["VALUE"]?>" class="home-news__important-news" style="background: url('<?=$arResult["PREVIEW_PICTURE"]["SRC"]?>') center no-repeat" target="_blank">
    <!-- <div class="home-news__important-news--mask"></div> -->
    <!-- <div class="home-news__important-news-header"><?//=$arResult["DISPLAY_PROPERTIES"]["NAME"]["VALUE"]?></div> -->
</a>