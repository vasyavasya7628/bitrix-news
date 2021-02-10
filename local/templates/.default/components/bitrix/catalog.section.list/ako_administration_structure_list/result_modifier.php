<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arViewModeList = array('LIST', 'LINE', 'TEXT', 'TILE');

$arDefaultParams = array(
	'VIEW_MODE' => 'LIST',
	'SHOW_PARENT_NAME' => 'Y',
	'HIDE_SECTION_NAME' => 'N'
);

$arParams = array_merge($arDefaultParams, $arParams);

if (!in_array($arParams['VIEW_MODE'], $arViewModeList))
	$arParams['VIEW_MODE'] = 'LIST';
if ('N' != $arParams['SHOW_PARENT_NAME'])
	$arParams['SHOW_PARENT_NAME'] = 'Y';
if ('Y' != $arParams['HIDE_SECTION_NAME'])
	$arParams['HIDE_SECTION_NAME'] = 'N';

$arResult['VIEW_MODE_LIST'] = $arViewModeList;

if (0 < $arResult['SECTIONS_COUNT'])
{
	if ('LIST' != $arParams['VIEW_MODE'])
	{
		$boolClear = false;
		$arNewSections = array();
		foreach ($arResult['SECTIONS'] as &$arOneSection)
		{
			if (1 < $arOneSection['RELATIVE_DEPTH_LEVEL'])
			{
				$boolClear = true;
				continue;
			}
			$arNewSections[] = $arOneSection;
		}
		unset($arOneSection);
		if ($boolClear)
		{
			$arResult['SECTIONS'] = $arNewSections;
			$arResult['SECTIONS_COUNT'] = count($arNewSections);
		}
		unset($arNewSections);
	}
}

if (0 < $arResult['SECTIONS_COUNT'])
{
	$boolPicture = false;
	$boolDescr = false;
	$arSelect = array('ID');
	$arMap = array();
	if ('LINE' == $arParams['VIEW_MODE'] || 'TILE' == $arParams['VIEW_MODE'])
	{
		reset($arResult['SECTIONS']);
		$arCurrent = current($arResult['SECTIONS']);
		if (!isset($arCurrent['PICTURE']))
		{
			$boolPicture = true;
			$arSelect[] = 'PICTURE';
		}
		if ('LINE' == $arParams['VIEW_MODE'] && !array_key_exists('DESCRIPTION', $arCurrent))
		{
			$boolDescr = true;
			$arSelect[] = 'DESCRIPTION';
			$arSelect[] = 'DESCRIPTION_TYPE';
		}
	}
    if ($boolPicture || $boolDescr)
	{
        foreach ($arResult['SECTIONS'] as $key => $arSection)
		{
			$arMap[$arSection['ID']] = $key;
		}
		$rsSections = CIBlockSection::GetList(array(), array('ID' => array_keys($arMap)), false, $arSelect);
		while ($arSection = $rsSections->GetNext())
		{
			if (!isset($arMap[$arSection['ID']]))
				continue;
			$key = $arMap[$arSection['ID']];
			if ($boolPicture)
			{
				$arSection['PICTURE'] = intval($arSection['PICTURE']);
				$arSection['PICTURE'] = (0 < $arSection['PICTURE'] ? CFile::GetFileArray($arSection['PICTURE']) : false);
				$arResult['SECTIONS'][$key]['PICTURE'] = $arSection['PICTURE'];
				$arResult['SECTIONS'][$key]['~PICTURE'] = $arSection['~PICTURE'];
			}
			if ($boolDescr)
			{
				$arResult['SECTIONS'][$key]['DESCRIPTION'] = $arSection['DESCRIPTION'];
				$arResult['SECTIONS'][$key]['~DESCRIPTION'] = $arSection['~DESCRIPTION'];
				$arResult['SECTIONS'][$key]['DESCRIPTION_TYPE'] = $arSection['DESCRIPTION_TYPE'];
				$arResult['SECTIONS'][$key]['~DESCRIPTION_TYPE'] = $arSection['~DESCRIPTION_TYPE'];
			}
		}
	}
}

/* Перебор и получение элементов больше второго уровня и разделов,
 у которых установлен переключатель "Показывать на странице Исполнительные органы гос. власти" */
foreach ($arResult["SECTIONS"] as $section) {
    if ($section["DEPTH_LEVEL"] >= 1 && $section["UF_EXECUTIVE_BRANCH"] == 1) {
        $section["MAN_PHOTO"] = CFile::GetPath($section["UF_MAN_PHOTO"]);
        $structureSections[$section["ID"]] = $section;
    }
}

$arElementSelect = array(
    "ID", "CODE", "EXTERNAL_ID", "IBLOCK_ID", "IBLOCK_SECTION_ID", "SORT", "NAME", "ACTIVE", "GLOBAL_ACTIVE", "PICTURE",
    "LEFT_MARGIN", "RIGHT_MARGIN", "DEPTH_LEVEL", "MODIFIED_BY",
    "DATE_CREATE", "DETAIL_PICTURE", "PROPERTY_STRUCTURE_CONTACT_FIO", "PROPERTY_STRUCTURE_CONTACT_PHOTO"
);
$elements_db = CIBlockElement::GetList(
    array("NAME"),
    array("IBLOCK_ID" => 7, "!PROPERTY_STRUCTURE_CONTACT_BOSS_VALUE" => false),
    false,
    false,
    $arElementSelect
);

while($element = $elements_db->GetNext()) {
    $element["CONTACT_FIO"] = $element["PROPERTY_STRUCTURE_CONTACT_FIO_VALUE"];
    // условие, чтобы не подставился начальник, без блока департамента
    if (isset($structureSections[$element["IBLOCK_SECTION_ID"]])) {
        $structureSections[$element["IBLOCK_SECTION_ID"]]["ELEMENT"] = $element;
    }
}
//var_dump($structureSections);

$arResult["SECTIONS"] = $structureSections;

?>