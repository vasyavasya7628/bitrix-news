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

$active_set = false;
?>

<?if($arParams['RIGHT_MENU'] == 'Y'):?>
	<div class="anchor-navigation__content">
		<h2><?=$arParams['SECTION_NAME']?></h2>
<?endif;?>

<?foreach ($arResult['SECTIONS'] as $arSection):?>
	<?
	if($arSection['ELEMENT_CNT'] == 0) continue;

	$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
	$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);	
	?>
	<?if($arParams['NO_TITLE'] != 'Y'):?>
		<h3 id="<?=$this->GetEditAreaId($arSection['ID']);?>"><?=$arSection['NAME']?></h3>
	<?endif;?>
	<ul class="important-links important-links--large"
		<?if($arParams['RIGHT_MENU'] == 'Y'):?>
			id="<?=$arSection['CODE']?>" data-target="anchor-navigation.section"
		<?endif;?>
	>
	<?
		global $arrFilter;
		$arrFilter = ['SECTION_ID' => $arSection['ID']];
		if($arParams['SHOW_ALL'] != "Y")
			$arrFilter['PROPERTY_HIDE_IN_SOVET'] = false;
			
		$APPLICATION->IncludeComponent(
			"bitrix:news.list", 
			"person-info", 
			array(
				"ACTIVE_DATE_FORMAT" => "SHORT",
				"ADD_SECTIONS_CHAIN" => "N",
				"AJAX_MODE" => "N",
				"AJAX_OPTION_ADDITIONAL" => "",
				"AJAX_OPTION_HISTORY" => "N",
				"AJAX_OPTION_JUMP" => "N",
				"AJAX_OPTION_STYLE" => "N",
				"CACHE_FILTER" => "N",
				"CACHE_GROUPS" => "Y",
				"CACHE_TIME" => "36000000",
				"CACHE_TYPE" => "A",
				"CHECK_DATES" => "Y",
				"DETAIL_URL" => "",
				"DISPLAY_BOTTOM_PAGER" => "N",
				"DISPLAY_DATE" => "N",
				"DISPLAY_NAME" => "N",
				"DISPLAY_PICTURE" => "N",
				"DISPLAY_PREVIEW_TEXT" => "N",
				"DISPLAY_TOP_PAGER" => "N",
				"FIELD_CODE" => array(),
				"FILTER_NAME" => "arrFilter",
				"HIDE_LINK_WHEN_NO_DETAIL" => "N",
				"IBLOCK_ID" => "7",
				"IBLOCK_TYPE" => "structure",
				"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
				"INCLUDE_SUBSECTIONS" => "N",
				"MESSAGE_404" => "",
				"NEWS_COUNT" => "100",
				"PAGER_BASE_LINK_ENABLE" => "N",
				"PAGER_DESC_NUMBERING" => "N",
				"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
				"PAGER_SHOW_ALL" => "N",
				"PAGER_SHOW_ALWAYS" => "N",
				"PAGER_TEMPLATE" => ".default",
				"PAGER_TITLE" => "Документы",
				"PARENT_SECTION" => "",
				"PARENT_SECTION_CODE" => "",
				"PREVIEW_TRUNCATE_LEN" => "",
				"PROPERTY_CODE" => array(
					"POSITION"
				),
				"SET_BROWSER_TITLE" => "N",
				"SET_LAST_MODIFIED" => "N",
				"SET_META_DESCRIPTION" => "N",
				"SET_META_KEYWORDS" => "N",
				"SET_STATUS_404" => "N",
				"SET_TITLE" => "N",
				"SHOW_404" => "N",
				"SORT_BY1" => "SORT",
				"SORT_BY2" => "NAME",
				"SORT_ORDER1" => "ASC",
				"SORT_ORDER2" => "ASC",
				"STRICT_SECTION_CHECK" => "N",
				"COMPONENT_TEMPLATE" => "document_list",
				"BIG_IMG" => ($arSection['UF_BIG_IMG']) ? 'Y' : 'N',
				"LINK_NAME" => "Y"
			),
			false,
			array(
				"ACTIVE_COMPONENT" => "Y"
			)
		);?>
	</ul>
<?endforeach;?>

<?if($arParams['RIGHT_MENU'] == 'Y'):?>
	</div>
	<ul class="anchor-menu" data-controller="anchor-menu" data-turbolinks="false">
		<?foreach ($arResult['SECTIONS'] as $arSection):?>
			<?
			if($arSection['ELEMENT_CNT'] == 0) continue;

			$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
			$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);	
			?>
			<li class="anchor-menu__item">
				<a class="anchor-menu__link <?=!$active_set ? 'active' : ''?>"
					data-target="anchor-navigation.link"
					href="#<?=$arSection['CODE']?>"
					data-action="anchor-menu#navigate"><?=$arSection['NAME']?></a>
			</li>
			<?$active_set = true;?>
		<?endforeach;?>
	</ul>
<?endif;?>