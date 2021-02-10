<?php
$arRootSectionItems = array(); // все элементы корневого раздела
$arSectionByCurrentPage = array(); // страницы текущего раздела
$rootSection = null;    // определяем активный корневой раздел
$currentLevel = 2; // текущий уровень 2, т.к. корневой раздел не учитывается

// находим корневой раздел
foreach ($arResult as $item) {
    if ($item["DEPTH_LEVEL"] == 1 && $item["SELECTED"]) {
        $rootSection = $item;
    }
}

// парсим путь коневого раздела и находим название раздела в URL
$parsedRootPath = explode("/", $rootSection["LINK"]);
$rootString = "";
foreach ($parsedRootPath as $value) {
    if ($value <> "") {
        $rootString = $value;
    }
}

// Находим элементы меню, найденого корневого раздела
// При идущих подряд разделах. находится первая вложенная страница
foreach ($arResult as $key => &$value) {
    if ($value["DEPTH_LEVEL"] > 1 && (strpos($value["LINK"], $rootString) == 1 || strpos($value["PARAMS"]["PARENT_PATH"], $rootString) == 1)) {
        $arRootSectionItems[] = $value;
    }
}

// Исключаем возможные дубликаты
foreach ($arRootSectionItems as $key_parent => $value_parent) {
    $duplicatedItems = [];

    foreach ($arRootSectionItems as $key_child => $value_child) {
        if ($value_child["LINK"] == $value_parent["LINK"]) {
            $duplicatedItems[$key_child] = $value_child;
        }
    }
    
    // Исключаем элемент с названием раздела
    foreach ($duplicatedItems as $key => $value) {
        if ($value['TEXT'] == $rootSection['TEXT']) {
            unset($duplicatedItems[$key]);
            unset($arRootSectionItems[$key]);
        }
    }

    // минимум должен быть 1 элемент
    if (count($duplicatedItems) > 1) {
        $i = 0;
        $parentCount = 0;

        // проверяем число дубликатов-родителей (фикс на случай если используется menu_ext для задания дочерних разделов)
        foreach ($duplicatedItems as $key => $value) {
            if ($value['IS_PARENT'])
                $parentCount++;
        }

        foreach ($duplicatedItems as $key => $value) {
            if ($parentCount > 0)
                $arRootSectionItems[$key]['IS_PARENT'] = true;

            if ($i > 0)
                unset($arRootSectionItems[$key]);
            $i++;
        }
    }
}

// находим текущий раздел
$parent_key = false;
foreach ($arRootSectionItems as $key => $value) {
    if ($value["IS_PARENT"] && $value["SELECTED"]) {
        $arSectionByCurrentPage["ROOT"] = $value;
        $arSectionByCurrentPage["ROOT"]["KEY"] = $key;
    }
    
    if ($value["IS_PARENT"] && $value['DEPTH_LEVEL']) {
        $parent_key = $key;
    }
    elseif($parent_key !== false) {
        $arRootSectionItems[$parent_key]['LINK'] = $value['LINK'];
        $parent_key = false;
    }
}

if ($arSectionByCurrentPage["ROOT"]) {
    // получаем коренной путь текущего раздела
    $currentSectionPath = "/";
    $currentSectionPathArray = explode("/", $arSectionByCurrentPage["ROOT"]["LINK"]);
    for ($i = 0; $i < count($currentSectionPathArray) - 1; $i++) {
        if ($currentSectionPathArray[$i] <> "") {
            $currentSectionPath = $currentSectionPath.$currentSectionPathArray[$i]."/";
        }
    }

    $arSectionByCurrentPage["ROOT"]["SECTION_PATH"] = $currentSectionPath;

    // получаем страницы этого раздела и его подразделов
    $currentIndex = 0;
    foreach ($arRootSectionItems as $key => $value) {
        if ($value["ITEM_INDEX"] == 0 && $value["LINK"] <> $arSectionByCurrentPage["ROOT"]["SECTION_PATH"]) {
            if (strpos($value["LINK"], $currentSectionPath) !== false) {
                $arSectionByCurrentPage["CHILDS"][] = $value;
                $currentIndex = $value["ITEM_INDEX"];
            }
        } else {
            if (strpos($value["LINK"], $currentSectionPath) !== false && $arSectionByCurrentPage["ROOT"]["LINK"] <> $value["LINK"]) {
                $arSectionByCurrentPage["CHILDS"][] = $value;
                $currentIndex = $value["ITEM_INDEX"];
            }
        }
    }
} else {
    $arSectionByCurrentPage["ROOT"] = $rootSection;
    $arSectionByCurrentPage["ROOT"]["LINK"] = null;
}

$arResult = array();
$arResult["ITEMS"] = $arRootSectionItems;
$arResult["CURRENT_SECTION"] = $arSectionByCurrentPage;


global $arSectionChild;
if(count($arResult['CURRENT_SECTION']['CHILDS']) > 1)
    $arSectionChild = $arResult['CURRENT_SECTION']['CHILDS'];
else {
    foreach ($arResult['ITEMS'] as $arItem) {
        if($arItem['DEPTH_LEVEL'] != 2) continue;
        else $arSectionChild[] = $arItem;
    }
}