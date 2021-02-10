<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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
?>
<div class="b-page">
<div class="search-page">

	<? function numberEnd($number, $titles)
	{
		$cases = array(2, 0, 1, 1, 1, 2);

		return $titles[($number % 100 > 4 && $number % 100 < 20) ? 2 : $cases[min($number % 10, 5)]];
	}

	?>

    <div class="base-form-block">
        <div class="container grid-2column grid-2column--mobile-revert search-result__search">
            <div>
                <h2 class="base-form-block__title">
									<?= numberEnd(count($arResult['SEARCH']), array('Найден', 'Найдено', 'Найдено')); ?> <?= count($arResult['SEARCH']); ?> <?= numberEnd(count($arResult['SEARCH']), array('результат', 'результата', 'результатов')); ?>
                </h2>
                <label class="base-label">Поиск</label>
                <form action="" method="get" enctype="application/x-www-form-urlencoded"
                      class="search-result__search-field" autocomplete="off">
                    <div class="base-input-wrapper">
                        <input type="text" name="q" value="<?= $arResult["REQUEST"]["QUERY"] ?>"
                               class="base-input-text base-input--small" id="document-id">
                    </div>
                    <button class="base-button base-button--small">
                        Найти
                    </button>
                </form>

            </div>
        </div>
    </div>
    <div class="container search-result__results">
			<? if (count($arResult['DATA']) > 0): ?>
				<?
                    foreach ($arResult['DATA'] as $arSection => $arItems): ?>

                      <h3 class="search-page__result-section-title"><?=$arSection?></h3>

                        <? foreach ($arItems as $arItem): ?>

                              <div class="grid-2column">
                                  <div class="grid__column">
                                      <a class="preview__small preview__small--bold search-page__result-item" href="<?= $arItem["URL_WO_PARAMS"] ?>" data-type-block="<?= $arItem["PARAM2"] ?>">
                                          <!--                                <div class="tag-text preview-small__tag-text">НОВОСТИ</div>-->
                                          <h4 class="preview-small__title  ">
                                                                        <? echo $arItem["TITLE_FORMATED"] ?>
                                          </h4>
                                          <div class="preview-small__description">
                                                                        <? echo $arItem["BODY_FORMATED"] ?>
                                          </div>
                                          <div class="preview-small__date"><?= $arItem["DATE_CHANGE"] ?></div>
                                      </a>
                                  </div>
                              </div>


					<?
                        endforeach;
                endforeach;
            else: ?>
              <p>Ничего не найдено</p>
			<? endif; ?>
<!--
                <div class="grid-2column">
                    <div class="grid__column">
                        <a class="preview__small preview__small--bold" href="#">
                            <div class="tag-text preview-small__tag-text">АДМИНИСТРАЦИИ МУНИЦИПАЛЬНЫХ ОБРАЗОВАНИЙ</div>
                            <h4 class="preview-small__title  ">
                                Администрация города Белово
                            </h4>
                        </a>
                    </div>
                </div>

                <div class="grid-2column">
                    <div class="grid__column">
                        <a class="preview__small preview__small--bold" href="#">
                            <div class="tag-text preview-small__tag-text">АДМИНИСТРАЦИИ МУНИЦИПАЛЬНЫХ ОБРАЗОВАНИЙ</div>
                            <h4 class="preview-small__title">
                                Администрация Беловского района
                            </h4>
                        </a>
                    </div>
                </div>

                <div class="search-group-title search-result__results-search-group">Документы</div>

                <div class="grid-2column">
                    <div class="grid__column">
                        <a class="preview__small preview__small--bold" href="#">
                            <div class="tag-text preview-small__tag-text">КАТЕГОРИЯ ДОКУМЕНТА</div>
                            <h4 class="preview-small__title  ">
                                Об утверждении плана мероприятий («дорожной карты») по внедрению
                                целевой модели «Технологическое
                                присоединение к электрическим сетям»
                            </h4>
                            <div class="preview-small__date">1 августа 2017 года</div>
                        </a>
                    </div>
                </div>

                <div class="grid-2column block-with-download-link">
                    <div class="grid__column">
                        <a class="grid__column preview__small preview__small--bold" href="#">
                            <div class="tag-text preview-small__tag-text">РАСПОРЯЖЕНИЕ ГУБЕРНАТОРА</div>
                            <h4 class="preview-small__title">
                                О Порядке ведения перечня видов регионального
                                государственного
                                контроля (надзора) и органов исполнительной власти Кемеровской области, уполномоченных на их
                                осуществление
                            </h4>
                            <div class="preview-small__date">1 августа 2017 года</div>
                        </a>
                    </div>
                    <div class="grid__column">
                        <a class="link-download search-result__link-download" href="#">
                            <div class="base-icon-block-content">
                                <svg width="24" height="32" viewBox="0 0 24 32" version="1.1" xmlns="http://www.w3.org/2000/svg"
                                     xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <title>Combined Shape</title>
                                    <desc>Created using Figma</desc>
                                    <g id="Canvas" transform="translate(-7919 -558)">
                                        <g id="Combined Shape">
                                            <use xlink:href="#path21_fill" transform="translate(7919 558)" fill="#97A4B1"></use>
                                        </g>
                                    </g>
                                    <defs>
                                        <path id="path21_fill" fill-rule="evenodd"
                                              d="M 11.0044 0L 13.0156 0L 13.0156 21.3157L 21.5854 12.7457L 22.9683 14.1283L 12.0923 25.004L 11.9995 24.9114L 11.9072 25.004L 1.03174 14.1283L 2.41455 12.7457L 11.0044 21.3358L 11.0044 0ZM 24 30L 0 30L 0 32L 24 32L 24 30Z"></path>
                                    </defs>
                                </svg>
                            </div>
                            <div class="link-download__content">
                                <div class="link-download__text">Скачать PDF</div>
                                <div class="link-download__file-weight">
                                    4,21 мб
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="search-group-title search-result__results-search-group">Публикации</div>

                <div class="grid-2column">
                    <div class="grid__column">
                        <a class="preview__small preview__small--bold" href="#">
                            <div class="tag-text preview-small__tag-text">НОВОСТИ МУНИЦИПАЛЬНЫХ ОБРАЗОВАНИЙ</div>
                            <h4 class="preview-small__title">
                                Об утверждении плана мероприятий («дорожной карты») по
                                внедрению целевой модели «Технологическое
                                присоединение к электрическим сетям»
                            </h4>
                            <div class="preview-small__description">
                                Таштагольский район, первым в Кузбассе, на 100% застраховал муниципальное имущество
                                в зоне возможного подтопления
                            </div>
                            <div class="preview-small__date">1 августа 2017 года</div>
                        </a>
                    </div>
                </div>

                <div class="grid-2column">
                    <div class="grid__column">
                        <a class="preview__small preview__small--bold" href="#">
                            <div class="tag-text preview-small__tag-text">НОВОСТИ</div>
                            <h4 class="preview-small__title  ">
                                Об утверждении плана мероприятий («дорожной карты») по
                                внедрению целевой модели «Технологическое
                                присоединение к электрическим сетям»
                            </h4>
                            <div class="preview-small__description">
                                Таштагольский район, первым в Кузбассе, на 100% застраховал муниципальное имущество
                                в зоне возможного подтопления
                            </div>
                            <div class="preview-small__date">1 августа 2017 года</div>
                        </a>
                    </div>
                </div>

                <div class="search-group-title search-result__results-search-group">Люди</div>

                <div class="grid-2column">
                    <div class="grid__column">
                        <a class="person-presentation" href="#">
                            <div class="person-presentation__img">
                                <img src="../images/development/test_intro_img.jpg">
                            </div>
                            <div class="person-presentation__intro">
                                <h4 class="person-presentation__intro-full-name">Иван Константинович Белов</h4>
                                <div class="person-presentation__intro-post">Первый заместитель мэра</div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="grid-2column">
                    <div class="grid__column">
                        <a class="person-presentation" href="#">
                            <div class="person-presentation__img">
                                <img src="../images/development/test_intro_img.jpg">
                            </div>
                            <div class="person-presentation__intro">
                                <h4 class="person-presentation__intro-full-name">Иван Станиславович Беловский-Великий</h4>
                                <div class="person-presentation__intro-post">Первый заместитель мэра</div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>!-->
    </div>
</div>