<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

$arFilter = array(
    'IBLOCK_ID' => $arResult['IBLOCK_ID'],
    'ID' => $arResult['IBLOCK_SECTION_ID']
);

$arSelect = array(
    'PROPERTY' => 'UF_*'
);

$section = CIBlockSection::GetList(Array("SORT"=>"ASC"), $arFilter, false, $arSelect);

$section = $section->GetNext();

$arResult['SECTION_DATA'] = $section;
?>