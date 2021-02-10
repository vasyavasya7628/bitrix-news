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

$arViewModeList = $arResult['VIEW_MODE_LIST'];

$arViewStyles = array(
	'LIST' => array(
		'CONT' => 'bx_sitemap',
		'TITLE' => 'bx_sitemap_title',
		'LIST' => 'bx_sitemap_ul',
	),
	'LINE' => array(
		'CONT' => 'bx_catalog_line',
		'TITLE' => 'bx_catalog_line_category_title',
		'LIST' => 'bx_catalog_line_ul',
		'EMPTY_IMG' => $this->GetFolder().'/images/line-empty.png'
	),
	'TEXT' => array(
		'CONT' => 'bx_catalog_text',
		'TITLE' => 'bx_catalog_text_category_title',
		'LIST' => 'bx_catalog_text_ul'
	),
	'TILE' => array(
		'CONT' => 'bx_catalog_tile',
		'TITLE' => 'bx_catalog_tile_category_title',
		'LIST' => 'bx_catalog_tile_ul',
		'EMPTY_IMG' => $this->GetFolder().'/images/tile-empty.png'
	)
);
$arCurView = $arViewStyles[$arParams['VIEW_MODE']];

$strSectionEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_EDIT");
$strSectionDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_DELETE");
$arSectionDeleteParams = array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM'));
//var_dump($arResult);
$currentLevel = 0;
?>

<?if (0 < $arResult["SECTIONS_COUNT"]):?>
    <?foreach ($arResult['SECTIONS'] as &$arSection):?>
        <?
        $this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
        $this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
        ?>

        <?if ($arSection["UF_DEP_TYPE"] == 1):?>
            <?
            $picturePath = is_null($arSection["MAN_PHOTO"]) ? "/assets/images/development/person_small_0.jpg" : $arSection["MAN_PHOTO"];
            $blockPhoto = "background: url('".$picturePath."') no-repeat center; background-size: cover;";
            $splittedManName = explode(" ", $arSection["UF_FIO_MAN"]);

            if ($arSection["DEPTH_LEVEL"] < $currentLevel) {
                echo str_repeat('</div>', $currentLevel - $arSection["DEPTH_LEVEL"]);
            } else {
                echo "</div>";
            }
            ?>

            <a href="<?echo $arSection["SECTION_PAGE_URL"];?>"
               class="card-person-post executive-branch-content__person-introduction popup-block-link"
               id="<? echo $this->GetEditAreaId($arSection['ID']);?>" data-event-init="false">

                <div class="card-person-post__title">
                    <?echo $arSection["NAME"]?>
                </div>

                <div class="card-person-post__content">
                    <div class="card-person-post__person">
                        <div class="card-person-post__person-image" style="<?echo $blockPhoto;?>"></div>

                        <div class="card-person-post__person-name-block">
                            <div class="card-person-post__person-first-name">
                                <?echo $splittedManName[0];?>
                            </div>

                            <div class="card-person-post__person-last-name">
                                <?echo $splittedManName[1]." ".$splittedManName[2];?>
                            </div>
                        </div>
                    </div>
                    <div class="card-person-post__contacts">
                        <?foreach ($arSection["UF_DEP_PHONE"] as $phone):?>
                            <div class="card-person-post__phone">
                                <?echo $phone;?>
                            </div>
                        <?endforeach;?>

                        <div class="card-person-post__address">
                            <?echo $arSection["UF_DEP_ADDRES"];?>
                        </div>
                    </div>
                </div>
            </a>

            <div class="executive-branch-content__organization-list">

        <?else:?>
            <?
            $splittedDepName = explode(" ", $arSection["ELEMENT"]["NAME"]);
            $modifyDepName = str_replace($splittedDepName[0], strtolower($splittedDepName[0]), $arSection["ELEMENT"]["NAME"]);
            ?>
            <div class="preview__small executive-branch-content__preview-small"  id="<? echo $this->GetEditAreaId($arSection['ID']);?>">
                <a href="<?echo $arSection["SECTION_PAGE_URL"];?>" class="preview-small__title popup-block-link">
                    <?echo $arSection["NAME"]?>
                </a>
                <div class="tag-text preview-small__description">
                    <?echo $arSection["ELEMENT"]["CONTACT_FIO"].", ".$modifyDepName;?>
                </div>
            </div>
        <?endif;?>

        <?$currentLevel = $arSection["DEPTH_LEVEL"]?>
    <?endforeach;?>
    </div>
<?endif;?>
