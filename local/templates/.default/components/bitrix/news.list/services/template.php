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
<section class="services-for-citizens"
  data-controller="polar-lights-masked"
  data-action="mousemove->polar-lights-masked#updateMaskPosition">

  <h2 class="services-for-citizens__title">Сервисы для&nbsp;граждан</h2>
  <div class="services-list">
    <?foreach ($arResult["ITEMS"] as $arItem):?>
    <?
    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => 'Удалить'));
    ?>
      <div class="service-card" id="<?=$this->GetEditAreaId($arItem['ID']);?>" style="background-image: url(<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>)">
        <div class="service-card__link-wrapper">
          <a href="<?=$arItem["PROPERTIES"]["LINK"]["VALUE"]?>" class="service-card__link service-card__link--main">
            <h4 class="service-card__title"><?=$arItem["NAME"]?></h4>
          </a>
        </div>
        <span class="service-card__extra-info">
          <?=$arItem["PREVIEW_TEXT"]?>
        </span>
      </div>
    <?endforeach;?>

    <?if(!empty($arResult["SECTIONS"])):?>
      <?foreach ($arResult["SECTIONS"] as $arSection):?>
        <?
        $arButton = false;
        ?>
        <div class="service-card content-block">
          <a href="<?=$arSection["UF_LINK"]?>" class="service-card__link">
            <h4 class="service-card__title"><?=$arSection["NAME"]?></h4>
          </a>
          <p class="service-card__links">
          <?foreach ($arSection["ITEMS"] as $arItem):?>
            <?if($arItem["PREVIEW_TEXT"] == 'BUTTON') {
              $arButton = $arItem;
              continue;
            }?>
            <a href="<?=$arItem["PROPERTIES"]["LINK"]["VALUE"]?>" class="service-card__link"><?=$arItem["NAME"]?></a>
            <?endforeach;?>
          </p>
          <?if($arButton):?>
            <a href="<?=$arButton["PROPERTIES"]["LINK"]["VALUE"]?>" class="button button--default"><?=$arButton["NAME"]?></a>
          <?endif;?>
        </div>
      <?endforeach;?>
    <?endif;?>

  </div>
  <div class="polar-lights polar-lights--dim">
    <div class="polar-lights__mask" data-target="polar-lights-masked.mask"></div>
  </div>
</section>
