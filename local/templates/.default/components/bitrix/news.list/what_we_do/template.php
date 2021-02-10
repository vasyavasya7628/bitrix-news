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

<section class="projects-list">
  <header class="go-to-section">
    <a href="/deyatelnost/proekty/" class="go-to-section__link">
      <h2 class="go-to-section__title">Что мы делаем для Ямала</h2>
      <span class="go-to-link">
        Все проекты
        <svg class="icon" role="img"><use xlink:href="<?=ASSET_PATH?>icons.svg#dropdown-arrow"/></svg>
      </span>
    </a>
  </header>
  <div class="projects-list__wrapper">
    <div class="projects-list__slider slider"
      data-controller="slider" data-action="resize@window->slider#onResize">

      <div class="slider__wrapper" data-target="slider.scrollingWrapper">
        <?foreach ($arResult["ITEMS"] as $arItem):?>
            <?
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => 'Удалить'));

            $url = !empty($arItem['DETAIL_TEXT']) ? $arItem['DETAIL_PAGE_URL'] : $arItem["PROPERTIES"]["LINK"]["VALUE"];
            ?>
            <a id="<?=$this->GetEditAreaId($arItem['ID']);?>" href="<?=$url?>" class="slider__slide" data-target="slider.slide">
              <article class="project-card"
                data-controller="polar-lights-masked"
                data-auto-animated
                data-action="mousemove->polar-lights-masked#updateMaskPosition">

                <h4 class="project-card__title"><?=$arItem["NAME"]?></h4>
                <img class="project-card__illustration"
                  src="<?=CFile::GetPath($arItem["PROPERTIES"]["FILE"]["VALUE"])?>"
                  alt="<?=$arItem["NAME"]?>">

                <div class="polar-lights polar-lights--auto-animated">
                  <div class="polar-lights__mask" data-target="polar-lights-masked.mask"></div>
                </div>
              </article>
            </a>
        <?endforeach;?>
      </div>
      <button class="slider__prev hidden" data-target="slider.prev" data-action="slider#toggle">
        <svg class="icon" role="img"><use xlink:href="<?=ASSET_PATH?>icons.svg#dropdown-arrow"/></svg>
      </button>
      <button class="slider__next" data-target="slider.next" data-action="slider#toggle">
        <svg class="icon" role="img"><use xlink:href="<?=ASSET_PATH?>icons.svg#dropdown-arrow"/></svg>
      </button>
    </div>
  </div>
</section>
