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
?>
 
<div class="content-filter">
	Показать документы:
	<div class="select select--simple" data-controller="select">
		<button class="select__button" data-target="select.button" data-action="select#open">
		<span data-target="select.buttonLabel">
				<?if($_REQUEST['section'] == ''):?>
					Все
				<?else:?>
					<?foreach ($arResult['SECTIONS'] as $arSection):?>
						<?if($_REQUEST['section'] == $arSection['CODE']):?>
							<?= $arSection['NAME']; ?>
						<?endif;?>
					<?endforeach;?>
				<?endif;?>
				</span>
		<svg class="icon" role="img"><use xlink:href="<?=ASSET_PATH?>icons.svg#dropdown-triangle"/></svg>
		</button>
		<ul class="select__items" data-target="select.items">
			<li class="select__item <?=$_REQUEST['section'] == '' ? 'active' : ''?>"
				data-page="<?=$arParams['SECTION_URL']?>"
				data-action="click->select#setActive click->select#byLink">
				Все
			</li>
			<?foreach ($arResult['SECTIONS'] as $arSection):?>
				<?
				$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
				$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);	
				?>
				<li class="select__item <?=$_REQUEST['section'] == $arSection['CODE'] ? 'active' : ''?>" id="<?=$this->GetEditAreaId($arSection['ID']);?>" data-page="<?=$arParams['SECTION_URL']?>?section=<?= $arSection['CODE']; ?>" data-action="click->select#setActive click->select#byLink"><?= $arSection['NAME']; ?></li>
			<?endforeach;?>
		</ul>
	</div>
</div>
<br/>