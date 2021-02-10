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
global $arFooterFiles;
?>
<ul class="important-links" data-target="view-more.container">
  <?foreach ($arResult["ITEMS"] as $arItem):?>
    <?
    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => 'Удалить'));

    if($arItem['PROPERTIES']['FILE']['VALUE'] > 0):
      $path = CFile::GetPath($arItem['PROPERTIES']['FILE']['VALUE']);
      $arInfo = pathinfo($path);
      ?>
      <li class="important-links__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
        <a class="document-link" href="<?=$path?>" download="<?=$arItem["NAME"].'.'.$arInfo['extension']?>">
          <svg class="document-link__icon icon" role="img" viewBox="0 0 34 42">
            <!-- <use xlink:href="<?=ASSET_PATH?>icons.svg#paper"/> -->
              <path d="M0 2C0 0.89543 0.895431 0 2 0H24L34 11V40C34 41.1046 33.1046 42 32 42H2C0.89543 42 0 41.1046 0 40L0 2Z"/>
              <path d="M24 0L34 11V13H23C22.4477 13 22 12.5523 22 12L22 0H24Z" fill="#d9d9de"/>
              <rect x="8" y="24" width="14" height="2" rx="1" fill="#333"/>
              <rect x="8" y="32" width="8" height="2" rx="1" fill="#333"/>
          </svg>
          <span class="document-link__title">
            <span class="document-link__name">
              <?if(!empty($arItem["PREVIEW_TEXT"])):?>
                <?=$arItem["PREVIEW_TEXT"]?>
              <?else:?>
                <?=$arItem["NAME"]?>
              <?endif;?>
            </span>
            <span class="document-link__data"><?=strtoupper($arInfo['extension']);?> (<?=getFileSize(filesize($_SERVER["DOCUMENT_ROOT"].$path))?>)</span>
          </span>
        </a>
      </li>
    <?elseif($arItem['PROPERTIES']['PHONE']['VALUE']):?>
      <li class="important-links__item">
        <a class="phone-link" href="tel:+<?=preg_replace('/[^0-9.]+/', '', $arItem['PROPERTIES']['PHONE']['VALUE']);?>">
          <span class="phone-link__title-wrapper">
            <svg class="phone-link__icon icon" role="img"><use xlink:href="<?=ASSET_PATH?>icons.svg#phone"/></svg>
            <span class="phone-link__title">
              <span class="phone-link__text">
                <?=$arItem["NAME"]?>
              </span>
            </span>
          </span>
          <span class="phone-link__number"><?=$arItem['PROPERTIES']['PHONE']['VALUE']?></span>
        </a>
      </li>
    <?else:?>
      <?
      $icon = ASSET_PATH.'stub/34.png';
      if(!empty($arItem['PREVIEW_PICTURE']['SRC'])) $icon = $arItem['PREVIEW_PICTURE']['SRC'];
      ?>
      <li class="important-links__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
        <a class="document-link document-link--external" href="<?=$arItem['PROPERTIES']['LINK']['VALUE']?>" target="_blank" rel="nofollow noreferer">
          <img class="document-link__icon" src="<?=$icon?>" alt="">
          <span class="document-link__title">
            <span class="document-link__name"><?=$arItem["NAME"]?></span>
            <span class="document-link__data"><?=$arItem['PROPERTIES']['LINK_NAME']['VALUE']?></span>
          </span>
        </a>
      </li>
    <?endif;?>
  <?endforeach;?>
</ul>

<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
    <?=$arResult["NAV_STRING"]?>
<?endif;?>