<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$obCache = new CPHPCache;
$cache_id  = 'munitsipalnye-palaty-page/'.$arParams['SECTION_CODE'];

if($obCache->InitCache($arParams['CACHE_TIME'], $cache_id, "/") && $arParams['CACHE_TYPE'] != 'N')
	extract($obCache->GetVars());
else {
	// Получаем информацию о родительском разделе
	$rsSections = CIBlockSection::GetList(array(), array('IBLOCK_ID' => $arParams['IBLOCK_ID'], 'ID' => $arResult['SECTIONS'][0]['IBLOCK_SECTION_ID']), false, $arParams['SECTION_USER_FIELDS']);
	if ($arSection = $rsSections->GetNext()) {
		$arResult['ROOT'] = $arSection;
	}

	if($obCache->StartDataCache()) {
		$arCache["arResult"] = $arResult;
		$obCache->EndDataCache($arCache);
	}
}

?>