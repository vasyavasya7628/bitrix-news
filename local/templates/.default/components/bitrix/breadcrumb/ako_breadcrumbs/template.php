<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
require_once("result_modifier.php");
/**
 * @global CMain $APPLICATION
 */
global $APPLICATION;
$arResult = $breadcrumbs;
//delayed function must return a string
if(empty($arResult))
	return "";
$strReturn = '';
$homeIcon =
    '<svg width="18" height="16" viewBox="0 0 18 16" version="1.1" xmlns="http://www.w3.org/2000/svg"
         xmlns:xlink="http://www.w3.org/1999/xlink">
        <g transform="translate(-8498 213)">
            <g>
                <use xlink:href="#home_icon_1" transform="translate(8498 -213)"/>
            </g>
        </g>
        <defs>
            <path id="home_icon_1" fill-rule="evenodd"
                  d="M 0 8.46807L 2.6978 8.46807L 2.6978 15.9999L 7.1977 15.9999L 7.1977 10.3526L 10.8022 10.3526L 10.8022 15.9999L 15.3023 15.9999L 15.3023 8.46807L 17.9999 8.46807L 9 0L 0 8.46807Z"/>
        </defs>
    </svg>';
$separatorIcon =
    '<svg width="7" height="12" viewBox="0 0 7 12" version="1.1" xmlns="http://www.w3.org/2000/svg"
         xmlns:xlink="http://www.w3.org/1999/xlink">
        <g transform="translate(-5652 -5033)">
            <g>
                <use xlink:href="#arrow_right_svg" transform="translate(5652 5033)" fill="#97A4B1"/>
            </g>
        </g>
        <defs>
            <path id="arrow_right_svg"
                  d="M 0 10.59L 4.32659 6L 0 1.41L 1.33198 0L 7 6L 1.33198 12L 0 10.59Z"/>
        </defs>
    </svg>';

//we can't use $APPLICATION->SetAdditionalCSS() here because we are inside the buffered function GetNavChain()
$css = $APPLICATION->GetCSSArray();
if(!is_array($css) || !in_array("/bitrix/css/main/font-awesome.css", $css))
{
	$strReturn .= '<link href="'.CUtil::GetAdditionalFileURL("/bitrix/css/main/font-awesome.css").'" type="text/css" rel="stylesheet" />'."\n";
}

$strReturn .=
    '<div class="breadcrumbs">
        <a class="breadcrumbs__home" href="/">
            <div class="base-icon-block">'.$homeIcon.'</div>
        </a>';

$itemSize = count($arResult);
for($index = 0; $index < $itemSize; $index++)
{
    $title = htmlspecialcharsex($arResult[$index]["TITLE"]);

    $nextRef = ($index < $itemSize - 2 && $arResult[$index + 1]["LINK"] <> "" ? ' itemref="bx_breadcrumb_' . ($index + 1) . '"' : '');
    $child = ($index > 0 ? ' itemprop="child"' : '');
    $arrow = '<div class="breadcrumbs__separator"><div class="base-icon-block">' . $separatorIcon . '</div></div>';

    $link = str_replace('pages/', '', $arResult[$index]["LINK"]);
    $strReturn .=
        $arrow . '
        <a class="breadcrumbs__link" href="' . $link . '" title="' . $title . '" itemprop="url" id="bx_breadcrumb_' . $index . '" itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"' . $child . $nextRef . '>
            ' . $title . '
        </a>';
}

$strReturn .= '</div>';

return $strReturn;
