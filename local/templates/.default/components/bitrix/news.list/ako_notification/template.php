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

<?
if(count($arResult["ITEMS"]) > 0):
    $arItem = $arResult["ITEMS"][0];
//    if (is_null($_COOKIE["notificationStatusUpdateTime"])) {
//        setcookie("notificationStatusUpdateTime", time(), time() + 360000000);
//    }
    echo "<div style='display: none'>";
    var_dump($_COOKIE);
    var_dump(intval($_COOKIE["notificationStatusUpdateTime"]));
    var_dump(intval(date_timestamp_get(DateTime::createFromFormat('d.m.Y H:i:s',$arItem["TIMESTAMP_X"]))));
    echo "</div>";
    $clickNotificationFlag = (intval($_COOKIE["notificationStatusUpdateTime"]) < date_timestamp_get(DateTime::createFromFormat('d.m.Y H:i:s',$arItem["TIMESTAMP_X"])));
    echo "<div style='display: none'>";
    var_dump($clickNotificationFlag);
    echo "</div>";
//    $clickNotificationFlag = (date_timestamp_get(DateTime::createFromFormat('d.m.Y H:i:s',$_COOKIE["BITRIX_SM_LAST_VISIT"])) < date_timestamp_get(DateTime::createFromFormat('d.m.Y H:i:s',$arItem["TIMESTAMP_X"])));
?>
<div class="gosbar__notification-button <?if($clickNotificationFlag):?>gosbar__notification-button--unread<?endif?>">
    <span class="base-icon-block gosbar__visually-icon">
       <? $APPLICATION->IncludeFile("/includes/svg/bell_icon.html");?>
    </span>
    <div class="gosbar__notification">
        <div class="gosbar__notification-list">
            <?foreach ($arResult["ITEMS"] as $arItem):?>
            <div class="gosbar__notification-wrapper">
                <div class="gosbar__notification-date">
                    <?echo FormatDateFromDB($arItem["TIMESTAMP_X"], "DD MMMM YYYY, HH:MI");?>
                </div>
                <div class="gosbar__notification-title">
                    <?echo $arItem["NAME"];?>
                </div>
                <?if($arItem["PREVIEW_TEXT"]):?>
                <div class="gosbar__notification-description">
                        <?echo $arItem["PREVIEW_TEXT"];?>
                </div>
                <?endif;?>
            </div>
            <?endforeach;?>
        </div>
    </div>
</div>
<?else:?>
<!--Убираем кнопку-->
<?endif;?>
