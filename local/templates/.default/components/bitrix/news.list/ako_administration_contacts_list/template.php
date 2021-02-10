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

<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>

    <div class="preview__small preview__small--bold" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
        <h4 class="preview-small__title">
            <?echo $arItem["NAME"]?>
        </h4>

        <?if ($arItem["PREVIEW_TEXT"]):?>
            <div class="preview-small__description">
                <?echo $arItem["PREVIEW_TEXT"];?>
            </div>
        <?endif;?>

        <div class="contact-item">
            <a class="contact-phone" href="">
                <?echo $arItem["DISPLAY_PROPERTIES"]["CONTACT_PHONE"]["DISPLAY_VALUE"];?>
            </a>

            <a class="contact-email" href="mailto:<?echo $arItem["DISPLAY_PROPERTIES"]["CONTACT_EMAIL"]["DISPLAY_VALUE"];?>">
                <?echo $arItem["DISPLAY_PROPERTIES"]["CONTACT_EMAIL"]["DISPLAY_VALUE"];?>
            </a>
        </div>
    </div>

<?endforeach;?>