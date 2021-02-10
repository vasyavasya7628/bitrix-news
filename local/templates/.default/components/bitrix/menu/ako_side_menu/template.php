<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="side-menu__wrapper">
    <?if (!empty($arResult)):?>
        <div class="menu-structure">
            <?
            foreach($arResult as $arItem):
                if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1)
                    continue;
                ?>
                <?if($arItem["SELECTED"]):?>
                <a href="<?=$arItem["LINK"]?>" class="menu-structure__main-link menu-structure__main-link--active"><?=$arItem["TEXT"]?></a>
            <?else:?>
                <a href="<?=$arItem["LINK"]?>" class="menu-structure__main-link"><?=$arItem["TEXT"]?></a>
            <?endif?>

            <?endforeach?>
        </div>
    <?endif?>
</div>
