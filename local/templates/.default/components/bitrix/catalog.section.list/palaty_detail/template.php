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
?>

<header class="page-header">
	<h1><?=$arResult['ROOT']['UF_FULLNAME']?></h1>
	<a class="back-link" href="/munitsipalnye-palaty/perechen-munitsipalnykh-palat/">
		<svg class="icon" role="img"><use xlink:href="<?=ASSET_PATH?>icons.svg#dropdown-arrow"></svg>
		В&nbsp;список МОП
	</a>
	<div class="description-list">
		<?if(!empty($arResult['ROOT']['UF_DATE'])):?>
			<strong class="description-list__term">
				Дата утверждения положения или&nbsp;другого НПА
			</strong>
			<div class="description-list__description">
				<?=$arResult['ROOT']['UF_DATE'];?>
			</div>
		<?endif;?>

		<?if(!empty($arResult['ROOT']['UF_ADDRESS'])):?>
			<strong class="description-list__term">
				Адрес
			</strong>
			<div class="description-list__description">
				<?=$arResult['ROOT']['UF_ADDRESS'];?>
			</div>
		<?endif;?>

		<?if(!empty($arResult['ROOT']['UF_PHONE'])):?>
			<strong class="description-list__term">
				Телефон
			</strong>
			<div class="description-list__description">
				<a href="tel:+<?=preg_replace('/[^0-9.]+/', '', $arResult['ROOT']['UF_PHONE']);?>"><?=$arResult['ROOT']['UF_PHONE'];?></a>
			</div>
		<?endif;?>

		<?if(!empty($arResult['ROOT']['UF_SITE'])):?>
			<strong class="description-list__term">Сайт</strong>
			<div class="description-list__description">
				<a href="<?=$arResult['ROOT']['UF_SITE'];?>" target="_blank"><?=$arResult['ROOT']['UF_SITE'];?></a>
			</div>
		<?endif;?>
	</div>
</header>

<div class="grid-container">
	<div class="anchor-navigation" data-controller="anchor-navigation"
		data-action="scroll@document->anchor-navigation#update resize@window->anchor-navigation#onResize">

		<div class="anchor-navigation__content">
			<?foreach ($arResult['SECTIONS'] as $key => $arSection):?>
				<?
				$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
				$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);	
				?>

				<h2 id="<?=$arSection['CODE']?>" data-target="anchor-navigation.section"><?=$arSection['NAME']?></h2>
				<ul id="<?=$this->GetEditAreaId($arSection['ID']);?>" class="important-links important-links--large">
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
							"IBLOCK_ID" => "19",
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
			<?endforeach;?>
		</div>

		<ul class="anchor-menu" data-controller="anchor-menu" data-turbolinks="false">
			<?foreach ($arResult['SECTIONS'] as $key => $arSection):?>
				<li class="anchor-menu__item">
					<a class="anchor-menu__link <?=$key == 0 ? 'active' : ''?>"
						data-target="anchor-navigation.link"
						href="#<?=$arSection['CODE']?>"
						data-action="anchor-menu#navigate"><?=$arSection['NAME']?></a>
				</li>
			<?endforeach;?>
		</ul>
	</div>
</div>