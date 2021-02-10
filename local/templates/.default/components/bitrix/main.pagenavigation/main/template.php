<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/** @var array $arParams */
/** @var array $arResult */
/** @var CBitrixComponentTemplate $this */

/** @var PageNavigationComponent $component */
$component = $this->getComponent();

$this->setFrameMode(true);
?>

<div class="pagination-by-page">
	<div class="pagination-by-page__container">
		<span class="pagination-by-page__title"><?= GetMessage("round_nav_pages")?></span>
		<ul class="pagination-by-page__list">
			<li class="pagination-by-page__link pagination-by-page__prev <?= $arResult["CURRENT_PAGE"] == 1 ? 'pagination-by-page__inactive' : ''?>" data-page="<?=$arResult["CURRENT_PAGE"]-1?>"><a href="javascript:void(0)"><span><svg width="7" height="12" viewBox="0 0 7 12" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><path id="a" d="M0 10.59L4.327 6 0 1.41 1.332 0 7 6l-5.668 6L0 10.59z"/></svg><?= GetMessage("round_nav_back")?></span></a></li>
			
			<?if($arResult["CURRENT_PAGE"] >= 5):?>
				<li class="pagination-by-page__link" data-page="1"><a href="javascript:void(0)"><span>1</span></a></li>
				<li class="pagination-by-page__link" data-page="<?=ceil($arResult["START_PAGE"]/2)?>"><a href="javascript:void(0)"><span>...</span></a></li>
			<?endif;?>

			<?
			$page = $arResult["START_PAGE"];
			while($page <= $arResult["END_PAGE"]):?>
				<li class="pagination-by-page__link <?= $page == $arResult["CURRENT_PAGE"] ? 'pagination-by-page__active' : ''?>" data-page="<?=$page?>"><a href="javascript:void(0)"><span><?=$page?></span></a></li>
				<?$page++?>
			<?endwhile?>

			<?if($arResult["CURRENT_PAGE"] < $arResult["PAGE_COUNT"]-3):?>
				<li class="pagination-by-page__link" data-page="<?=ceil($arResult["PAGE_COUNT"]/2)?>"><a href="javascript:void(0)"><span>...</span></a></li>
				<li class="pagination-by-page__link" data-page="<?= $arResult["PAGE_COUNT"]?>"><a href="javascript:void(0)"><span><?= $arResult["PAGE_COUNT"]?></span></a></li>
			<?endif;?>

			<li class="pagination-by-page__link pagination-by-page__next <?= $arResult["CURRENT_PAGE"] == $arResult["PAGE_COUNT"] ? 'pagination-by-page__inactive' : ''?>" data-page="<?=$arResult["CURRENT_PAGE"]+1?>"><a href="javascript:void(0)"><span><?= GetMessage("round_nav_forward")?><svg width="7" height="12" viewBox="0 0 7 12" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><path id="a" d="M0 10.59L4.327 6 0 1.41 1.332 0 7 6l-5.668 6L0 10.59z"/></svg></span></a></li>
		</ul>
		<div style="clear:both"></div>
	</div>
</div>
