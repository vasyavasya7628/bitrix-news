<?
$arSectionList = array();
$rsSections = CIBlockSection::GetList(['NAME' => 'ASC'], ['IBLOCK_CODE' => 'meropriyatiya', 'ACTIVE' => 'Y'], false, ['ID', 'CODE', 'NAME']);
while ($arSection = $rsSections->Fetch())
{
  $arSectionList[$arSection['ID']] = [
    'CODE' => $arSection['CODE'],
    'NAME' => $arSection['NAME']
  ];
}

$arResult['SECTION_LIST'] = $arSectionList;