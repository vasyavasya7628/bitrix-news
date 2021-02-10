<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
global $APPLICATION;

$sections = CIBlockElement::GetElementGroups($arResult["ID"]);

while($section = $sections->GetNext()) {
	$sectionItem["NAME"] = $section["NAME"];
	$sectionItem["ID"] = $section["ID"];
	$sectionItem["URL"] = $section["SECTION_PAGE_URL"];
	$sectionItem["URL"] = str_replace('%2F', '/', $sectionItem["URL"]);
	$arResult["ELEMENT_IN_SECTIONS"][] = $sectionItem;
}

if (is_array($arResult["PROPERTIES"]["GALLERY_IMAGES"]["VALUE"])) {
	$galleryImgArr = $arResult["PROPERTIES"]["GALLERY_IMAGES"]["VALUE"];
	$galleryResult = [];

	foreach ($galleryImgArr as $imageId) {
		$galleryUrl = CFile::GetPath($imageId);
		$galleryResult[] = $galleryUrl;
	}

	$arResult["GALLERY_ITEMS"] = $galleryResult;

}

/* Подготовка информации для OpenGraph для использования ее в component_epilog дабы избежать кеширования */
$cp = $this->__component; // объект компонента

if (is_object($cp))
{
    // добавим в arResult компонента два поля - MY_TITLE и IS_OBJECT
    $cp->arResult['OG_TITLE'] = $arResult["NAME"];
    $cp->arResult['OG_DESCRIPTION'] = strip_tags(htmlspecialchars_decode($arResult["DETAIL_TEXT"]));
    $cp->arResult['OG_IMAGE'] = $arResult["DETAIL_PICTURE"]["SRC"];
    $cp->SetResultCacheKeys(array('OG_TITLE','OG_DESCRIPTION', 'OG_IMAGE'));
    // сохраним их в копии arResult, с которой работает шаблон
    $arResult['OG_TITLE'] = $cp->arResult['OG_TITLE'];
    $arResult['OG_DESCRIPTION'] = $cp->arResult['OG_DESCRIPTION'];
    $arResult['OG_IMAGE'] = $cp->arResult['OG_IMAGE'];

    $APPLICATION->SetTitle($cp->arResult['OG_TITLE']); // не будет работать на каждом хите:
//отработает только первый раз, затем будет все браться из кеша и вызова $APPLICATION->SetTitle()
// не будет. Поэтому изменение title делается в component_epilog, который выполняется на каждом хите.

}