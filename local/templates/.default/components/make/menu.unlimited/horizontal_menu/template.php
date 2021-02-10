<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
global $rootName;
?>

<?if (!empty($arResult["ITEMS"])):?>
  <header class="page-header">
    <h1 class="light"><?=$rootName?></h1>
    <div class="subsection-filter" data-controller="subsection-filter">
      <div class="subsection-filter__main" tabindex="-1">
        <ul class="links links--horizontal">
          <?foreach ($arResult['ITEMS'] as $arItem):?>
            <?if($arItem['DEPTH_LEVEL'] != 2) continue;?>
            <li class="links__item"><a class="links__link <?=$arItem['SELECTED'] ? 'active' : ''?>" href="<?=$arItem['LINK']?>"><?=$arItem['TEXT']?></a></li>
          <?endforeach;?>
        </ul>
      </div>

      <?if(count($arResult['CURRENT_SECTION']['CHILDS']) > 0):?>
        <div class="subsection-filter__additional">
          <ul class="links links--horizontal">
            <?foreach ($arResult['CURRENT_SECTION']['CHILDS'] as $arItem):?>
              <?if($arItem['DEPTH_LEVEL'] != 3) continue;?>
              <?if(strpos($arItem['LINK'], $arResult['CURRENT_SECTION']['ROOT']['LINK']) !== false):?>
              <li class="links__item">
                <a class="links__link <?=$arItem['SELECTED'] ? 'active' : ''?>" data-target="subsection-filter.item" href="<?=$arItem['LINK']?>"><?=$arItem['TEXT']?></a>
              </li>
              <?endif;?>
            <?endforeach;?>
          </ul>

          <div class="select" data-controller="select">
            <?foreach ($arResult['CURRENT_SECTION']['CHILDS'] as $arItem):?>
              <?if($arItem['DEPTH_LEVEL'] != 3 || $arItem['SELECTED'] != 1) continue;?>
              <button class="select__button" data-target="select.button" data-action="select#open">
                <span data-target="select.buttonLabel"><?=$arItem['TEXT']?></span>
                <svg class="icon" role="img"><use xlink:href="<?=ASSET_PATH?>icons.svg#dropdown-triangle"/></svg>
              </button>
            <?endforeach;?>
            
            <ul class="select__items" data-target="select.items">
              <?foreach ($arResult['CURRENT_SECTION']['CHILDS'] as $arItem):?>
                <?if($arItem['DEPTH_LEVEL'] != 3) continue;?>
                <li class="select__item <?=$arItem['SELECTED'] ? 'active' : ''?>"
                  data-action="click->select#setActive click->subsection-filter#reload">
                  <?=$arItem['TEXT']?>
                </li>
              <?endforeach;?>
            </ul>
          </div>
        </div>
      <?endif;?>
    </div>
  </header>
<?endif?>