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
<div class="document-preview--numbered-list open-data__list-links">
    <?foreach($arResult["ITEMS"] as $arItem):?>
        <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

        $documentValue = $arItem["DISPLAY_PROPERTIES"]["OPEN_DATA_SET_DATA_FILE"]["FILE_VALUE"];
        $fileType = explode(".", $documentValue["ORIGINAL_NAME"]);
        ?>
        <div class="document-preview" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
            <a class="document-preview__title" href="<?echo $arItem["DETAIL_PAGE_URL"];?>">
                <?echo $arItem["NAME"]?>
            </a>
            <a class="document-preview__link" href="<?echo $documentValue["SRC"];?>" target="_blank">
                <div class="base-icon-block-content">
                    <?$APPLICATION->IncludeFile("/includes/svg/download_file_icon_big.html");?>
                </div>
                <div class="document-preview__link-text">Скачать <?echo end($fileType);?></div>
            </a>
        </div>
    <?endforeach;?>
</div>