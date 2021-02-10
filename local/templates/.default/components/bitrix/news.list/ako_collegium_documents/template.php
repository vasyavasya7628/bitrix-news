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
<?//var_dump($arResult["ITEMS"][0]);?>
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>

<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

    $arFile = $arItem["DISPLAY_PROPERTIES"]["COLLEGIUM_DOCUMENTS_FILE"]["FILE_VALUE"];
	$downloadFileLink = $arFile["SRC"];
	$docFormat = explode(".", $arFile["ORIGINAL_NAME"]);
	/* функция из ini.php */
    $fileValue = getFileSize($arFile["FILE_SIZE"]);
	?>

    <a id="<? echo $this->GetEditAreaId($arItem['ID']);?>" href="<? echo $downloadFileLink;?>" class="document-preview" target="_blank">
        <div class="document-preview__link">
            <div class="base-icon-block-content">
                <?$APPLICATION->IncludeFile("/includes/svg/download_file_icon_big.html")?>
            </div>
            <div class="document-preview__link-text"><?echo $arItem["NAME"]?></div>
        </div>
        <div class="link-download__file-weight">
            <?echo strtoupper(end($docFormat)) . ", " . $fileValue;?>
        </div>
    </a>

<?endforeach;?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>