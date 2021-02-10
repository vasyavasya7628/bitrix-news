<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

$arResult["ANSWER"] = array();
foreach ($arResult["PROPERTIES"]["ANSWER"]["VALUE"] as $key => $arAnswer):

	$res = CIBlockElement::GetByID($arAnswer);
	$ar_res = $res->GetNext();

	$arItemAnswer = array();

	$arItemAnswer = $ar_res;

	// <!-- Информация об авторе отвечающего  -->

	$db_props = CIBlockElement::GetProperty(11, $arAnswer, array("sort" => "asc"), Array("ID_ADMINISTRATION"));
	$ar_props = $db_props->Fetch();

	$arSelect = Array("ID", "IBLOCK_ID", "NAME", "PREVIEW_PICTURE", "DATE_ACTIVE_FROM","PROPERTY_*");
	$arFilter = Array("IBLOCK_ID"=>IntVal(12), "ID"=>IntVal($ar_props["VALUE"]));
	$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
	while($ob = $res->GetNextElement()) {
		$arFields = $ob->GetFields();
		$arItemAnswer["ADMINISTRATION"] = array();		
		$arItemAnswer["ADMINISTRATION"] = $ob->GetProperties();
		$arItemAnswer["ADMINISTRATION"]["IMG"] = CFile::GetFileArray($arFields['PREVIEW_PICTURE']);
	}

	$arResult["ANSWER"][] = $arItemAnswer;
endforeach;

?>