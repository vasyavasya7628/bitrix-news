<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arViewModeList = array('LIST', 'LINE', 'TEXT', 'TILE');

$idsSections = [];

foreach ($arResult["SECTIONS"] as $section) {
	$idsSections[] = $section["ID"];
}

$arFilt = array('IBLOCK_ID'=>$arParams["IBLOCK_ID"], 'SECTION_ID' =>  $idsSections);

if($_REQUEST['query']) {
	$wordsArr = explode(" ", $_REQUEST['query']);

	foreach ($wordsArr as $key => $wordsArrItem) {
		$wordsArr[$key] = "%".$wordsArrItem."%";
	}

	$arFilt["PREVIEW_TEXT"] = $wordsArr;
}

$sor = array('SORT' => 'ASC');
$arRes =  CIBlockElement::GetList ($sor, $arFilt);

while($element = $arRes->getNextElement()) {
	foreach ($arResult["SECTIONS"] as $section_key => $section) {
		$doneAr = $element->GetFields();
		$doneAr["PROPERTIES"] = $element->GetProperties();
		if ($section["ID"] == $doneAr["IBLOCK_SECTION_ID"]) {
			$arResult["SECTIONS"][$section_key]["ELEMENTS"][] = $doneAr;
		}
	}
}
?>