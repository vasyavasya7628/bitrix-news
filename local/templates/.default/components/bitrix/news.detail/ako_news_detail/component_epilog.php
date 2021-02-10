<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
global $APPLICATION;
$APPLICATION->SetPageProperty("og:title", $arResult["OG_TITLE"]);
$APPLICATION->SetPageProperty("og:description", strip_tags(htmlspecialchars_decode($arResult["OG_DESCRIPTION"])));
$APPLICATION->SetPageProperty("og:image", $_SERVER["REQUEST_SCHEME"]."://".$_SERVER['HTTP_HOST'].$arResult["OG_IMAGE"]);