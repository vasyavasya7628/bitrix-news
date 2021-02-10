<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$obCache = new CPHPCache;
$cache_id  = 'munitsipalnye-palaty-page';

if($obCache->InitCache($arParams['CACHE_TIME'], $cache_id, "/") && $arParams['CACHE_TYPE'] != 'N')
	extract($obCache->GetVars());
else {
	foreach ($arResult['SECTIONS'] as $key => $arSection) {
		$arMap[$arSection['ID']] = $key;
	}
	
	// Получаем 1-й дочерний раздел (это должен быть раздел с руководством) для всех разделов
	$rsSections = CIBlockSection::GetList(array("SORT" => "ASC"), array('IBLOCK_SECTION_ID' => array_keys($arMap)), false, $arSelect);
	if ($arSection = $rsSections->GetNext()) {
		$arResult['SECTIONS'][$arMap[$arSection['IBLOCK_SECTION_ID']]]['MAIN_SECTION_ID'] = $arSection['ID'];
	}

	if($obCache->StartDataCache()) {
		$arCache["arResult"] = $arResult;
		$obCache->EndDataCache($arCache);
	}
}

?>