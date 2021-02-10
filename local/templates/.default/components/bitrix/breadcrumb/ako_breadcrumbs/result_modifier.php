<?php
/**
 * По-умолчанию файл result_modifier не предусмотрен в компоненте breadcrumbs,
 * приходится подключать его вручную.
 * Т.к. в проекте не будет предусматриваться страница раздела,
 * а будет считаться первая страница раздела, приходится заново строить меню,
 * чтобы правильно расставить ссылки в хлебных крошках.
 */

// Подключаем библиотеки битрикса
require $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php";
global $APPLICATION;

$breadcrumbs = array();
$parsedCurrentPath = clearEmptyItems($_SERVER["REQUEST_URI"]);
// последний элемент не показывается
array_pop($parsedCurrentPath);
$defaultComponentTemplatePath = "/bitrix/templates/.default/components/bitrix/menu/ako_main_multilevel";

// Получаем структуру корневых разделов
$rootMenu = $APPLICATION->GetMenu("top", false, $defaultComponentTemplatePath, SITE_DIR);
$rootMenu->RecalcMenu(true);

/**
 * Рекурсивная функция получения полной структуры меню сайта.
 *
 * @param array $menu
 * @return array
 */
function buildSubMenu(array $menu)
{
    global $APPLICATION;
    global $defaultComponentTemplatePath;
    // массив в котором будет формироваться структура
    $finalMassive = array();

    $arMenuItems = $menu;
    foreach ($arMenuItems as $key => $value) {
        // получаем уровень вложенности на основе path
        $value = associateMenu($value);
        $value["DEPTH_LEVEL"] = count(clearEmptyItems($value["LINK"]));

        // если пункт является директорией, то помещаем его в финальный массив и получаем его дочерние элементы
        if ($value["ITEM_TYPE"] == "D") {
            $finalMassive[] = $value;

            $subMenu = $APPLICATION->GetMenu("left", false, $defaultComponentTemplatePath, $value["LINK"]);
            $subMenu->RecalcMenu(true);

            /* Если левое меню отсутствует, то рекурсия не останавливается и постоянно грузит грузит текущее меню и возникает StackOverflow.
               Чтобы избежать этого, требуется проверять разницу между меню текущим и предыждущим */
            if (empty(arrayRecursiveDiff($arMenuItems, $subMenu->arMenu)))
                break;

            // формируем подменю, вызывая эту же функцию
            if (count($subMenu->arMenu) > 0) {
                $subItems = buildSubMenu($subMenu->arMenu);

                // помещаем полученные элементы в исходный массив
                foreach ($subItems as $sub_key => &$sub_value) {
                    $sub_value["DEPTH_LEVEL"] = count(clearEmptyItems($sub_value["LINK"]));
                    $finalMassive[] = $sub_value;
                }
            }
        // иначе просто помещаем пункт в результативный массив
        } else {
            $finalMassive[] = $value;
        }
    }
    return $finalMassive;
}

/**
 * Исключает разделители из пути ссылки и возвращает массив элементов пути
 *
 * @param string $path
 * @return array
 */
function clearEmptyItems($path) {
    $result = array();

    $arMassive = explode("/", $path);

    foreach ($arMassive as $value) {
        if ($value <> "") $result[] =  $value;
    }

    return $result;
}

// Функция рекурсивного сравнения массивов из комментариев на функцию array_diff
function arrayRecursiveDiff($aArray1, $aArray2) {
    $aReturn = array();

    foreach ($aArray1 as $mKey => $mValue) {
        if ($mKey <> "DEPTH_LEVEL") {
            if (array_key_exists($mKey, $aArray2)) {
                if (is_array($mValue)) {
                    $aRecursiveDiff = arrayRecursiveDiff($mValue, $aArray2[$mKey]);
                    if (count($aRecursiveDiff)) {
                        $aReturn[$mKey] = $aRecursiveDiff;
                    }
                } else {
                    if ($mValue != $aArray2[$mKey]) {
                        $aReturn[$mKey] = $mValue;
                    }
                }
            } else {
                $aReturn[$mKey] = $mValue;
            }
        }
    }

    return $aReturn;
}

// Устанавливает необходимые ключи для пунктов подменю для построения breadcrumbs
function associateMenu($menuItem) {
    $associatedMenuItem = $menuItem;
    foreach ($menuItem as $menu_key => $menu_value) {
        if (is_numeric($menu_key)) {
            switch ($menu_key) {
                case 0:
                    $associatedMenuItem["TEXT"] = $menu_value;
                    break;
                case 1:
                    $associatedMenuItem["LINK"] = $menu_value;
                    $associatedMenuItem["ITEM_TYPE"] = strpos($menu_value, ".php") != false ? "P" : "D";
                    break;
                default:
                    continue;
            }
        }
    }
    return $associatedMenuItem;
}

// получаем полную структуру меню сайта
$fullMenu = buildSubMenu($rootMenu->arMenu);

// корневой путь, от которого будет идти построение ссылок
$currentPath = "/";

// проходим по пути страницы и строим хлебные крошки
foreach ($parsedCurrentPath as $path_key => $path_value) {
    // формируем текущий путь типа "/path/"
    $currentPath = $currentPath.$path_value."/";
    // флаг для определения дошел ли цикл до нужного пути
    $wasDir = false;
    // перебираем все меню
    foreach ($fullMenu as $menu_key => $menu_value) {
        // устанавливаем загаловок пункта breadcrumbs
        if ($menu_value["LINK"] == $currentPath) {
            $breadcrumbs[$path_key]["TITLE"] = $menu_value["TEXT"];
            $wasDir = true;
        }

        // если дошли до нужного пункта, то проверяем на наличие страниц в разделе
        if ($wasDir) {
            if ($menu_value["ITEM_TYPE"] == "D") {
                continue;
            } else {
                $breadcrumbs[$path_key]["LINK"] = $menu_value["LINK"];
                break;
            }
        }
    }
}