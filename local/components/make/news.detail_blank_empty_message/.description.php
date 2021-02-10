<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => GetMessage("T_IBLOCK_DESC_DETAIL_WITH_NO_404"),
	"DESCRIPTION" => GetMessage("T_IBLOCK_DESC_DETAIL_WITH_NO_404_DESC"),
	"ICON" => "/images/news_detail.gif",
	"SORT" => 30,
	"CACHE_PATH" => "Y",
	"PATH" => array(
		"ID" => "make",
		"CHILD" => array(
			"ID" => "news1",
			"NAME" => GetMessage("T_IBLOCK_DESC_WITH_NO_404_NEWS"),
			"SORT" => 10,
			"CHILD" => array(
				"ID" => "news_cmpx",
			),
		),
	),
);

?>