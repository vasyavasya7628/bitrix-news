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

$popup_query = parse_url($_SERVER["REQUEST_URI"])["query"];
$social_title = $arResult["NAME"];

$arBackUrl = explode('/', $_SERVER['HTTP_REFERER']);
$deep = $arParams['IBLOCK_ID'] == 22 ? 6 : 5;
?>

<section class="project-detail">
    <header class="project-detail__header">
		<a class="back-link" href="<?=$arResult['LIST_PAGE_URL']?>">
			<svg class="icon" role="img"><use xlink:href="<?=ASSET_PATH?>icons.svg#dropdown-arrow"/></svg>
			Проекты
		</a>
		<h1 class="project-detail__title"><?=$arResult["NAME"]?></h1>
		<div class="project-detail__main-info">
			<time class="project-detail__publication-date" datetime="<?=FormatDateFromDB($arResult["ACTIVE_FROM"], "YYYY-MM-DD");?>">
				Опубликовано: <span><?=FormatDateFromDB($arResult["ACTIVE_FROM"], "DD MMMM YYYY");?></span>
			</time>
			<div class="project-detail__separator"></div>
			<div class="project-detail__category">
				Категория: 
				<? if (count($arResult['DISPLAY_PROPERTIES']['CATEGORY']['DISPLAY_VALUE']) == 1):?>
					<a class="category-item" data-category="<?=$arResult['DISPLAY_PROPERTIES']['CATEGORY']['VALUE'][0]?>" 
						href="<?=$arResult['LIST_PAGE_URL']?>?category=<?=$arResult['DISPLAY_PROPERTIES']['CATEGORY']['VALUE'][0]?>"
							data-action="click->project-filter#filterByCategory">
						<?=$arResult['DISPLAY_PROPERTIES']['CATEGORY']['DISPLAY_VALUE']?>
					</a>
				<? else:
					foreach($arResult['DISPLAY_PROPERTIES']['CATEGORY']['DISPLAY_VALUE'] as $key => $category): ?>
					<a class="category-item" data-category="<?=$arResult['DISPLAY_PROPERTIES']['CATEGORY']['VALUE'][$key]?>" 
						href="<?=$arResult['LIST_PAGE_URL']?>?category=<?=$arResult['DISPLAY_PROPERTIES']['CATEGORY']['VALUE'][$key]?>"
							data-action="click->project-filter#filterByCategory">
						<?=$category?>
						<?if ($key != count($arResult['DISPLAY_PROPERTIES']['CATEGORY']['DISPLAY_VALUE']) - 1):?><span>,</span><?endif;?>
					</a>
				<? 
					endforeach;
				endif;
				?>
			</div>
		</div>
		<div class="project-detail__header-content">
			<div class="article__lead content-block"><?=$arResult["PREVIEW_TEXT"]?></div>
		</div>
		<div class="project-detail__header-content">
			<div class="project-detail__info-block">
				<div class="project-detail__info-title">Предприятие</div>
				<div class="project-detail__info-description">
					<img src="<?=CFile::GetPath($arResult['SECTION_DATA']['PICTURE']);?>">
					<div><?=$arResult['SECTION_DATA']['NAME']?></div>
				</div>
				<div class="project-detail__info-parameter">
					<div class="parameter-name">Адрес</div>
					<div class="parameter-value"><?=$arResult['SECTION_DATA']['DESCRIPTION']?></div>
				</div>
				<div class="project-detail__info-parameter">
					<div class="parameter-name">Телефон</div>
					<div class="parameter-value"><?=$arResult['SECTION_DATA']['UF_PHONE']?></div>
				</div>
			</div>
		</div>
		<div class="project-detail__header-content">
			<div class="project-detail__info-block">
				<div class="project-detail__info-title">Эффективность</div>
				<div class="project-detail__info-parameter">
					<div class="parameter-name">До оптимизации</div>
					<div class="parameter-value"><?=$arResult['DISPLAY_PROPERTIES']['EFFICIENCY_BEFORE']['DISPLAY_VALUE']?></div>
				</div>
				<div class="project-detail__info-parameter">
					<div class="parameter-name">После оптимизации</div>
					<div class="parameter-value"><?=$arResult['DISPLAY_PROPERTIES']['EFFICIENCY_AFTER']['DISPLAY_VALUE']?></div>
				</div>
			</div>
		</div>
		
		<div class="project-detail__header-content">
			<div class="project-detail__info-block last">
				<div class="project-detail__info-title">Материалы для скачивания</div>
				<div class="project-detail__info-file">
					<a class="project-document__link" href="<?=$arResult['DISPLAY_PROPERTIES']['DOCUMENTS']['FILE_VALUE']['SRC']?>" download="true">
						<svg class="project-document__icon icon" role="img">
							<use xlink:href="<?= ASSET_PATH?>icons.svg#paper"/>
						</svg>
						<span class="project-document__title">
							<span class="project-document__name">
								Проект «<?=$arResult["NAME"]?>»
							</span>
							<span class="project-document__data"><?=$arResult['DISPLAY_PROPERTIES']['DOCUMENTS']['FILE_VALUE']['EXTENSION']?>, <?=CFile::FormatSize($arResult['DISPLAY_PROPERTIES']['DOCUMENTS']['FILE_VALUE']['FILE_SIZE'])?></span>
						</span>
					</a>
				</div>
			</div>
		</div>
	</header>
    <div class="project-detail__content-wrapper">
        <div class="article__content content-block">
            <?=htmlspecialchars_decode($arResult["DETAIL_TEXT"])?>
        </div>
    </div>
</section>