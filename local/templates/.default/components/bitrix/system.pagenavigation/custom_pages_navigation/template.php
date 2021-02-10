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

if(!$arResult["NavShowAlways"])
{
	if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
		return;
}

$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"]."&amp;" : "");
$strNavQueryString = $strNavQueryString . ("SIZEN_".$arResult["NavNum"]."=".$arResult["NavPageSize"]."&amp;");
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?".$arResult["NavQueryString"] : "?".$strNavQueryString);
?>


<div class="projects-list__pagination">
	Страницы:
<?if ($arResult["NavPageNomer"] > 1):?>
	<?if ($arResult["NavPageNomer"] > 2):?>
		<a class="back-link back-link--pagination" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>">
			<svg class="icon" role="img"><use xlink:href="<?=ASSET_PATH?>icons.svg#dropdown-arrow"/></svg>
			<?=GetMessage("nav_prev")?>
		</a>
		
		<?if ($arResult["NavPageNomer"] > 3):?>
		<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=1">1</a>
		<?endif;?>
		<?if ($arResult["NavPageNomer"] > 4):?>
		...
		<?endif;?>
	<?else:?>
		<a class="back-link back-link--pagination" href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>">
			<svg class="icon" role="img"><use xlink:href="<?=ASSET_PATH?>icons.svg#dropdown-arrow"/></svg>
			<?=GetMessage("nav_prev")?>
		</a>
	<?endif?>
<?endif?>

<?while($arResult["nStartPage"] <= $arResult["nEndPage"]):?>

	<?if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):?>
		<b><?=$arResult["nStartPage"]?></b>
	<?elseif($arResult["nStartPage"] == 1 && $arResult["bSavePage"] == false):?>
		<a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><?=$arResult["nStartPage"]?></a>
	<?else:?>
		<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>"><?=$arResult["nStartPage"]?></a>
	<?endif?>
	<?$arResult["nStartPage"]++?>
<?endwhile?>
<?if($arResult["NavPageNomer"] < $arResult["NavPageCount"]):?>
	<?if (($arResult["NavPageCount"] - $arResult["NavPageNomer"]) > 3):?>
	...
	<?endif?>
	<?if (($arResult["NavPageCount"] - $arResult["NavPageNomer"]) > 2):?>
	<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["NavPageCount"]?>"><?=$arResult["NavPageCount"]?></a>
	<?endif?>
	<a class="back-link next-link--pagination" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>">
		<?=GetMessage("nav_next")?>
		<svg class="icon" role="img"><use xlink:href="<?=ASSET_PATH?>icons.svg#dropdown-arrow"/></svg>
	</a>
<?endif?>
</div>