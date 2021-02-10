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
?>

<section class="partners">
  <header class="go-to-section">
    <h2 class="partners__title">Наши партнёры</h2>
  </header>

  <div class="partners__wrapper">
    <div class="partners__slider slider"
      data-controller="slider"
      data-action="resize@window->slider#onResize">

      <div class="slider__shadow-wrapper">
        <div class="slider__wrapper" data-target="slider.scrollingWrapper">
          <?foreach ($arResult["ITEMS"] as $arItem):?>
            <?
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => 'Удалить'));
            ?>
            <a href="<?=$arItem["PROPERTIES"]["SIDE_BANNER_LINK"]["VALUE"]?>" 
                target="_blank" 
                id="<?=$this->GetEditAreaId($arItem['ID']);?>" 
                class="slider__slide" 
                data-target="slider.slide">
              <article class="partner-card">
                <h4 class="partner-card__title"><?=$arItem["NAME"]?></h4>
                <img class="partner-card__logotype"
                  src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"
                  alt="<?=$arItem["NAME"]?>">
                <div class="partner-card__description">
                  <?=$arItem["PREVIEW_TEXT"]?>
                </div>
              </article>
            </a>
          <?endforeach;?>
        </div>
      </div>
      <button class="slider__prev hidden" data-target="slider.prev" data-action="slider#toggle">
        <svg class="icon" role="img"><use xlink:href="<?=ASSET_PATH?>icons.svg#dropdown-arrow"/></svg>
      </button>
        <button class="slider__next <? if(count($arResult["ITEMS"]) < 4): ?>hidden<?endif;?>" data-target="slider.next" data-action="slider#toggle">
        <svg class="icon" role="img"><use xlink:href="<?=ASSET_PATH?>icons.svg#dropdown-arrow"/></svg>
      </button>
    </div>
  </div>
</section>
