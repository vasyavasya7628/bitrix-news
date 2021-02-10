<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<?//var_dump($arResult);
//exit;?>
<nav class="site-menu__links-wrapper">
  <ul class="site-menu__links" data-target="site-menu.menu">
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

        <?if ($arItem["IS_PARENT"]):?>
          <?if ($arItem["DEPTH_LEVEL"] == 1):?>
            <li class="site-menu__link-item">
              <?
              if($arItem["SELECTED"]) {
                global $rootName;
                $rootName = $arItem["TEXT"];
              }
              ?>

              <a class="site-menu__link <?if($arItem["SELECTED"]):?>active<?endif;?>" href="<?=$arItem["LINK"]?>"
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
            <li class="links__item">
              <a class="links__link <?if($arItem["SELECTED"]):?>active<?endif;?>" href="<?=$arItem["LINK"]?>"
                <?if($arItem["PARAMS"]["TARGET"]):?>target="<?echo $arItem["PARAMS"]["TARGET"]?>"<?endif;?>
                ><?=$arItem["TEXT"]?>
              </a>
            </li>
          <?endif;?>
        <?else:?>
          <?if ($arItem["DEPTH_LEVEL"] == 1):?>
            <li class="site-menu__link-item">
              <a class="site-menu__link <?if($arItem["SELECTED"]):?>active<?endif;?>" href="<?=$arItem["LINK"]?>"
                <?if($arItem["PARAMS"]["TARGET"]):?>target="<?echo $arItem["PARAMS"]["TARGET"]?>"<?endif;?>
                ><?=$arItem["TEXT"]?>
              </a>
            </li>
          <?else:?>
            <li class="links__item">
              <a class="links__link <?if($arItem["SELECTED"]):?>active<?endif;?>" href="<?=$arItem["LINK"]?>"
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
  <button class="site-menu__all-sections"
    data-target="site-menu.button modal-window.opener"
    data-action="site-menu#toggleMenu modal-window#onOpen"
    data-modal-id="all-sections-modal">

    <span class="site-menu__all-sections-text">
      Все разделы
    </span>
    <svg class="icon" role="img"><use xlink:href="<?=ASSET_PATH?>icons.svg#dropdown-arrow"/></svg>
  </button>
</nav>