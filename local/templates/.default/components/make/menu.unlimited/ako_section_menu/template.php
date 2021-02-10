<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<? //var_dump($arResult["ITEMS"]);
if (!empty($arResult["ITEMS"])):
    //var_dump($arResult["CURRENT_SECTION"]);
  ?>

<div class="menu-structure-wrapper">
    <button class="base-button-transparent--middle base-button--with-icon menu-structure-button">
        <div class="base-button__text"><?=$arResult["CURRENT_SECTION"]["ROOT"]["TEXT"]?></div>
        <div class="base-button__icon">
            <div class="base-icon-block">
                <?$APPLICATION->IncludeFile("/includes/svg/menu_structure_dots.html")?>
            </div>
        </div>
    </button>
    <div class="menu-structure">
        <?if (!is_null($arResult["CURRENT_SECTION"]["ROOT"]["LINK"])):?>
            <div class="menu-structure__links-list menu-structure__links-list--current-page">
                <?
                // ссылки текущей страницы
                $previousLevel = $arResult["CURRENT_SECTION"]["ROOT"]["DEPTH_LEVEL"]+1; // уровень текущего раздела
                ?>
                <?foreach ($arResult["CURRENT_SECTION"]["CHILDS"] as $arItem):?>
                    <? // закрытие блоков в зависимости от дочерний ли раздел ?>
                    <?if ($previousLevel > $arItem["DEPTH_LEVEL"]):?>
                        <?=str_repeat("</div></div></div>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
                    <?endif;?>

                    <?if ($arItem["IS_PARENT"]):?>
                        <div class="menu-structure__link menu-structure__link--next-level">
                            <div class="menu-structure__section">
                                <div class="menu-structure__main-link-block">
                                    <div class="menu-structure__main-link"><?echo $arItem["TEXT"]?></div>
                                    <div class="base-icon-block menu-structure__main-link-arrow">
                                        <?$APPLICATION->IncludeFile("/includes/svg/main_link_icon.html")?>
                                    </div>
                                </div>
                                <div class="menu-structure__links-list">
                    <?else:?>
                        <a data-level="<?=$previousLevel;?>" class="menu-structure__link <?if ($arItem["SELECTED"]):?>menu-structure__link--active<?endif;?>" href="<?=$arItem["LINK"]?>">
                            <?=$arItem["TEXT"];?>
                        </a>
                    <?endif;?>

                    <?$previousLevel = $arItem["DEPTH_LEVEL"];?>
                <?endforeach;?>
                <?if ($previousLevel > $arResult["CURRENT_SECTION"]["ROOT"]["DEPTH_LEVEL"]+1)://close last item tags?>
                    <?=str_repeat("</div>", ($previousLevel-$arResult["CURRENT_SECTION"]["ROOT"]["DEPTH_LEVEL"]+1) );?>
                <?endif?>
            </div>
        <?endif;?>
<?
$previousLevel = 2; // корневой уровень принят за 2, т.к. меню строится со второго уровня, начиная с корня сайта
foreach($arResult["ITEMS"] as $key => $arItem):?>

    <? // закрытие блоков в зависимости от дочерний ли раздел ?>
	<?if ($previousLevel && $arItem["DEPTH_LEVEL"] == 2):?>
		<?=str_repeat("</div></div>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
    <?else:?>
        <?$repeat = $previousLevel - $arItem["DEPTH_LEVEL"];?>
        <?=str_repeat("</div></div></div>", $repeat >=0 ? $repeat : 0);?>
    <?endif?>

    <? // проверка, является ли пункт меню разделом ?>
	<?if ($arItem["IS_PARENT"]):?>
        <? // если раздел является дочерним ?>
        <?if($arItem["DEPTH_LEVEL"] > 2):?>
            <div class="menu-structure__link <?if ($arItem["SELECTED"]):?>menu-structure__link--active<?endif;?> menu-structure__link--next-level">
                <div class="menu-structure__section <?if ($arItem["SELECTED"]):?>menu-structure__section--current-page<?endif?> <?if (strpos($arItem["LINK"], $arResult["CURRENT_SECTION"]["ROOT"]["SECTION_PATH"]) !== false):?>menu-structure__section--current-page<?endif;?>">
                    <div class="menu-structure__main-link-block <?if ($arItem["SELECTED"]):?>menu-structure__main-link-block--active<?endif?> <?if ($key == count($arResult["ITEMS"])-1):?>menu-structure__main-link-block--last<?endif?> <?if($key == 0):?>menu-structure__main-link-block--first<?endif;?>">
                        <? /* если следующий пункт меню не является страницей, то оставляем его как блок
                              иначе подставляем его ссылку вместо ссылки страницы раздела */?>
                        <div class="menu-structure__main-link"><?=$arItem["TEXT"]?></div>
                        <div class="base-icon-block menu-structure__main-link-arrow">
                            <?$APPLICATION->IncludeFile("/includes/svg/main_link_icon.html")?>
                        </div>
                    </div>
                    <div class="menu-structure__links-list">
        <?else:?>
            <div class="menu-structure__section <?if ($arItem["SELECTED"]):?><?endif?> <?if (strpos($arItem["LINK"], $arResult["CURRENT_SECTION"]["ROOT"]["SECTION_PATH"]) !== false):?>menu-structure__section--current-page<?endif;?>">
                <div class="menu-structure__main-link-block <?if ($arItem["SELECTED"]):?>menu-structure__main-link-block--active<?endif?> <?if ($key == count($arResult["ITEMS"])-1):?>menu-structure__main-link-block--last<?endif?> <?if($key == 0):?>menu-structure__main-link-block--first<?endif;?>">
                    <? /* если следующий пункт меню не является страницей, то оставляем его как блок
                              иначе подставляем его ссылку вместо ссылки страницы раздела */?>
                    <div class="menu-structure__main-link"><?=$arItem["TEXT"]?></div>
                    <div class="base-icon-block menu-structure__main-link-arrow">
                        <?$APPLICATION->IncludeFile("/includes/svg/main_link_icon.html")?>
                    </div>
                </div>
                <div class="menu-structure__links-list">

        <?endif;?>
    <?else:?>
        <?if($arItem["DEPTH_LEVEL"] == 2):?>
            <? // если страница является корневой, то оборачиваем ее в корневой блок ?>
            <div class="menu-structure__section <?if ($arItem["SELECTED"]):?>menu-structure__section--active<?endif?>">
                <div class="menu-structure__main-link-block <?if ($arItem["SELECTED"]):?>menu-structure__main-link-block--active<?endif?> <?if($key == 0):?>menu-structure__main-link-block--first<?endif;?> <?if ($key == count($arResult["ITEMS"])-1):?>menu-structure__main-link-block--last<?endif?>">
                    <a class="menu-structure__main-link" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
                </div>
            </div>
        <?else:?>
            <a class="menu-structure__link <?if ($arItem["SELECTED"]):?>menu-structure__link--active<?endif;?>" href="<?=$arItem["LINK"]?>">
                <?=$arItem["TEXT"]?>
            </a>
        <?endif;?>
	<?endif?>

	<?$previousLevel = $arItem["DEPTH_LEVEL"];?>

<?endforeach?>

<?if ($previousLevel > 1)://close last item tags?>
	<?=str_repeat("</div></div>", ($previousLevel-1) );?>
<?endif?>
</div>
<?endif?>