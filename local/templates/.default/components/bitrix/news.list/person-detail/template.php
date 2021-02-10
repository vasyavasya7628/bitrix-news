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
$arItem = $arResult["ITEMS"][0];?>

<section class="page-section">
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => 'Удалить'));
	?>
  <header class="page-header">
    <div class="person-info person-info--detailed person-info--single" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
			<?if(!empty($arItem['DETAIL_PICTURE']['SRC'])):?>
      	<img class="person-info__photo" src="<?=$arItem['DETAIL_PICTURE']['SRC']?>" alt="<?=$arItem['NAME']?>">
			<?else:?>
				<svg class="person-info__photo icon" role="img"><use xlink:href="/public/webpack/icons.svg#default-avatar"></use></svg>
			<?endif;?>
      <div class="person-info__description">
				<h1 class="person-info__name light"><?=$arItem['NAME']?></h1>
				<?if(!empty($arItem['PROPERTIES']['POSITION']['VALUE'])):?>
					<div class="person-info__position"><?=$arItem['PROPERTIES']['POSITION']['VALUE']?></div>
				<?endif;?>

        <div class="description-list">
					<?if(!empty($arItem['PROPERTIES']['CITY']['VALUE'])):?>
						<strong class="description-list__term">Город</strong>
						<div class="description-list__description"><?=$arItem['PROPERTIES']['CITY']['VALUE']?></div>
					<?endif;?>
					
					<?if(!empty($arItem['PROPERTIES']['EMAIL']['VALUE'])):?>
						<strong class="description-list__term">Электронная почта</strong>
						<div class="description-list__description">
							<a href="mailto:<?=$arItem['PROPERTIES']['EMAIL']['VALUE']?>"><?=$arItem['PROPERTIES']['EMAIL']['VALUE']?></a>
						</div>
					<?endif;?>

					<?if(!empty($arItem['PROPERTIES']['VK']['VALUE']) || !empty($arItem['PROPERTIES']['FB']['VALUE'])):?>
						<strong class="description-list__term">Соцсети</strong>
						<div class="description-list__description">
							<ul class="links">
								<?if(!empty($arItem['PROPERTIES']['VK']['VALUE'])):?>
									<li class="links__item">
										<a class="links__link" href="<?=$arItem['PROPERTIES']['VK']['VALUE']?>" target="_blank" rel="nofollow noreferer">ВКонтакте</a>
									</li>
								<?endif;?>

								<?if(!empty($arItem['PROPERTIES']['FB']['VALUE'])):?>
									<li class="links__item">
										<a class="links__link" href="<?=$arItem['PROPERTIES']['FB']['VALUE']?>" target="_blank" rel="nofollow noreferer">Facebook</a>
									</li>
								<?endif;?>
							</ul>
						</div>
					<?endif;?>

        </div>
      </div>
		</div>
		
    <a class="back-link" href="<?=!empty($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/'?>">
      <svg class="icon" role="img"><use xlink:href="<?=ASSET_PATH?>icons.svg#dropdown-arrow"/></svg>
      Палата
    </a>
  </header>
  <div class="grid-container">
    <div class="anchor-navigation" data-controller="anchor-navigation"
      data-action="scroll@document->anchor-navigation#update resize@window->anchor-navigation#onResize">

      <div class="anchor-navigation__content">
				<?if(!empty($arItem['PREVIEW_TEXT'])):?>
					<h2 id="intelligence" data-target="anchor-navigation.section">Сведения</h2>
					<div class="content-block">
						<?=$arItem['PREVIEW_TEXT']?>
					</div>
				<?endif;?>

				<?if(!empty($arItem['DETAIL_TEXT'])):?>
					<h2 id="biography" data-target="anchor-navigation.section">Биография</h2>
					<div class="content-block">
						<?=$arItem['DETAIL_TEXT']?>
					</div>
				<?endif;?>

				<?
				$arGroupList = array();
				$dbGroups = CIBlockElement::GetElementGroups($arItem['ID'], false, ['ID']);
				$ar_new_groups = Array($NEW_GROUP_ID);
				while($arGroup = $dbGroups->Fetch()){
					$arGroupList[] = $arGroup['ID'];
				}
				?>
				<?if(!empty($arGroupList)):?>
					<h2 id="commissions-and-working-groups" data-target="anchor-navigation.section">Входит в&nbsp;состав</h2>
					<ul class="important-links">
					<?foreach($arResult['GROUP_LIST'] as $arGroup):?>
						<?foreach($arGroupList as $id):?>
							<?
							if(!isset($arGroup['CHILD'][$id])) continue;
							$link = $arGroup['CHILD'][$id]['LINK'];
							$name = $arGroup['CHILD'][$id]['NAME'];	

							if($arGroup['CHILD'][$id]['NAME'] == 'Председатель и заместители')
								$name = $arGroup['NAME'];
							?>
							<li class="important-links__item">
								<a href="<?=$link?>" target="_blank"><?=$name?></a>
							</li>
						<?endforeach;?>
					<?endforeach;?>
					</ul>
				<?endif;?>
				
      </div>
      <ul class="anchor-menu" data-controller="anchor-menu" data-turbolinks="false">
				<?if(!empty($arItem['PREVIEW_TEXT'])):?>
					<li class="anchor-menu__item">
						<a class="anchor-menu__link active"
							data-target="anchor-navigation.link"
							href="#intelligence"
							data-action="anchor-menu#navigate">Сведения о&nbsp;члене ОП</a>
					</li>
				<?endif;?>

				<?if(!empty($arItem['DETAIL_TEXT'])):?>
					<li class="anchor-menu__item">
						<a class="anchor-menu__link"
							data-target="anchor-navigation.link"
							href="#biography"
							data-action="anchor-menu#navigate">Биография</a>
					</li>
				<?endif;?>
        
        <li class="anchor-menu__item">
          <a class="anchor-menu__link"
            data-target="anchor-navigation.link"
            href="#commissions-and-working-groups"
            data-action="anchor-menu#navigate">Комиссии и&nbsp;рабочие группы</a>
        </li>
      </ul>
    </div>
  </div>
</section>