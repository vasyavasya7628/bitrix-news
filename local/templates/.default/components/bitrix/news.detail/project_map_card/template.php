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

<div class="detail-project">
	<div>
		<div class="detail-project__main-info">
			<h2><?=$arResult["NAME"]?></h2>
			<div class="detail-project__category">
				Категория: 
				<? if (count($arResult['DISPLAY_PROPERTIES']['CATEGORY']['DISPLAY_VALUE']) == 1):?>
					<div class="category-item" data-category="<?=$arResult['DISPLAY_PROPERTIES']['CATEGORY']['VALUE']?>" 
						 data-action="click->project-filter#filterByCategory">
						<?=$arResult['DISPLAY_PROPERTIES']['CATEGORY']['DISPLAY_VALUE']?>
					</div>
				<? else:
					foreach($arResult['DISPLAY_PROPERTIES']['CATEGORY']['DISPLAY_VALUE'] as $key => $category): ?>
					<?if ($key != 0):?>, <?endif;?>
					<div class="category-item" data-category="<?=$arResult['DISPLAY_PROPERTIES']['CATEGORY']['VALUE'][$key]?>" 
						 data-action="click->project-filter#filterByCategory">
						<?=$category?>
					</div>
				<? 
					endforeach;
				endif;
				?>
			</div>
			<div class="detail-project__contact-info">
				<div>
					<div class="detail-project__address">
						<?=$arResult['SECTION_DATA']['NAME']?>, <?=$arResult['SECTION_DATA']['DESCRIPTION']?>
					</div>
					<? if ($arResult['SECTION_DATA']['UF_PHONE']): ?>
					 <a href="tel:<?=getPhoneForLink($arResult['SECTION_DATA']['UF_PHONE'])?>"><?=$arResult['SECTION_DATA']['UF_PHONE']?></a>
					<? endif; ?>
				</div>
				<? if($arResult['SECTION_DATA']['PICTURE']): ?>
				<div class="detail-project__image-wrapper">
 					<img src="<?=CFile::GetPath($arResult['SECTION_DATA']['PICTURE']);?>">
				</div>
				<? endif; ?>
			</div>
		</div>
		<div class="detail-project__detail-info">
			<div class="detail-project__info-tag">
				 Описание
			</div>
			<div class="detail-project__info-text">
				<?=$arResult["PREVIEW_TEXT"]?>
			</div>
			<div class="detail-project__info-tag">
				 Эффективность до оптимизации
			</div>
			<div class="detail-project__info-text">
				<?=$arResult['DISPLAY_PROPERTIES']['EFFICIENCY_BEFORE']['DISPLAY_VALUE']?>
			</div>
			<div class="detail-project__info-tag">
				 Эффективность после оптимизации
			</div>
			<div class="detail-project__info-text">
				<?=$arResult['DISPLAY_PROPERTIES']['EFFICIENCY_AFTER']['DISPLAY_VALUE']?>
			</div>
		</div>
	</div>
 	<a class="button button--default" href="<?=$arResult['DETAIL_PAGE_URL']?>">Подробнее о проекте</a>
</div>
<button class="hide" data-action="click->project-filter#closeProjectDetail">
	<svg class="icon" role="img"><use xlink:href="<?=ASSET_PATH?>icons.svg#dropdown-arrow"/></svg>
</button>