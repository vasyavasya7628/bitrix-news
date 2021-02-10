<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>

<div class="footer-menu__links">
	<div class="footer-menu__main-link">
		<?=$arResult[0]["TEXT"]?>
	</div>
<?
for($i = 1; $i < count($arResult); $i++):
if($arParams["MAX_LEVEL"] == 1 && $arResult[$i]["DEPTH_LEVEL"] > 1) 
	continue;
?>
	<a class="footer-menu__link popup-block-link" href="<?=$arResult[$i]["LINK"]?><?if($arResult[$i]["PARAMS"]["SECTION_ID"]):?>?SECTION_ID=<?echo $arResult[$i]["PARAMS"]["SECTION_ID"]?><?endif;?>">
		<?=$arResult[$i]["TEXT"]?>
	</a>
<?endfor;?>

</div>

<?endif?>