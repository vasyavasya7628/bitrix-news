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
<div class="grid-column static-content">
    <h1><?echo $arResult["NAME"];?></h1>

    <?if (strlen($arResult["PREVIEW_TEXT"]) > 0):?>
        <div class="static-page__lid-text--big"><?echo $arResult["PREVIEW_TEXT"];?></div>
    <?endif;?>

    <?echo $arResult["DETAIL_TEXT"];?>
</div>