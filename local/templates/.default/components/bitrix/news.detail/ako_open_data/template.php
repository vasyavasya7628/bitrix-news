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
foreach ($arResult["META_TAGS"] as $key => $value) {
    $APPLICATION->SetPageProperty($key, $value);
}
?>
<div class="b-page">
    <div class="static-page-2">
        <div class="static-page-2-content">
            <div class="container">
                <?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "ako_breadcrumbs", Array(
                    "PATH" => "",	// Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
                    "SITE_ID" => "s1",	// Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
                    "START_FROM" => "1",	// Номер пункта, начиная с которого будет построена навигационная цепочка
                ),
                    false
                );?>
                <div class="grid-2column grid-2column--mobile-revert">
                    <div class="grid__column">
                        <?//var_dump($arResult);?>

                        <div class="static-content">
                            <h1>
                                <?echo $arResult["NAME"];?>
                            </h1>

                            <div class="table-wrapper">
                                <table class="table-inner">
                                    <tbody>
                                        <tr>
                                            <td class="opendata-table-desc">Идентификационный номер</td>
                                            <td><?echo $arResult["CODE"]?></td>
                                        </tr>
                                        <tr>
                                            <td class="opendata-table-desc">Наименование набора данных</td>
                                            <td><?echo $arResult["NAME"]?></td>
                                        </tr>
                                        <?foreach ($arResult["DISPLAY_PROPERTIES"] as $arProperty):?>
                                            <?switch ($arProperty["PROPERTY_TYPE"]):
                                                case "S":?>
                                                    <tr>
                                                        <td class="opendata-table-desc"><?echo $arProperty["NAME"];?></td>
                                                        <td><?echo $arProperty["DISPLAY_VALUE"];?></td>
                                                    </tr>
                                            <?break;
                                            case "F":?>
                                                <?if ($arProperty["CODE"] <> "OPEN_DATA_FILE_VIEW"):?>
                                                    <tr>
                                                        <td class="opendata-table-desc"><?echo $arProperty["NAME"];?></td>
                                                        <td><a href="<?echo $arProperty["FILE_VALUE"]["SRC"];?>"><?echo $arProperty["FILE_VALUE"]["ORIGINAL_NAME"]?></a></td>
                                                    </tr>
                                                    <?if ($arProperty["CODE"] == "OPEN_DATA_SET_DATA_FILE"):?>
                                                        <?
                                                        $splittedFileName = explode(".", $arProperty["FILE_VALUE"]["FILE_NAME"]);
                                                        $fileType = end($splittedFileName);
                                                        ?>
                                                        <td class="opendata-table-desc">Формат данных</td>
                                                        <td><?echo strtoupper($fileType);?></td>
                                                    <?endif;?>
                                                <?endif;?>
                                            <?break;
                                            endswitch;?>
                                        <?endforeach;?>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <h3>
                            Файловое представление
                        </h3>
                        <div class="open-data__file-list">
                            <?foreach ($arResult["DISPLAY_PROPERTIES"]["OPEN_DATA_FILE_VIEW"]["FILE_VALUE"] as $arFile):?>
                                <?/* функция из ini.php */
                                $fileValue = getFileSize($arFile["FILE_SIZE"]);
                                ?>
                                <a class="link-download" href="<?echo $arFile["SRC"]?>">
                                    <div class="base-icon-block-content">
                                        <?$APPLICATION->IncludeFile("/includes/svg/download_file_icon_big.html");?>
                                    </div>
                                    <div class="link-download__content">
                                        <div class="link-download__text"><?echo $arFile["DESCRIPTION"];?></div>
                                        <div class="link-download__file-weight">
                                            <?echo $fileValue;?>
                                        </div>
                                    </div>
                                </a>
                            <?endforeach;?>
                        </div>
                    </div>
                    <div class="grid__column">
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:menu",
                            "ako_section_menu",
                            array(
                                "ALLOW_MULTI_SELECT" => "N",
                                "CHILD_MENU_TYPE" => "left",
                                "DELAY" => "N",
                                "MAX_LEVEL" => "2",
                                "MENU_CACHE_GET_VARS" => array(
                                ),
                                "MENU_CACHE_TIME" => "3600",
                                "MENU_CACHE_TYPE" => "A",
                                "MENU_CACHE_USE_GROUPS" => "Y",
                                "ROOT_MENU_TYPE" => "left",
                                "USE_EXT" => "Y",
                                "COMPONENT_TEMPLATE" => "ako_section_menu"
                            ),
                            false
                        );?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="static-page-block__wrapper">
        <div class="container">
            <div class="page-data-container">
                <div class="page-data-item">
                    <?$date = $arResult["DATE_CREATE"];
                    echo "Добавлено ".FormatDateFromDB($date, "DD MMMM YYYY");?>
                </div>
                <div class="page-data-item">
                    <?$date = $arResult["TIMESTAMP_X"];
                    echo "Изменено ".FormatDateFromDB($date, "DD MMMM YYYY");?>
                </div>
            </div>
        </div>
    </div>
</div>