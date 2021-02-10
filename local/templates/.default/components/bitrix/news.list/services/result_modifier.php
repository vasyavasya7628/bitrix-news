<?
CModule::IncludeModule('iblock');

$rsSections = CIBlockSection::GetList(array('LEFT_MARGIN' => 'ASC'), ['IBLOCK_ID' => 18], false, ['ID', 'NAME', 'UF_LINK']);
while ($arSection = $rsSections->Fetch())
{
    $arResult['SECTIONS'][$arSection['ID']] = $arSection;
}

foreach ($arResult["ITEMS"] as $key => $arItem) {
    if($arItem['IBLOCK_SECTION_ID'] > 0) {
        $arResult['SECTIONS'][$arItem['IBLOCK_SECTION_ID']]['ITEMS'][] = $arItem;
        unset($arResult["ITEMS"][$key]);
    }
}
?>