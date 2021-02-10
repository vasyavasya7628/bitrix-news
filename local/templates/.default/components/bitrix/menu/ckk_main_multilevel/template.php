<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

// можно попробовать в этом шаблоне опредилить рутовую ссылку для документов и подставлять ее тут
?>

<div class="gos-header__wrapper">
  <a href="/" class="site-menu__logotype">
    <svg class="site-menu__logotype-symbol" role="img">
      <use class="logotype-ckk-symbol" xlink:href="<?= ASSET_PATH?>icons.svg#logotype-ckk-symbol"/>
    </svg>
    <svg class="site-menu__logotype-text" role="img">
      <use class="logotype-ckk-text" xlink:href="<?= ASSET_PATH?>icons.svg#logotype-ckk-text"/>
    </svg>
  </a>
  <ul data-target="gos-header.menu" class="gos-header__navigation-block">
    <?$previousLevel = 0;
    $lastSkippedItem = null;
    foreach ($arResult as $key => $arItem):?>

      <?
      if ($arItem["DEPTH_LEVEL"] == 1 && $arItem["PARAMS"]["IS_VISIBLE"] == "false") {
          $lastSkippedItem = $arItem;
      } elseif ($arItem["DEPTH_LEVEL"] == 1) {
          $lastSkippedItem = null;
      }?>

      <?if (is_null($lastSkippedItem)):?>

        <?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
            <?=str_repeat("</ul></div></div></div></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
        <?endif;?>
        
        <?if ($arItem["DEPTH_LEVEL"] == 1){
            if($arItem["SELECTED"]) {
            global $rootName;
            $rootName = $arItem["TEXT"];
          }
        }?>

        <?if ($arItem["IS_PARENT"]):?>
          <?if ($arItem["DEPTH_LEVEL"] == 1):?>
            <li class="gos-header__navigation-item">      

              <a class="gos-header__button" href="<?=$arItem["LINK"]?>"
                <?if($arItem["PARAMS"]["TARGET"]):?>target="<?echo $arItem["PARAMS"]["TARGET"]?>"<?endif;?>
                ><?=$arItem["TEXT"]?>
              </a>
    
              <div id="submenu-<?=$key?>" class="site-submenu" data-turbolinks-permanent>
                <h2 class="site-submenu__title"><?=$arItem["TEXT"]?></h2>
                <?$hasIncludeArea = filesize($_SERVER['DOCUMENT_ROOT'].$arItem["OLD_LINK"]."sect_description.php") > 0; ?>
                <div class="site-submenu__wrapper <?/*if($hasIncludeArea):?>grid-2column-list<?else:?>grid-3column<?endif;*/?>">
                  <div class="site-submenu__column">
                    <p class="site-submenu__description">
                      <?= $arItem["PARAMS"]["TEXT"]?>
                    </p>
                    <a href="/" class="button button--default">Подробнее</a>
                  </div>
      
                  <div class="site-submenu__column">
                    <ul class="links">
          <? else: ?>
            <li class="gos-header__navigation-item">
              <a class="gos-header__button" href="<?=$arItem["LINK"]?>"
                <?if($arItem["PARAMS"]["TARGET"]):?>target="<?echo $arItem["PARAMS"]["TARGET"]?>"<?endif;?>
                ><?=$arItem["TEXT"]?>
              </a>
            </li>
          <?endif;?>
        <?else:?>
          <?if ($arItem["DEPTH_LEVEL"] == 1):?>
            <li class="gos-header__navigation-item">
              <a class="gos-header__button" href="<?=$arItem["LINK"]?>"
                <?if($arItem["PARAMS"]["TARGET"]):?>target="<?echo $arItem["PARAMS"]["TARGET"]?>"<?endif;?>
                ><?=$arItem["TEXT"]?>
              </a>
            </li>
          <?else:?>
            <li class="gos-header__navigation-item">
              <a class="gos-header__button" href="<?=$arItem["LINK"]?>"
                <?if($arItem["PARAMS"]["TARGET"]):?>target="<?echo $arItem["PARAMS"]["TARGET"]?>"<?endif;?>
                ><?=$arItem["TEXT"]?>
              </a>
            </li>

          <?endif;?>
        <?endif;?> <?// endif: $arItem["IS_PARENT"] ?>
      <?endif;?> <?// endif: is_null($lastSkippedItem) ?>
      <?$previousLevel = $arItem["DEPTH_LEVEL"];?>
    <?endforeach;?>
            </ul>
          </div>
        </div>
      </div>
    </li>
  </ul>
  <button data-target="gos-header.burger" data-action="gos-header#toggleMenu" class="gos-header__menu-burger gos-header__button">
    <div class="icon">
      <div class="line1"></div>
      <div class="line2"></div>
      <div class="line3"></div>
    </div>
  </button>
</div>