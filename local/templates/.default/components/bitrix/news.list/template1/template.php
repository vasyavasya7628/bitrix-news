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
<div class="treatment-list">
	<?if($arParams["DISPLAY_TOP_PAGER"]):?>
		<?=$arResult["NAV_STRING"]?><br />
	<?endif;?>
	<?foreach($arResult["ITEMS"] as $arItem):?>
		<?
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?>

		<a id="<?=$this->GetEditAreaId($arItem['ID']);?>" class="treatment-item popup-block-link" href="<?=$arItem["DETAIL_PAGE_URL"]?>">
			<div class="treatment__status-block">
	            <?
	            switch ($arItem["DISPLAY_PROPERTIES"]["STATUS"]["VALUE_ENUM_ID"]) {
	            	case '6':
						echo '<div class="treatment__status-icon treatment__status-icon--accepted"></div>';
						break;
	            	case '8':
						echo '<div class="treatment__status-icon treatment__status-icon--accepted"></div>';
						break;
	            	case '9':
						echo '<div class="treatment__status-icon treatment__status-icon--complete"></div>';
						break;
	            	default:
						echo '<div class="treatment__status-icon"></div>';
						break;
	            }
	            ?>       
	            <div class="treatment__status-text-block">
	                <div class="treatment-item__status-text">
	                    <?echo $arItem["DISPLAY_PROPERTIES"]["STATUS"]["DISPLAY_VALUE"];?>
	                </div>

	                <div class="treatment__status-date">
	                    <?echo CIBlockFormatProperties::DateFormat("j F Y", MakeTimeStamp($arItem["DATE_CREATE"], CSite::GetDateFormat()));?>
	                </div>
	            </div>
	        </div>
	        <div class="treatment-item__content">
	            <div class="treatment-item__title">
	               <?echo $arItem["DISPLAY_PROPERTIES"]["FORM_TEXT_30"]["DISPLAY_VALUE"];?>
	            </div>

	            <div class="treatment-item__description">
	                <?echo $arItem["DISPLAY_PROPERTIES"]["FORM_TEXTAREA_28"]["DISPLAY_VALUE"];?>
	            </div>
	        </div>
		</a>
	<?endforeach;?>
	<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
		<br /><?=$arResult["NAV_STRING"]?>
	<?endif;?>
</div>
