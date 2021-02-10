<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
if (!empty($arResult)):
    /*Получение названия раздела*/
    $sPath = $_SERVER["DOCUMENT_ROOT"].$APPLICATION->GetCurDir().".section.php";
    include($sPath);
    ?>
<div class="menu-structure-wrapper">
    <button class="base-button-transparent--middle base-button--with-icon menu-structure-button">
        <div class="base-button__text"><?=$sSectionName?></div>
        <div class="base-button__icon">
            <div class="base-icon-block">
                <?$APPLICATION->IncludeFile("/includes/svg/menu_structure_dots.html")?>
            </div>
        </div>
    </button>
    <div class="menu-structure">
<?
$previousLevel = 0;
foreach($arResult as $arItem):?>

	<?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
		<?=str_repeat("</div></div>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
	<?endif?>

	<?if ($arItem["IS_PARENT"]):?>

		<?if ($arItem["DEPTH_LEVEL"] == 1):?>
            <div class="menu-structure__section <?if ($arItem["SELECTED"]):?>menu-structure__section--current-page<?endif?>">
                <div class="menu-structure__main-link-block <?if ($arItem["SELECTED"]):?>menu-structure__main-link-block--active<?endif?>">
                    <div class="menu-structure__main-link"><?=$arItem["TEXT"]?></div>
                    <div class="base-icon-block menu-structure__main-link-arrow">
                        <?$APPLICATION->IncludeFile("/includes/svg/main_link_icon.html")?>
                    </div>
                </div>
                <div class="menu-structure__links-list">
		<?else:?>
            <a class="menu-structure__link <?if ($arItem["SELECTED"]):?>menu-structure__link--active<?endif?>" href="<?=$arItem["LINK"]?>">
                <?=$arItem["TEXT"]?>
            </a>
		<?endif?>

	<?else:?>
        <?if ($arItem["DEPTH_LEVEL"] == 1):?>
            <div class="menu-structure__section <?if ($arItem["SELECTED"]):?>menu-structure__section--current-page<?endif?>">
                <div class="menu-structure__main-link-block <?if ($arItem["SELECTED"]):?>menu-structure__main-link-block--active<?endif?>">
                    <a class="menu-structure__main-link" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
                </div>
            </div>
        <?else:?>
            <a class="menu-structure__link <?if ($arItem["SELECTED"]):?>menu-structure__link--active<?endif?>" href="<?=$arItem["LINK"]?>">
                <?=$arItem["TEXT"]?>
            </a>
        <?endif?>
	<?endif?>

	<?$previousLevel = $arItem["DEPTH_LEVEL"];?>

<?endforeach?>

<?if ($previousLevel > 1)://close last item tags?>
	<?=str_repeat("</div></div>", ($previousLevel-1) );?>
<?endif?>
</div>
</div>
<?endif?>