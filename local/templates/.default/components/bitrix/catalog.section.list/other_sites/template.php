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

$strSectionEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_EDIT");
$strSectionDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_DELETE");
$arSectionDeleteParams = array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM'));

// echo '<div id="log">'.'<pre>'; print_r($arResult); echo '</pre>'.'</div>';
?>
<div id="other-sites" class="modal-window other-sites-modal" data-target="modal-window.window">
	<div class="modal-window__content">
		<div class="other-sites" data-controller="other-sites">
			<div class="other-sites__content" data-target="other-sites.content">
				<?foreach ($arResult['SECTIONS'] as $key => $arSection):?>
					<?
					$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
					$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);	
					?>
					<ul id="<?=$this->GetEditAreaId($arSection['ID']);?>" class="important-links <?= $key == 0 ? 'active' : ''?>">
						<?foreach ($arSection['ITEMS'] as $arLink):?>
							<li class="important-links__item">
								<a href="<?=$arLink['PROPERTY_SIDE_SITE_LINK_VALUE']?>" rel="nofollow noreferrer" target="_blank"><?= $arLink['NAME']?></a>
							</li>
						<?endforeach;?>
					</ul>
				<?endforeach;?>
			</div>

			<ul class="anchor-menu" data-turbolinks="false" data-target="other-sites.menu">
				<?foreach ($arResult['SECTIONS'] as $key => $arSection):?>
					<li class="anchor-menu__item">
						<a class="anchor-menu__link <?= $key == 0 ? 'active' : ''?>"
							href="#<?=$this->GetEditAreaId($arSection['ID']);?>"
							data-action="other-sites#select"><?= $arSection['NAME']?></a>
					</li>
				<?endforeach;?>
			</ul>
		</div>
	</div>
	<button class="modal-window__close" data-action="modal-window#onClose">
		<svg class="icon" role="img">
			<use xlink:href="<?=ASSET_PATH?>icons.svg#close-button"/>
		</svg>
	</button>
</div>