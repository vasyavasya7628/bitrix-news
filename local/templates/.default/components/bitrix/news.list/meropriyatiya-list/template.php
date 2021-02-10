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

$year = FormatDateFromDB($arResult["ITEMS"][0]["ACTIVE_FROM"], "YYYY");
?>

<?if(!empty($arResult["ITEMS"])):?>
	<div class="timeline" data-target="view-more.container">
		<h4 class="timeline__year"><?=$year;?> год</h4>
		<div class="press-center__articles press-center__articles--dense-list">
			<?foreach ($arResult["ITEMS"] as $arItem):?>
				<?
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => 'Удалить'));
				?>
				<?if($year != FormatDateFromDB($arItem["ACTIVE_FROM"], "YYYY")):?>
					<?$year = FormatDateFromDB($arItem["ACTIVE_FROM"], "YYYY")?>
					</div>
					<h4 class="timeline__year"><?=FormatDateFromDB($arItem["ACTIVE_FROM"], "YYYY");?> год</h4>
					<div class="press-center__articles press-center__articles--dense-list">
				<?endif;?>

				<article class="news" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
					<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="news__link">
						<h4 class="news__title">
						<?=$arItem["NAME"];?>
						</h4>
					</a>
					<div class="news__illustration" style="background-image: url(<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>)"></div>
					<div class="news__publication-info">
						<time class="news__publication-date" datetime="<?=FormatDateFromDB($arItem["ACTIVE_FROM"], "YYYY-MM-DD");?>"><?=FormatDateFromDB($arItem["ACTIVE_FROM"], "DD MMMM YYYY, HH:MI");?></time>
						<a class="news__topic" href="<?=$arItem['LIST_PAGE_URL']?><?=$arResult['SECTION_LIST'][$arItem['IBLOCK_SECTION_ID']]['CODE']?>/"><?=$arResult['SECTION_LIST'][$arItem['IBLOCK_SECTION_ID']]['NAME']?></a>
					</div>
				</article>
			<?endforeach;?>
		</div>
	</div>
<?else:?>
	<div class="grid-container">
		<div><br><br></div>
		<h4>Ничего не найдено</h4>
	</div>
<?endif;?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
    <?=$arResult["NAV_STRING"]?>
<?endif;?>