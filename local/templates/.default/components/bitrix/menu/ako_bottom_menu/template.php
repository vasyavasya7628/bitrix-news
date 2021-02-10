<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
	<div class="site-footer__column content-block">
		<h4 class="site-footer__title"><?=$arResult[0]["TEXT"]?></h4>
		<ul class="links">
			<?
			for($i = 1; $i < count($arResult); $i++):
			if($arParams["MAX_LEVEL"] == 1 && $arResult[$i]["DEPTH_LEVEL"] > 1) 
				continue;
			?>
				<li class="links__item"><a class="links__link" href="<?=$arResult[$i]["LINK"]?>"><?=$arResult[$i]["TEXT"]?></a></li>
			<?endfor;?>
		</ul>
	</div>
<?endif?>