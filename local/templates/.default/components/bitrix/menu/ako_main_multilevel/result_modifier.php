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
}