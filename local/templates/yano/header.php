<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
use Bitrix\Main\Page\Asset;
?>
<!DOCTYPE html>
<html>
  <head>
    <title><?$APPLICATION->ShowTitle()?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta property="og:title" content="<?$APPLICATION->ShowProperty("og:title");?>">
    <meta property="og:description" content="<?$APPLICATION->ShowProperty("og:description");?>">
    <meta property="og:image" content="<?$APPLICATION->ShowProperty("og:image");?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Cache-Control" content="max-age=3600, must-revalidate" />
    <meta name="HandheldFriendly" content="true">
    <meta name="MobileOptimized" content="320">
    <meta http-equiv="content-language" content="ru"/>

    <?$APPLICATION->ShowHead();?>
    
    <?Asset::getInstance()->addCss(ASSET_PATH . "app.css");?>
    <meta name="turbolinks-cache-control" content="no-preview">
    <script src="<?= ASSET_PATH?>app.js?v=<?=filemtime($_SERVER["DOCUMENT_ROOT"].ASSET_PATH.'app.js')?>" defer></script>
  </head>
  <?$APPLICATION->ShowPanel(); ?>
  <body data-controller="modal-window notifications"
    data-action="keyup@document->modal-window#onKeypress information->notifications#showInfo error->notifications#showError">

    <header class="gos-header gos-header--spaced" data-controller="gos-header">
      <?$APPLICATION->IncludeComponent(
        "bitrix:menu", 
        "ckk_main_multilevel", 
        array(
          "ALLOW_MULTI_SELECT" => "N",
          "CHILD_MENU_TYPE" => "left",
          "DELAY" => "N",
          "MAX_LEVEL" => "4",
          "MENU_CACHE_GET_VARS" => array(
          ),
          "MENU_CACHE_TIME" => "3600",
          "MENU_CACHE_TYPE" => "A",
          "MENU_CACHE_USE_GROUPS" => "Y",
          "ROOT_MENU_TYPE" => "top",
          "USE_EXT" => "N",
          "COMPONENT_TEMPLATE" => "ako_main_multilevel"
        ),
        false
      );?>
    </header>

    <?if($_SERVER["SCRIPT_NAME"] !== "/index.php"):?>
      <section class="page-section <?if ($APPLICATION->GetDirProperty('BOTTOM_PADDING') === 'N'):?>page-section--no-padding<?endif;?>" data-controller="<?if ($APPLICATION->GetDirProperty('VIEW_MORE') === 'Y'):?>view-more<?endif;?> <?if ($_SERVER['DOCUMENT_URI'] === '/projects/index.php'):?>project-filter<?endif;?>">
    <?endif;?>
    
    <?if($APPLICATION->GetDirProperty('HORIZONTAL_MENU') === 'Y'):?>
      <?$APPLICATION->IncludeComponent(
        "make:menu.unlimited", 
        "horizontal_menu", 
        array(
          "ALLOW_MULTI_SELECT" => "N",
          "CHILD_MENU_TYPE" => "left",
          "DELAY" => "N",
          "MAX_LEVEL" => "50",
          "MENU_CACHE_GET_VARS" => array(
          ),
          "MENU_CACHE_TIME" => "3600",
          "MENU_CACHE_TYPE" => "A",
          "MENU_CACHE_USE_GROUPS" => "Y",
          "ROOT_MENU_TYPE" => "top",
          "USE_EXT" => "Y",
          "COMPONENT_TEMPLATE" => "horizontal_menu"
        ),
        false
      );?>
    <?endif;?>

    <?if($APPLICATION->GetDirProperty('STATIC') === 'Y'):?>
      <div class="grid-container content-block">
    <?endif;?>