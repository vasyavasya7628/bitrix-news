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

<?foreach($arResult["ITEMS"] as $arItem):
    $arFile = $arItem["DISPLAY_PROPERTIES"]["FILE"]["FILE_VALUE"];
    $docFormat = explode(".", $arFile["ORIGINAL_NAME"]);
    /* функция из ini.php */
    $fileValue = getFileSize($arFile["FILE_SIZE"]);
?>
    <a href="<?=$arItem['DISPLAY_PROPERTIES']['FILE']['FILE_VALUE']['SRC']?>" class="static-page__document-preview" download>
        <div class="document-preview__link-text">
            <?echo $arItem["NAME"]?>
        </div>
        <div class="link-download__file-weight">
            <?echo strtoupper(end($docFormat)) . ", " . $fileValue;?>
        </div>
    </a>
<?endforeach;?>