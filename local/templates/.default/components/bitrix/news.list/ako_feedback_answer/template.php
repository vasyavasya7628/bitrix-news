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
<div class="news-list">
<?
require $_SERVER["DOCUMENT_ROOT"]."/lib/backParam.php";
?>
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
    <div id="<?=$arItem["ID"]?>" class="grid-2column-list virtual-reception-managment-block">
        <div>
            <div class="virtual-reception-managment__row">
                <div class="preview-small__description preview__small--tiny virtual-reception-managment__row-item">
                    <strong>ID <?=$arItem["ID"]?> от <?=ConvertDateTime($arItem["DATE_CREATE"], "DD.MM.YYYY HH:MI");?></strong>
                </div>
                <?if ($arItem['DISPLAY_PROPERTIES']['NUMBER_REQUEST']['VALUE']): ?>
                    <div class="preview-small__description preview__small--tiny virtual-reception-managment__row-item">
                        <strong>
                            № <?echo $arItem['DISPLAY_PROPERTIES']['NUMBER_REQUEST']['VALUE']; ?>
                            <?if ($arItem["DISPLAY_PROPERTIES"]["DATA_FIXED_REQUEST"]["VALUE"]):?>
                                от&nbsp;<?echo $arItem["DISPLAY_PROPERTIES"]["DATA_FIXED_REQUEST"]["VALUE"]?>
                            <?endif;?>
                        </strong>
                    </div>
                <?endif;?>
            </div>
            <div class="virtual-reception-managment__row">
                <a class="preview-small__title" href="<?=$arItem["DETAIL_PAGE_URL"].$backParamsString?>">
                    <?=$arItem["DISPLAY_PROPERTIES"]["FORM_TEXT_3"]["VALUE"]?>&nbsp;<?=$arItem["DISPLAY_PROPERTIES"]["FORM_TEXT_4"]["VALUE"]?>&nbsp;<?=$arItem["DISPLAY_PROPERTIES"]["FORM_TEXT_5"]["VALUE"]?>
                </a>
            </div>

            <div class="virtual-reception-managment__row">
                <?if ($arItem['DISPLAY_PROPERTIES']['FORM_TEXT_15']['VALUE']) { echo $arItem['DISPLAY_PROPERTIES']['FORM_TEXT_15']['VALUE']."&nbsp;"; }?>
                <?if ($arItem['DISPLAY_PROPERTIES']['FORM_TEXT_14']['VALUE']) { echo $arItem['DISPLAY_PROPERTIES']['FORM_TEXT_14']['VALUE']."&nbsp;"; }?>
                <?if ($arItem['DISPLAY_PROPERTIES']['FORM_TEXT_16']['VALUE']) { echo $arItem['DISPLAY_PROPERTIES']['FORM_TEXT_16']['VALUE']."&nbsp;"; }?>
                <?if ($arItem['DISPLAY_PROPERTIES']['FORM_TEXT_20']['VALUE']) { echo "ул. ".$arItem['DISPLAY_PROPERTIES']['FORM_TEXT_20']['VALUE']."&nbsp;"; }?>
                <?if ($arItem['DISPLAY_PROPERTIES']['FORM_TEXT_18']['VALUE']) { echo "к. ".$arItem['DISPLAY_PROPERTIES']['FORM_TEXT_18']['VALUE']."&nbsp;&nbsp;"; }?>
                <?if ($arItem['DISPLAY_PROPERTIES']['FORM_TEXT_19']['VALUE']) { echo "кв. ".$arItem['DISPLAY_PROPERTIES']['FORM_TEXT_19']['VALUE']."&nbsp;&nbsp;&nbsp;"; }?>
                <?if ($arItem['DISPLAY_PROPERTIES']['FORM_TEXT_19']['VALUE']):?>
                    <a href="mailto:<?=$arItem['DISPLAY_PROPERTIES']['FORM_EMAIL_22']['VALUE']?>"><?=$arItem['DISPLAY_PROPERTIES']['FORM_EMAIL_22']['VALUE']?></a>&nbsp;&nbsp;&nbsp;
                <?endif;?>
                <?if ($arItem['DISPLAY_PROPERTIES']['FORM_TEXT_21']['VALUE']) { echo $arItem['DISPLAY_PROPERTIES']['FORM_TEXT_21']['VALUE']; }?>
            </div>

            <div class="virtual-reception-managment__row preview-small__tag-block">
                <input type="checkbox" class="base-checkbox" <?if ($arItem["DISPLAY_PROPERTIES"]["NOTIFIED"]["VALUE_ENUM_ID"]):?>checked<?endif;?>>
                <label><? echo $arItem["PROPERTIES"]["NOTIFIED"]["NAME"]?></label>&nbsp;
                <?echo $arItem['DISPLAY_PROPERTIES']['DATE_NOTIFIED']['VALUE']?>
            </div>
            <?if ($arItem["DISPLAY_PROPERTIES"]["FORM_FILE_29"]['FILE_VALUE']):?>
                <div class="virtual-reception-managment__row">
                    <div class="virtual-reception-managment__row-item">
                        Прикрепленные документы:<br>
                        <?if(!is_null($arItem["DISPLAY_PROPERTIES"]["FORM_FILE_29"]['FILE_VALUE'][0])):?>
                            <? foreach($arItem["DISPLAY_PROPERTIES"]["FORM_FILE_29"]['FILE_VALUE'] as $file): ?>
                                <a target="_blank" href="<?=$file['SRC'];?>"><?=$file['FILE_NAME'];?></a>
                                <br>
                            <? endforeach; ?>
                        <?else:?>
                            <a target="_blank" href="<?=$arItem["DISPLAY_PROPERTIES"]["FORM_FILE_29"]['FILE_VALUE']['SRC'];?>"><?=$arItem["DISPLAY_PROPERTIES"]["FORM_FILE_29"]['FILE_VALUE']['FILE_NAME'];?></a>
                            <br>
                        <?endif;?>
                    </div>
                </div>
            <?endif;?>
        </div>
        <div>
            <div class="virtual-reception-managment__row">
                <div class="virtual-reception-managment__row-item scrollable-text-block scrollable-text-block--small">
                    <?=htmlspecialchars_decode($arItem['DISPLAY_PROPERTIES']['FORM_TEXTAREA_28']['VALUE']['TEXT']);?>
                </div>
            </div>
        </div>

    </div>
    <hr/>
    <br />
<?endforeach;?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
    <br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>
