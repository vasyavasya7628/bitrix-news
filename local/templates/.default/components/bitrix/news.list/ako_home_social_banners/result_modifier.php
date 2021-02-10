<?php
    \Bitrix\Main\Loader::includeModule('highloadblock');

    use Bitrix\Highloadblock as HL;
    $itemsWithPics = array();

    $hlblock = HL\HighloadBlockTable::getById(2)->fetch();
    $entity = HL\HighloadBlockTable::compileEntity($hlblock);
    $entityClass = $entity->getDataClass();

    $res = $entityClass::getList(array(
        'select' => array('*')
    ));

    $pics = $res->fetchAll();

    foreach($arResult["ITEMS"] as $arItem) {
        $modifyItem = $arItem;
        foreach ($pics as $key => $value) {
            if ($modifyItem["DISPLAY_PROPERTIES"]["SOCIAL_BANNER_PICTURE"]["VALUE"] == $value["UF_XML_ID"]) {
                $modifyItem["DISPLAY_PROPERTIES"]["SOCIAL_BANNER_PICTURE"]["VALUE"] = $value["UF_SVG_CODE"];
                $itemsWithPics[] = $modifyItem;
            }
        }
    }

    $arResult["ITEMS"] = $itemsWithPics;
?>