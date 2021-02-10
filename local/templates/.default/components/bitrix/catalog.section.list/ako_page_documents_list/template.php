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
?>

<? if(empty($_REQUEST['query'])): ?>
<div class="documents-list">

    <h1><?=$arResult["SECTION"]["NAME"]?></h1>
    <br>
    <form id="documentSearchForm" action="<?=$_SERVER["REQUEST_URI"] ?>" class="bulletin__filter">

        <label class="base-label">Название документа или его номер</label>
        <div class="base-input-wrapper">
            <input type="text" name="query" class="base-input-text base-input--small js-document-search-query" id="DOCUMENT_NUMBER">
        </div>

        <br>

        <div class="base-few-input-wrapper bulletin__few-input-wrapper bulletin__filter-buttons">
            <div class="bulletin__filter-buttons-left">
                <button type="submit" class="base-button base-button--small js-search-document-button search-document-button">
                    Найти документ
                </button>
                <button type="button" class="button-clear js-search-resert-button search-resert-button--dissactive">
                    Очистить поиск
                </button>
            </div>
        </div>
    </form>
    <br>
    <div class="documents-list-wrapper">
<? endif;?>
        <div class="documents-list-wrapper__content">
            <?
            $countElements = 0;
            foreach ($arResult["SECTIONS"] as $sectionItem): ?>
                <? if(count($sectionItem["ELEMENTS"]) > 0):
                    $countElements++;
                ?>
                    <h5><?=$sectionItem["NAME"]?></h5>
                <?
                        foreach ($sectionItem["ELEMENTS"] as $elementItem):
                          $fileInfo = CFile::GetByID($elementItem["PROPERTIES"]["FILE"]["VALUE"])->arResult[0];
                           ?>

                            <a href="/upload/<?=$fileInfo['SUBDIR']?>/<?=$fileInfo['ORIGINAL_NAME']?>" class="static-page__document-preview" target="_blank">
                                <div class="document-preview__link-text">
                                    <?=$elementItem["PREVIEW_TEXT"]?>
                                </div>
                                <div class="link-download__file-weight">
                                    <?=strtoupper(end(explode("/", $fileInfo["CONTENT_TYPE"])))?>, <?=getFileSize($fileInfo["FILE_SIZE"])?>
                                </div>
                            </a>
                        <? endforeach;
                    endif;
                endforeach;
                if ($countElements == 0): ?>
                  <h3>Ничего не найдено</h3>
                <? endif; ?>
        </div>
<? if(!$_REQUEST['query']): ?>
    </div>
</div>
<? endif; ?>