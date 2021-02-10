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

$strSectionEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_EDIT");
$strSectionDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_DELETE");
$arSectionDeleteParams = array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM'));

$arResult = $arResult['SECTION'];
?>

<header class="page-header">
	<h1><?=$arResult['NAME']?></h1>
	<a class="back-link" href="/resursnyy-tsentr-nko/reestr-nko">
		<svg class="icon" role="img"><use xlink:href="<?=ASSET_PATH?>icons.svg#dropdown-arrow"></svg>
		В список НКО
	</a>
	<div class="description-list">
		<?if(!empty($arResult['UF_ADDRESS'])):?>
			<strong class="description-list__term">
				Адрес
			</strong>
			<div class="description-list__description">
				<?=$arResult['UF_ADDRESS'];?>
			</div>
		<?endif;?>

		<?if(!empty($arResult['UF_PHONE'])):?>
			<strong class="description-list__term">
				Телефон
			</strong>
			<div class="description-list__description">
				<a href="tel:+<?=preg_replace('/[^0-9.]+/', '', $arResult['UF_PHONE']);?>"><?=$arResult['UF_PHONE'];?></a>
			</div>
		<?endif;?>
	</div>
</header>

<div class="grid-container">
	<div class="anchor-navigation" data-controller="anchor-navigation"
		data-action="scroll@document->anchor-navigation#update resize@window->anchor-navigation#onResize">

		<div class="anchor-navigation__content">
			<h2 id="leading" data-target="anchor-navigation.section">Руководство</h2>
			<ul class="important-links important-links--large">
			<?
				global $arrFilter;
				$arrFilter = ['IBLOCK_SECTION_ID' => $arSection['ID']];
				
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
						"FIELD_CODE" => array(
							0 => "NAME",
							1 => "",
						),
						"FILTER_NAME" => "arrFilter",
						"HIDE_LINK_WHEN_NO_DETAIL" => "N",
						"IBLOCK_ID" => "20",
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
							0 => "LINK_NAME",
							1 => "LINK",
							2 => "",
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
						"SORT_ORDER2" => "DASCESC",
						"STRICT_SECTION_CHECK" => "N",
						"COMPONENT_TEMPLATE" => "document_list",
						"BIG_IMG" => $key == 0 ? "Y" : "N"
					),
					false,
					array(
						"ACTIVE_COMPONENT" => "Y"
					)
				);?>
			</ul>
			
			<h2 id="activity" data-target="anchor-navigation.section">Информация о деятельности</h2>
			<br>
			<p>
				<?=$arResult['DESCRIPTION']?>
			</p>
		</div>

		<ul class="anchor-menu" data-controller="anchor-menu" data-turbolinks="false">
				<li class="anchor-menu__item">
					<a class="anchor-menu__link active"
						data-target="anchor-navigation.link"
						href="#leading"
						data-action="anchor-menu#navigate">Руководство</a>
				</li>

				<li class="anchor-menu__item">
					<a class="anchor-menu__link"
						data-target="anchor-navigation.link"
						href="#activity"
						data-action="anchor-menu#navigate">Деятельность</a>
				</li>
		</ul>
	</div>
</div>