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
<div class="container home__banners">
    <div class="home__banners-slider">
    <? $i = 0;
    foreach ($arResult["ITEMS"] as $arItem):?>
        <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
        <? if ($i == 0): ?>
            <div class="home__banners-slide">
                <div class="container grid-3column">
        <?endif;?>
        <?
        $pictureType = $arItem["DISPLAY_PROPERTIES"]["PICTURE_TYPE"]["VALUE_XML_ID"];
        switch ($pictureType):
        case "small_picture":
        ?>
            <div class="grid__column">
                <a class="card-small" href="<?echo $arItem["DISPLAY_PROPERTIES"]["SIDE_BANNER_LINK"]["VALUE"]?>" target="_blank">
                    <div class="banner__arrow">
                        <? $APPLICATION->IncludeFile("/includes/svg/arrow_diagonally.html") ?>
                    </div>

                    <div class="card-small__text">
                        <div class="card-small__title">
                            <?echo $arItem["NAME"]?>
                        </div>

                        <div class="card-small__description">
                            <?echo $arItem["PREVIEW_TEXT"]?>
                        </div>
                    </div>

                    <div class="card-small__image">
                        <div class="base-icon-block">
                            <img src="<?echo $arItem["PREVIEW_PICTURE"]["SRC"]?>"
                                 alt="<?echo $arItem["PREVIEW_PICTURE"]["ALT"]?>"
                                 title="<?echo $arItem["PREVIEW_PICTURE"]["TITLE"]?>">
                        </div>
                    </div>
                </a>
            </div>
        <?break;
        case "background":
        $background = "background: url('".$arItem["PREVIEW_PICTURE"]["SRC"]."') no-repeat center";
        ?>
            <div class="grid__column">
                <a class="card-small card-small--with-bg" href="<?echo $arItem["DISPLAY_PROPERTIES"]["SIDE_BANNER_LINK"]["VALUE"]?>" target="_blank">
                    <div class="banner__arrow">
                        <? $APPLICATION->IncludeFile("/includes/svg/arrow_diagonally.html") ?>
                    </div>
                    <div class="card-small__bg" style="<?echo $background;?>">
                        <div class="card-small__mask"></div>
                    </div>
                    
                    <div class="card-small__text">
                        <div class="card-small__title">
                            <?echo $arItem["NAME"]?>
                        </div>

                        <div class="card-small__description">
                            <?echo $arItem["PREVIEW_TEXT"]?>
                        </div>
                    </div>
                </a>
            </div>
        <?break;
        case "icon":
        ?>
            <div class="grid__column">
                <a class="card-small" href="<?echo $arItem["DISPLAY_PROPERTIES"]["SIDE_BANNER_LINK"]["VALUE"]?>" target="_blank">
                    <div class="banner__arrow">
                        <? $APPLICATION->IncludeFile("/includes/svg/arrow_diagonally.html") ?>
                    </div>
                    <div class="card-small__text">
                        <div class="card-small__title">
                            <?echo $arItem["NAME"]?>
                        </div>

                        <div class="card-small__description">
                            <?echo $arItem["PREVIEW_TEXT"]?>
                        </div>
                    </div>

                    <div class="card-small__image">
                        <div class="base-icon-block">
                            <?echo $arItem["DISPLAY_PROPERTIES"]["SIDE_BANNER_ICON"]["VALUE"]?>
                        </div>
                    </div>
                </a>
            </div>
        <?break;?>
        <?endswitch?>
        <?
        $i++;
        if ($i == 6) {
            echo "</div></div>";
            $i = 0;
        }
        ?>
    <?endforeach;?>
    <?
    if ($i != 0 && $i < 6) {
        echo "</div></div>";
    }
    ?>
    </div>
    <div class="home-banners-slider__arrow-left">
        <div class="base-icon-block">
            <?$APPLICATION->IncludeFile("/includes/svg/slider_arrow_left.html");?>
        </div>
    </div>
    <div class="home-banners-slider__arrow-right">
        <div class="base-icon-block">
            <?$APPLICATION->IncludeFile("/includes/svg/slider_arrow_right.html");?>
        </div>
    </div>
</div>

