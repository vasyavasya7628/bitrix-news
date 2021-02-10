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
?>

<?if (0 < $arResult["SECTIONS_COUNT"]):?>
<div class="collegium-content__persons-block">
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
            ?>

            <a href="<?echo $arSection["SECTION_PAGE_URL"];?>" id="<? echo $this->GetEditAreaId($arSection['ID']);?>"
               class="card-person-post collegium-content__person-introduction popup-block-link" data-event-init="false">
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
        <?else:?>
            <div class="preview__small preview__small--bold" id="<? echo $this->GetEditAreaId($arSection['ID']);?>">
                <h4 class="preview-small__title">
                    <?echo $arSection["NAME"]?>
                </h4>

                <div class="contact-item">
                    <?foreach ($arSection["UF_DEP_PHONE"] as $phone):?>
                        <a class="contact-phone">
                            <?echo $phone;?>
                        </a>
                    <?endforeach;?>
                </div>
            </div>
        <?endif;?>
   <?endforeach;?>
</div>
<?endif;?>