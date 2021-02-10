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

foreach ($arResult["ITEMS"] as $arItem):?>
	<?
  $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
  $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => 'Удалить'));
	?>
	<?if($arParams['NEWS_COUNT'] != 1):?>
		<li class="important-links__item">
	<?endif;?>

		<?if(!empty($arItem['PROPERTIES']['FILE']['VALUE'])):?>
			<?
				$path = CFile::GetPath($arItem['PROPERTIES']['FILE']['VALUE']);
				$arInfo = pathinfo($path);
				?>
			<li class="important-links__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
				<a class="document-link" href="<?=$path?>" target="_blank">
					<svg class="document-link__icon icon" role="img"><use xlink:href="<?=ASSET_PATH?>icons.svg#paper"/></svg>
					<span class="document-link__title">
						<span class="document-link__name"><?=$arItem['NAME']?></span>
						<span class="document-link__data"><?=strtoupper($arInfo['extension']);?> (<?=getFileSize(filesize($_SERVER["DOCUMENT_ROOT"].$path))?>)</span>
					</span>
				</a>
			</li>
		<?else:
			if($arParams['NEWS_COUNT'] == 1) 
				$class = 'person-info--single';
			elseif($arParams['BIG_IMG'] == 'Y')
				$class = 'person-info--big-photo';
			else
				$class = '';
			?>

			<div class="person-info <?=$class?>" id="<?=$this->GetEditAreaId($arItem['ID'])?>">
				<?if($arItem['PREVIEW_PICTURE']['ID'] > 0):?>
					<img class="person-info__photo" src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="<?=$arItem['NAME']?>">
				<?else:?>
					<svg class="person-info__photo icon" role="img"><use xlink:href="<?=ASSET_PATH?>icons.svg#default-avatar"></use></svg>
				<?endif;?>
			
				<div class="person-info__description">
					<?if($arItem['PROPERTIES']['INFO']['VALUE_XML_ID'] == 'Y'):?>
						<a class="person-info__name" href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem['NAME']?></a>
					<?else:?>
						<span class="person-info__name"><?=$arItem['NAME']?></span>
					<?endif;?>
					
					<span class="person-info__position">
						<?if(!empty($arItem['PROPERTIES']['POSITION']['VALUE'])):?>
							<?=$arItem['PROPERTIES']['POSITION']['VALUE']?>
						<?else:?>
							<?=$arItem['PREVIEW_TEXT']?>
						<?endif;?>
					</span>
			
					<?if(!empty($arItem['PROPERTIES']['EMAIL']['VALUE']) && $arParams['LINK_NAME'] != 'Y'):?>
						<div class="person-info__contacts">
							<strong>Электронная почта</strong>
							<a class="person-info__contact-email" href="mailto:<?=$arItem['PROPERTIES']['EMAIL']['VALUE']?>"><?=$arItem['PROPERTIES']['EMAIL']['VALUE']?></a>
						</div>
					<?endif;?>
				</div>
			</div>
		<?endif;?>

	<?if($arParams['NEWS_COUNT'] != 1):?>
		</li>
	<?endif;?>
<?endforeach;?>