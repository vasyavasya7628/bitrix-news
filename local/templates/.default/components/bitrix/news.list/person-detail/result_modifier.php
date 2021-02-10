<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$obCache = new CPHPCache;
$cache_id  = 'o-palate-group-list';

if($obCache->InitCache($arParams['CACHE_TIME'], $cache_id, "/") && $arParams['CACHE_TYPE'] != 'N')
	extract($obCache->GetVars());
else {
	$arGroupList = array();
	$rsSections = CIBlockSection::GetList(array(), array('IBLOCK_ID' => $arParams['IBLOCK_ID']));
	while ($arSection = $rsSections->GetNext()) {
		if($arSection['DEPTH_LEVEL'] == 1)
			$arGroupList[$arSection['ID']] = array(
				'CODE' => $arSection['CODE'],
				'NAME' => $arSection['NAME'],
				'LINK' => $arSection['LIST_PAGE_URL'].$arSection['CODE'].'.php'
			);
		else
			$arGroupList[$arSection['IBLOCK_SECTION_ID']]['CHILD'][$arSection['ID']] = array(
				'NAME' => $arSection['NAME'],
				'LINK' => $arGroupList[$arSection['IBLOCK_SECTION_ID']]['LINK'].'#'.$arSection['CODE']
			);
		}

	if($obCache->StartDataCache()) {
		$arCache["arGroupList"] = $arGroupList;
		$obCache->EndDataCache($arCache);
	}
}

$arResult['GROUP_LIST'] = $arGroupList;
?>