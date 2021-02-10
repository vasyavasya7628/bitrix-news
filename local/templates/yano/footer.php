    <?if($APPLICATION->GetDirProperty('STATIC') === 'Y'):?>
      </div>
    <?endif;?>
    <?if($_SERVER["SCRIPT_NAME"] !== "/index.php"):?>
      </section>
    <?endif;?>

    <?/* Вывод разделов текущего уровня, кроме текущего раздела*/
    /*global $arSectionChild;
    if(!empty($arSectionChild)):?>
      <section class="see-also">
        <h2>Смотрите также</h2>
        <div class="see-also__links">
          <?foreach ($arSectionChild as $arItem):?>
            <?if($arItem['SELECTED']) continue;?>
            <a class="see-also__link" href="<?=$arItem['LINK']?>"><?=$arItem['TEXT']?></a>
          <?endforeach;?>
        </div>
        <br>
        <?
        global $arDocFilter;
        if($arDocFilter['IBLOCK_SECTION_ID'] > 0):
          $arDocFilter = ['IBLOCK_SECTION_ID' => $arDocFilter['IBLOCK_SECTION_ID'], "!PROPERTY_IN_FOOTER" => false];

          if(getElCount($arDocFilter) > 0):?>
          <br>
          <h4>Скачать</h4>
          <br>
          <?$APPLICATION->IncludeComponent(
            "bitrix:news.list", 
            "document_list", 
            array(
              "ACTIVE_DATE_FORMAT" => "SHORT",
              "ADD_SECTIONS_CHAIN" => "N",
              "AJAX_MODE" => "N",
              "AJAX_OPTION_ADDITIONAL" => "",
              "AJAX_OPTION_HISTORY" => "N",
              "AJAX_OPTION_JUMP" => "N",
              "AJAX_OPTION_STYLE" => "N",
              "CACHE_FILTER" => "N",
              "CACHE_GROUPS" => "Y",
              "CACHE_TIME" => "36000000",
              "CACHE_TYPE" => "A",
              "CHECK_DATES" => "Y",
              "DETAIL_URL" => "",
              "DISPLAY_BOTTOM_PAGER" => "N",
              "DISPLAY_DATE" => "N",
              "DISPLAY_NAME" => "N",
              "DISPLAY_PICTURE" => "N",
              "DISPLAY_PREVIEW_TEXT" => "N",
              "DISPLAY_TOP_PAGER" => "N",
              "FIELD_CODE" => array(
                0 => "NAME",
                1 => "",
              ),
              "FILTER_NAME" => "arDocFilter",
              "HIDE_LINK_WHEN_NO_DETAIL" => "N",
              "IBLOCK_ID" => "14",
              "IBLOCK_TYPE" => "documents",
              "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
              "INCLUDE_SUBSECTIONS" => "N",
              "MESSAGE_404" => "",
              "NEWS_COUNT" => "",
              "PAGER_BASE_LINK_ENABLE" => "N",
              "PAGER_DESC_NUMBERING" => "N",
              "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
              "PAGER_SHOW_ALL" => "N",
              "PAGER_SHOW_ALWAYS" => "N",
              "PAGER_TEMPLATE" => ".default",
              "PAGER_TITLE" => "Документы",
              "PARENT_SECTION" => "",
              "PARENT_SECTION_CODE" => "",
              "PREVIEW_TRUNCATE_LEN" => "",
              "PROPERTY_CODE" => array(
                0 => "LINK_NAME",
                1 => "LINK",
                2 => "",
              ),
              "SET_BROWSER_TITLE" => "N",
              "SET_LAST_MODIFIED" => "N",
              "SET_META_DESCRIPTION" => "N",
              "SET_META_KEYWORDS" => "N",
              "SET_STATUS_404" => "N",
              "SET_TITLE" => "N",
              "SHOW_404" => "N",
              "SORT_BY1" => "SORT",
              "SORT_BY2" => "ID",
              "SORT_ORDER1" => "ASC",
              "SORT_ORDER2" => "DESC",
              "STRICT_SECTION_CHECK" => "N",
              "COMPONENT_TEMPLATE" => "document_list"
            ),
            false,
            array(
              "ACTIVE_COMPONENT" => "Y"
            )
          );?>
          <?endif;?>
        <?endif;?>
      </section>
    <?endif;*/?>
    <footer class="site-footer">
      <div class="site-footer__wrapper">
        <div class="site-footer__top-content">
          <a href="/" class="site-footer__logotype">
            <svg role="img">
              <use xlink:href="<?= ASSET_PATH?>icons.svg#footer_logo"/>
            </svg>
          </a>
          <?$APPLICATION->IncludeComponent(
            "bitrix:menu", 
            "ckk_bottom_menu", 
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
              "COMPONENT_TEMPLATE" => "ckk_bottom_menu"
            ),
            false
          );?>
          </div>
          <div class="site-footer__bottom-content">
            <div class="site-footer__copyright">
            Центр компетенций Кузбасса, 2020 <br>Все права защищены
            </div>
            <div class="site-footer__contacts">
            <div class="site-footer__phones">
              <a class="site-footer__phone" href="tel:+73842771707">+7 (3842) 77-17-07</a>
              <a class="site-footer__phone" href="tel:+73842770828">+7 (3842) 77-08-28</a>
            </div>
            <a class="site-footer__email" href="mailto:cckr42@cckr42.ru">cckr42@cckr42.ru</a>
          </div>
          <div></div>
          <div class="site-footer__make-copyright">
              <?$APPLICATION->IncludeComponent(
                  "bitrix:main.include",
                  "",
                  Array(
                      "AREA_FILE_SHOW" => "file",
                      "AREA_FILE_SUFFIX" => "inc",
                      "EDIT_TEMPLATE" => "",
                      "PATH" => "/includes/footer/makeagency_copyright.php"
                  )
              );?>
          </div>
        </div>
      </div>
    </footer>
    <div id="all-sections-modal" class="modal-window all-sections-modal" data-target="modal-window.window">
      <div class="modal-window__content">
        <div class="all-sections">
          <div class="all-sections__column">
            <h3 class="all-sections__title"><a href="/ward.html" class="all-sections__link">Палата</a></h4>
            <ul class="links">
              <li class="links__item"><a class="links__link" href="/">О&nbsp;Палате</a></li>
              <li class="links__item"><a class="links__link" href="/">Виртуальная приёмная</a></li>
              <li class="links__item"><a class="links__link" href="/">Аппарат Общественной палаты</a></li>
              <li class="links__item"><a class="links__link" href="/">Структура Палаты</a></li>
              <li class="links__item"><a class="links__link" href="/">Документы</a></li>
              <li class="links__item"><a class="links__link" href="/">Общественные советы</a></li>
            </ul>
          </div>
          <div class="all-sections__column">
            <h3 class="all-sections__title"><a href="/" class="all-sections__link">Деятельность</a></h4>
            <ul class="links">
              <li class="links__item"><a class="links__link" href="/">Проекты</a></li>
              <li class="links__item"><a class="links__link" href="/">Общественный контроль</a></li>
            </ul>
          </div>
          <div class="all-sections__column">
            <h3 class="all-sections__title"><a href="/" class="all-sections__link">Пресс-центр</a></h4>
            <ul class="links">
              <li class="links__item"><a class="links__link" href="/">Новости</a></li>
              <li class="links__item"><a class="links__link" href="/">СМИ о&nbsp;нас</a></li>
            </ul>
          </div>
          <div class="all-sections__column">
            <h3 class="all-sections__title"><a href="/" class="all-sections__link">Ресурсный центр НКО</a></h4>
            <ul class="links">
              <li class="links__item"><a class="links__link" href="/">Поддержка НКО</a></li>
              <li class="links__item"><a class="links__link" href="/">Нормативно-правовые акты</a></li>
            </ul>
          </div>
          <div class="all-sections__column">
            <h3 class="all-sections__title"><a href="/" class="all-sections__link">Муниципальные палаты</a></h4>
          </div>
        </div>
      </div>
      <button class="modal-window__close" data-action="modal-window#onClose">
        <svg class="icon" role="img">
          <use xlink:href="<?= ASSET_PATH?>icons.svg#close-button"/>
        </svg>
      </button>
    </div>
  </body>
</html>