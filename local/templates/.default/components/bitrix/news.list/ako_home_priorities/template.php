<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

$count = count($arResult["ITEMS"]);
?>

<section class="useful-links">
  <h2 class="useful-links__title">Полезные ссылки</h2>
  <div class="grid-container">
    <div class="spoiler" data-controller="accordion" data-action="resize@window->accordion#recalculate">
      <div class="useful-links__list spoiler__content" data-target="accordion.content" data-show-number="<?=($count > 6) ? 6 : $count?>">
        <?
        foreach ($arResult["ITEMS"] as $arItem):?>
        <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>

        <a href="<?=$arItem["PROPERTIES"]["PRIORITY_LINK"]["VALUE"]?>" target="_blank" class="useful-links__link" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
          <span class="useful-links__link-wrapper">
            <span class="useful-links__link-heading"><?=$arItem["NAME"]?></span>
          </span>
          <span class="useful-links__url">
            <?=$arItem["PROPERTIES"]["ADDITIONAL_TEXT"]["VALUE"]?>
          </span>
        </a>

        <?endforeach?>
      </div>
      <?if($count > 6):?>
        <button class="spoiler__button" data-action="accordion#toggle">
          Посмотреть все
          <svg class="icon" role="img"><use xlink:href="<?=ASSET_PATH?>icons.svg#dropdown-arrow"/></svg>
        </button>
      <?endif;?>
    </div>
  </div>
</section>
