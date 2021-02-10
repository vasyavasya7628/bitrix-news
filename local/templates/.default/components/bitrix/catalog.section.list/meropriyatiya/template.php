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

$arViewModeList = $arResult['VIEW_MODE_LIST'];

$strSectionEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_EDIT");
$strSectionDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_DELETE");
$arSectionDeleteParams = array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM'));

$arPath = explode('/', $APPLICATION->GetCurDir());
$deep = $arParams['IBLOCK_ID'] == 22 ? 4 : 3;
?>
 
<div class="grid-container">
  <div class="content-filter">
    Показать мероприятия:
    <div class="select select--simple" data-controller="select">
      <button class="select__button" data-target="select.button" data-action="select#open">
        <span data-target="select.buttonLabel">
				<?if($arPath[$deep] == ''):?>
					Все
				<?else:?>
					<?foreach ($arResult['SECTIONS'] as $arSection):?>
						<?if($arPath[$deep] == $arSection['CODE']):?>
							<?= $arSection['NAME']; ?>
						<?endif;?>
					<?endforeach;?>
				<?endif;?>
				</span>
        <svg class="icon" role="img"><use xlink:href="<?=ASSET_PATH?>icons.svg#dropdown-triangle"/></svg>
      </button>
      <ul class="select__items" data-target="select.items">
				<li class="select__item <?=$arPath[$deep] == '' ? 'active' : ''?>"
					data-page="/deyatelnost/<?= $arParams['IBLOCK_ID'] == 22 ? 'obshchestvennyy-kontrol/' : ''?>meropriyatiya/"
					data-action="click->select#setActive click->select#byLink">
					Все
				</li>
				<?foreach ($arResult['SECTIONS'] as $arSection):?>
					<?
					$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
					$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);	
					?>
					<li class="select__item <?=$arPath[$deep] == $arSection['CODE'] ? 'active' : ''?>" id="<?=$this->GetEditAreaId($arSection['ID']);?>" data-page="<?= $arSection['LIST_PAGE_URL']; ?><?= $arSection['CODE']; ?>/" data-action="click->select#setActive click->select#byLink"><?= $arSection['NAME']; ?></li>
				<?endforeach;?>
      </ul>
    </div>
  </div>
</div>