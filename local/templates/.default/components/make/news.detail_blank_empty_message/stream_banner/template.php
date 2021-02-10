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
<a href="<?=$arResult["DISPLAY_PROPERTIES"]["LINK"]["VALUE"]?>" class="stream-banner__link" target="_blank">
    <div class="container">
        <div class="stream-banner-wrapper">
            <div class="stream-banner__left-column">
                <?if($arResult["DISPLAY_PROPERTIES"]["STREAM"]["VALUE_XML_ID"] == "stream"):?>
                    <div class="stream-red-dot"></div>
                <?endif;?>
                <div class="stream-banner__status">
                    <div class="tag-text">
                        <?=$arResult["DISPLAY_PROPERTIES"]["LINK_TYPE"]["VALUE"]?>
                    </div>
                </div>
                <div class="stream-banner__header">
                    <?=$arResult["DISPLAY_PROPERTIES"]["NAME"]["VALUE"]?>
                </div>
            </div>
            <div class="stream-banner__right-column">
                <div class="preview-big__image-block">
                    <div class="preview-big__image" style="background: url('<?=$arResult["PREVIEW_PICTURE"]["SRC"]?>');"></div>
                    <div class="preview__image-mask"></div>

                    <!-- <div class="base-icon-block-content preview-big__image-icon">
                        <div class="base-icon-block">
                            <?//$APPLICATION->IncludeFile("/includes/svg/video_preview_icon_small.html");?>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</a>
