<?php
// установка ссылок первых страниц разделов в качестве страниц разделов
// для установки ссылок на подразделы второго уровня, необходимо, чтобы в компоненте уровень вложенности был больше 2 (4 должно быть достаточно).

// echo '<div id="log">'.'<pre>'; print_r($arResult); echo '</pre>'.'</div>';
foreach ($arResult as $key => $item) {
    if ($item["IS_PARENT"]) {
        for($i = $key+1; $i < count($arResult); $i++) {
            if ($arResult[$i]["ITEM_TYPE"] == "P") {
                $arResult[$key]["LINK"] = $arResult[$i]["LINK"];
                break;
            }
            if($arResult[$i]["DEPTH_LEVEL"] == 1) {
                $arResult[$key]["LINK"] = $arResult[$key+1]["LINK"];
                break;
            }
        }
    }
}

// удаление глубоких элементов
foreach ($arResult as $key => $item) {
    if ($item["DEPTH_LEVEL"] > 2) {
        unset($arResult[$key]);
    }
}
$arResult = array_values($arResult);

foreach ($arResult as $key => $item) {
    if ($item["IS_PARENT"] && $item["DEPTH_LEVEL"] == 1) {
        $arResult[$key]["CHILD_COUNT"] = 0;
        for($i = $key+1; $i < count($arResult); $i++) {
            if ($arResult[$i]["CHAIN"][0] == $arResult[$key]['TEXT']) {
                $arResult[$key]["CHILD_COUNT"]++;
            } else {
                break;
            }
        }
    }

    // подборка ссылки для разделов которые формируются от данных из инфоблоков и не имеют статичного корневого left.menu
    if ($item["PARAMS"]['IBLOCK_ID'] != '' && $item["PARAMS"]['IBLOCK_TYPE'] != '') {
        $aSectionLinks = $APPLICATION->IncludeComponent(
            "bitrix:menu.sections",
            "",
            array(
                "CACHE_TIME" => "36000000",
                "CACHE_TYPE" => "A",
                "DEPTH_LEVEL" => "3",
                "IBLOCK_ID" => $item["PARAMS"]['IBLOCK_ID'], // ID вашего инфоблока,по разделам которого хотите построить меню
                "IBLOCK_TYPE" => $item["PARAMS"]['IBLOCK_TYPE'], //тип инфоблока
                "ID" => '',
                "IS_SEF" => "N",
                "SECTION_URL" => ""
            ),
            false
        );        

        foreach ($aSectionLinks as $child_key => $value) {
            if ($value[3]["IS_PARENT"]) {
                continue;
            } else {
                $arResult[$key]['LINK'] = $value[1];
                break;
            }
        }
    }
}