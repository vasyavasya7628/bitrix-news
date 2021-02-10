<?php
\Bitrix\Main\Loader::includeModule('highloadblock');


$arSections = [];
$rs_Section = CIBlockSection::GetList(array('left_margin' => 'asc'), array('IBLOCK_ID' => $arParams["IBLOCK_ID"]));

while ( $ar_Section = $rs_Section->GetNext() )
{
    $section = array(
        'ID' => $ar_Section['ID'],
        'NAME' => $ar_Section['NAME'],
        'IBLOCK_SECTION_ID' => $ar_Section['IBLOCK_SECTION_ID'],
        'LEFT_MARGIN' => $ar_Section['LEFT_MARGIN'],
        'RIGHT_MARGIN' => $ar_Section['RIGHT_MARGIN'],
        'DEPTH_LEVEL' => $ar_Section['DEPTH_LEVEL'],
    );

    $arFilter = Array("IBLOCK_ID"=>$arResult["ID"], "SECTION_ID"=>$section["ID"]);
    $res = CIBlockElement::GetList(Array(), $arFilter);
    $arElements = [];
    while($ob = $res->GetNextElement()) {
        $arFields = $ob->GetFields();
        $arFields["PROPERTIES"] = $ob->GetProperties();
        $arElements[] = $arFields;
    }

    $section["ELEMENTS"] = $arElements;
    $arSections[] = $section;
}

$property = $arSections[0]["ELEMENTS"][0]["PROPERTIES"]["PRIORITY_PICTURE"];
if ($property["PROPERTY_TYPE"] == "S" && $property["USER_TYPE"] == "directory") {
    $rsData = \Bitrix\Highloadblock\HighloadBlockTable::getList(['filter' => ["TABLE_NAME" => $property["USER_TYPE_SETTINGS"]["TABLE_NAME"]]]);

    if ( !($hldata = $rsData->fetch()) ){
        //          echo 'Инфоблок не найден';
    } else {
        $hlentity = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hldata);
        $hlDataClass = $hldata['NAME'].'Table';
        $res = $hlDataClass::getList(array(
                'select' => array("*"),
                'order' => array(
                    'ID' => 'asc'
                )
            )
        );

        $hlElements = [];
        while($hlelement = $res->Fetch()) {
            $hlElements[$hlelement["UF_XML_ID"]] = $hlelement;
        }

        foreach ($arSections as $sectionKey => $section) {
            foreach ($section["ELEMENTS"] as $elementKey => $value) {
                $arSections[$sectionKey]["ELEMENTS"][$elementKey]["PROPERTIES"]["PRIORITY_PICTURE"]["VALUE"] = $hlElements[$arSections[$sectionKey]["ELEMENTS"][$elementKey]["PROPERTIES"]["PRIORITY_PICTURE"]["VALUE"]];
            }
        }
    }
}

$arResult["ITEMS"] = $arSections;
?>


