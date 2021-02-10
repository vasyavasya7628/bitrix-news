<?php
// установка ссылок первых страниц разделов в качестве страниц разделов
// для установки ссылок на подразделы второго уровня, необходимо, чтобы в компоненте уровень вложенности был больше 2 (4 должно быть достаточно).
foreach ($arResult as $key => $item) {
    if ($item["IS_PARENT"]) {
        for($i = $key+1; $i < count($arResult); $i++) {
            if ($arResult[$i]["ITEM_TYPE"] == "P") {
                $arResult[$key]["LINK"] = $arResult[$i]["LINK"];
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