<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$obCache = new CPHPCache;
$cache_id  = 'other-sites-block';

if($obCache->InitCache($arParams['CACHE_TIME'], $cache_id, "/") && $arParams['CACHE_TYPE'] != 'N')
	extract($obCache->GetVars());
else {
	foreach ($arResult['SECTIONS'] as $key => $arSection) {
		$rsSections = CIBlockElement::GetList(array("SORT" => "ASC"), array('IBLOCK_SECTION_ID' => $arSection['ID']), false, false, array('NAME', 'CODE', 'PROPERTY_SIDE_SITE_LINK'));
		while ($arElement = $rsSections->GetNext()) {
			$arResult['SECTIONS'][$key]['ITEMS'][] = $arElement;
		}
	}

	if($obCache->StartDataCache()) {
		$arCache["arResult"] = $arResult;
		$obCache->EndDataCache($arCache);
	}
}
?>