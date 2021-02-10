<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? if ($arResult["isFormErrors"] == "Y"): ?><?= $arResult["FORM_ERRORS_TEXT"]; ?><? endif; ?>

<!--<pre>-->
	<? //print_r($arResult);?>
<!--</pre>-->

<? if ($arResult["isFormNote"] == "Y"): ?>
    <div id="gratitude" class="gratitude-block">
        <div class="gratitude-block__wrapper">
            <div class="static-page__mask"></div>

            <div class="gratitude-block__container">
                <button class="button-close-block base-icon-block js-close-gratitude-button">
                    <svg width="18" height="18" viewBox="0 0 18 18" version="1.1" xmlns="http://www.w3.org/2000/svg"
                         xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g transform="translate(-2442 -830)">
                            <g>
                                <use xlink:href="#close_icon_svg" transform="translate(2442 830)"></use>
                            </g>
                        </g>
                        <defs>
                            <path id="close_icon_svg" fill-rule="evenodd"
                                  d="M 7.61523 9.00006L 0 16.6154L 1.38452 18L 9 10.3846L 16.6152 18L 18 16.6154L 10.3845 9L 18 1.38458L 16.6155 0L 9 7.61542L 1.38452 0L 0 1.38464L 7.61523 9.00006Z"></path>
                        </defs>
                    </svg>
                </button>

                <div class="gratitude-block__gerb">
                    <div class="gratitude-block__img">
                        <?$APPLICATION->IncludeFile("/includes/svg/gerb.html")?>
                    </div>
                    <div class="gratitude-block__addition">
                        Администрация<br>
                        города Юрга
                    </div>
                </div>
                <div class="gratitude-block__content">
                    <div class="gratitude-block__row">
                        <h5 class="gratitude-block__title">Ваше обращение успешно отправлено</h5>
<!--                        <div class="gratitude-block__treatment-number">Номер обращения <span-->
<!--                                id="ID_VIRTUALPRIEM_RESULT">--><?//= $arResult["FORM_NOTE"] ?><!--</span></div>-->
                    </div>
                    <div class="gratitude-block__row">
<!--                        <div class="gratitude-block__addition">Уникальный номер обращения отправлен на вашу электронную-->
<!--                            почту-->
<!--                        </div>-->
                        <div class="gratitude-block__button-wrapper">
                            <button class="base-button-transparent--small js-button-new-treatment">Написать ещё
                                обращение
                            </button>
                            <?if ($_SERVER["DOCUMENT_URI"] != '/frames/virtual_reception.php'):?>
                                <a class="base-button base-button--small" href="/">На главную</a>
                            <?endif;?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <span class="base-button base-button--big js-open-gratitude-button" style="display: none;">Отправить письмо</span>
    <script>
        $(document).ready(function () {
            new window.Gratitude();
            $('.js-open-gratitude-button').trigger('click');
        });
    </script>
<? endif; ?>


<? //if ($arResult["isFormNote"] != "Y") { ?>
<?= $arResult["FORM_HEADER"] ?>


<?
/***********************************************************************************
 * form questions
 ***********************************************************************************/
?>

    <input type="text" name="check-bot" style="display: none;">

    <div class="virtual-reception__form-group">
        <h6>1. Представьтесь, пожалуйста</h6>
        <? $arItemsPrint = Array(
            "VIRTUAL_RECEPTION_SURNAME",
            "VIRTUAL_RECEPTION_NAME",
            "VIRTUAL_RECEPTION_PATRONYMIC"
        ); ?>
        <? foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion):
            if (in_array($FIELD_SID, $arItemsPrint)):
                switch ($arQuestion['STRUCTURE'][0]['FIELD_TYPE']) {
                    case 'text':
                        ?>
                        <label
                            class="base-label"><? echo $arQuestion["CAPTION"]; ?><? if ($arQuestion["REQUIRED"] == 'Y'):?>*<?endif; ?></label>
                        <div class="base-input-wrapper">
                            <? echo $arQuestion["HTML_CODE"]; ?>
                        </div>
                        <?
                        break;
                    case 'dropdown':
                        ?>
                        <label
                            class="base-label"><? echo $arQuestion["CAPTION"]; ?><? if ($arQuestion["REQUIRED"] == 'Y'):?>*<?endif; ?></label>
                        <div class="base-input-wrapper base-select--middle">
                            <? echo $arQuestion["HTML_CODE"]; ?>
                            <div class="select-arrow">
                                <div class="base-icon-block">
                                    <svg width="4" height="16" viewbox="0 0 4 16" version="1.1"
                                         xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <g transform="translate(-1655 -2111)">
                                            <g>
                                                <use xlink:href="#select_icon_fill"
                                                     transform="translate(1655 2111)"></use>
                                            </g>
                                        </g>
                                        <defs>
                                            <path id="select_icon_fill" fill-rule="evenodd"
                                                  d="M 2 4C 3.10461 4 4 3.10449 4 2C 4 0.895508 3.10461 0 2 0C 0.895386 0 0 0.895508 0 2C 0 3.10449 0.895386 4 2 4ZM 2 10C 3.10461 10 4 9.10449 4 8C 4 6.89551 3.10461 6 2 6C 0.895386 6 0 6.89551 0 8C 0 9.10449 0.895386 10 2 10ZM 4 14C 4 15.1045 3.10461 16 2 16C 0.895386 16 0 15.1045 0 14C 0 12.8955 0.895386 12 2 12C 3.10461 12 4 12.8955 4 14Z"></path>
                                        </defs>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <?
                        break;
                }
            endif;
        endforeach; ?>
    </div>

    <div class="virtual-reception__form-group">
        <h6>2. Контактные данные</h6>
        <? $arItemsPrint = Array(
            "VIRTUAL_RECEPTION_CITY"
        ); ?>
        <? foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion):
            if (in_array($FIELD_SID, $arItemsPrint)):
                switch ($arQuestion['STRUCTURE'][0]['FIELD_TYPE']) {
                    case 'text':
                        ?>
                        <label
                            class="base-label"><? echo $arQuestion["CAPTION"]; ?><? if ($arQuestion["REQUIRED"] == 'Y'):?>*<?endif; ?></label>
                        <div class="base-input-wrapper">
                            <? echo $arQuestion["HTML_CODE"]; ?>
                        </div>
                        <?
                        break;
                    case 'dropdown':
                        ?>
                        <label
                            class="base-label"><? echo $arQuestion["CAPTION"]; ?><? if ($arQuestion["REQUIRED"] == 'Y'):?>*<?endif; ?></label>
                        <div class="base-input-wrapper base-select--middle">
                            <? echo $arQuestion["HTML_CODE"]; ?>
                            <div class="select-arrow">
                                <div class="base-icon-block">
                                    <svg width="4" height="16" viewbox="0 0 4 16" version="1.1"
                                         xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <g transform="translate(-1655 -2111)">
                                            <g>
                                                <use xlink:href="#select_icon_fill"
                                                     transform="translate(1655 2111)"></use>
                                            </g>
                                        </g>
                                        <defs>
                                            <path id="select_icon_fill" fill-rule="evenodd"
                                                  d="M 2 4C 3.10461 4 4 3.10449 4 2C 4 0.895508 3.10461 0 2 0C 0.895386 0 0 0.895508 0 2C 0 3.10449 0.895386 4 2 4ZM 2 10C 3.10461 10 4 9.10449 4 8C 4 6.89551 3.10461 6 2 6C 0.895386 6 0 6.89551 0 8C 0 9.10449 0.895386 10 2 10ZM 4 14C 4 15.1045 3.10461 16 2 16C 0.895386 16 0 15.1045 0 14C 0 12.8955 0.895386 12 2 12C 3.10461 12 4 12.8955 4 14Z"></path>
                                        </defs>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <?
                        break;
                }
            endif;
        endforeach; ?>

        <? $arItemsPrint = Array(
            "VIRTUAL_RECEPTION_POSTCODE",
        ); ?>
        <? foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion):
            if (in_array($FIELD_SID, $arItemsPrint)):
                switch ($arQuestion['STRUCTURE'][0]['FIELD_TYPE']) {
                    case 'text':
                        ?>
                        <div class="grid-2column-list">
                            <div class="virtual-reception__post-code">
                                <label
                                    class="base-label"><? echo $arQuestion["CAPTION"]; ?><? if ($arQuestion["REQUIRED"] == 'Y'):?>*<?endif; ?></label>
                                <div class="base-input-wrapper">
                                    <? echo $arQuestion["HTML_CODE"]; ?>
                                </div>
                            </div>

                            <div class="virtual-reception__get-post-code">
                                <a class="link-with-arrow virtual-reception-content__link link-with-static-icon"
                                   href="https://www.pochta.ru/post-index" target="_blank">
                                    <div class="link-with-arrow__text">Узнать свой почтовый индекс</div>

                                    <div class="base-icon-block link-with-arrow__icon">
                                        <svg width="24" height="24" viewbox="0 0 24 24" version="1.1"
                                             xmlns="http://www.w3.org/2000/svg"
                                             xmlns:xlink="http://www.w3.org/1999/xlink">
                                            <g transform="translate(-15831 -72)">
                                                <g>
                                                    <g>
                                                        <g>
                                                            <use xlink:href="#another_page_con1"
                                                                 transform="translate(15831 76)" fill="#97A4B1"></use>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                            <defs>
                                                <path id="another_page_con1" fill-rule="evenodd"
                                                      d="M 7.78125 0L 13.9453 0L 16 0L 16 2.05473L 16 8.21893L 13.9453 8.21893L 13.9453 3.50742L 6.45312 11L 5 9.5473L 12.4922 2.05473L 7.78125 2.05473L 7.78125 0ZM 2 14L 10 14L 10 10L 12 10L 12 15C 12 15.552 11.5518 16 11 16L 1 16C 0.447266 16 0 15.552 0 15L 0 5C 0 4.447 0.447266 4 1 4L 5.99902 4L 5.99902 6L 2 6L 2 14Z"></path>
                                            </defs>
                                        </svg>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <?
                        break;
                }
            endif;
        endforeach; ?>


        <? $arItemsPrint = Array(
            "VIRTUAL_RECEPTION_STREET",
        ); ?>
        <? foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion):
            if (in_array($FIELD_SID, $arItemsPrint)):
                switch ($arQuestion['STRUCTURE'][0]['FIELD_TYPE']) {
                    case 'text':
                        ?>
                        <label
                            class="base-label"><? echo $arQuestion["CAPTION"]; ?><? if ($arQuestion["REQUIRED"] == 'Y'):?>*<?endif; ?></label>
                        <div class="base-input-wrapper">
                            <? echo $arQuestion["HTML_CODE"]; ?>
                        </div>
                        <?
                        break;
                }
            endif;
        endforeach; ?>

        <div class="grid-4column">
            <? $arItemsPrint = Array(
                "VIRTUAL_RECEPTION_HOUSE",
                "VIRTUAL_RECEPTION_HOUSING",
                "VIRTUAL_RECEPTION_ROOM"
            ); ?>
            <? foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion):
                if (in_array($FIELD_SID, $arItemsPrint)):
                    switch ($arQuestion['STRUCTURE'][0]['FIELD_TYPE']) {
                        case 'text':
                            ?>
                            <div class="virtual-reception__column">
                                <label
                                    class="base-label"><? echo $arQuestion["CAPTION"]; ?><? if ($arQuestion["REQUIRED"] == 'Y'):?>*<?endif; ?></label>
                                <div class="base-input-wrapper">
                                    <? echo $arQuestion["HTML_CODE"]; ?>
                                </div>
                            </div>
                            <?
                            break;
                    }
                endif;
            endforeach; ?>
        </div>

        <div class="base-separator__line"></div>

        <? $arItemsPrint = Array(
            "VIRTUAL_RECEPTION_PHONE",
            "VIRTUAL_RECEPTION_EMAIL",
        ); ?>
        <? foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion):
            if (in_array($FIELD_SID, $arItemsPrint)):
                switch ($arQuestion['STRUCTURE'][0]['FIELD_TYPE']) {
                    case 'text':
                        ?>
                        <label
                            class="base-label"><? echo $arQuestion["CAPTION"]; ?><? if ($arQuestion["REQUIRED"] == 'Y'):?>*<?endif; ?></label>
                        <div class="base-input-wrapper">
                            <? echo $arQuestion["HTML_CODE"]; ?>
                        </div>
                        <?
                        break;
                    case 'email':
                        ?>
                        <label
                            class="base-label email-field-title"><? echo $arQuestion["CAPTION"]; ?>
                                <span class="js-change-radio-text">*</span></label>
                        <div class="base-input-wrapper">
                            <? echo $arQuestion["HTML_CODE"]; ?>
                        </div>
                        <?
                        break;
                }
            endif;
        endforeach; ?>
    </div>

    <div class="virtual-reception__form-group js-treatment-reset-block">
        <h6>3. Ваше обращение</h6>

        <? $arItemsPrint = Array(
            "VIRTUAL_RECEPTION_TEXT",
            "VIRTUAL_RECEPTION_FILE"
        ); ?>
        <? foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion):
            if (in_array($FIELD_SID, $arItemsPrint)):
                switch ($arQuestion['STRUCTURE'][0]['FIELD_TYPE']) {
                    case 'text':
                        ?>
                        <label
                            class="base-label"><? echo $arQuestion["CAPTION"]; ?><? if ($arQuestion["REQUIRED"] == 'Y'):?>*<?endif; ?></label>
                        <div class="base-input-wrapper">
                            <? echo $arQuestion["HTML_CODE"]; ?>
                        </div>
                        <?
                        break;
                    case 'dropdown':
                        ?>
                        <label
                            class="base-label"><? echo $arQuestion["CAPTION"]; ?><? if ($arQuestion["REQUIRED"] == 'Y'):?>*<?endif; ?></label>
                        <div class="base-input-wrapper base-select--middle">
                            <? echo $arQuestion["HTML_CODE"]; ?>
                            <div class="select-arrow">
                                <div class="base-icon-block">
                                    <? $APPLICATION->IncludeFile("/includes/svg/select_dots.html"); ?>
                                </div>
                            </div>
                        </div>
                        <?
                        break;
                    case 'textarea':
                        ?>
                        <label
                            class="base-label"><? echo $arQuestion["CAPTION"]; ?><? if ($arQuestion["REQUIRED"] == 'Y'):?>*<?endif; ?></label>
                        <div class="base-input-wrapper virtual-reception__text-writer">
                            <? echo $arQuestion["HTML_CODE"]; ?>
                        </div>
                        <?
                        break;
                    case 'file':
                        ?>
                        <div class="virtual-reception__text-annotation">
                            <p>В случае необходимости вы можете прикрепить к обращению до 10 документов размером до 5 мб
                                каждый.</p>
                            <p>Допустимые форматы файлов: txt, doc, docx, rtf, xls, xlsx, pps, ppt, pptx, pdf, jpg,
                                jpeg, bmp, png, tif, gif, pcx, mp3, avi, mp4, mkv, wmv, mov.</p>
                            <p>Иные форматы не обрабатываются в информационных системах Администрации города Юрга.</p>
                        </div>

                        <div class="file-upload base-button-transparent--middle">
                            Прикрепить файл
                            <input id="form_file_<?= $arQuestion['STRUCTURE'][0]['ID'] ?>"
                                   name="form_file_<?= $arQuestion['STRUCTURE'][0]['ID'] ?>[]" class="form-file-input"
                                   accept=".txt,.doc,.docx,.rtf,.xls,.xlsx,.pps,.ppt,.pptx,.pdf,.jpg,.jpeg,.bmp,.png,.tif,.gif,.pcx,.mp3,.avi,.mp4,.mkv,.wmv,.mov"
                                   multiple="" size="0" type="file"/>
                        </div>

                        <div class="file-upload__files">
                            <div class="file-upload-clear-box" style="clear: both;"></div>
                        </div>
                        <?
                        break;
                }
            endif;
        endforeach; ?>

        <div class="base-few-input-wrapper virtual-reception__few-input-wrapper">
            <input type="hidden" value="Отправить письмо" name="web_form_submit">
            <button
                <?= (intval($arResult["F_RIGHT"]) < 10 ? "disabled=\"disabled\"" : ""); ?>
                class="base-button base-button--big js-virtual-reseption"
                type="submit"
                value="Отправить письмо"
                name="web_form_submit">Отправить письмо
            </button>
        </div>
    </div>

    <script>
		$(document).ready(function () {
            formreset();
		});
    </script>

<?= $arResult["FORM_FOOTER"] ?>
<? //} //endif (isFormNote) ?>