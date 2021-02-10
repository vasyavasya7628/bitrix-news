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
$this->setFrameMode(true);
$popup_query = parse_url($_SERVER["REQUEST_URI"])["query"];
$social_title = $arResult["NAME"];

$arBackUrl = explode('/', $_SERVER['HTTP_REFERER']);
$deep = $arParams['IBLOCK_ID'] == 22 ? 6 : 5;
?>

<section class="article">
    <header class="article__header">
        <h1 class="article__title"><?=$arResult["NAME"]?></h1>
        <time class="article__publication-date" datetime="<?=FormatDateFromDB($arResult["ACTIVE_FROM"], "YYYY-MM-DD");?>">
            <?=FormatDateFromDB($arResult["ACTIVE_FROM"], "DD MMMM YYYY, HH:MI");?>
        </time>
        <?if(empty($_SERVER['HTTP_REFERER']) || strpos($_SERVER['HTTP_REFERER'], 'press-tsentr') !== false):?>
            <a class="back-link" href="/press-tsentr/">
                <svg class="icon" role="img"><use xlink:href="<?=ASSET_PATH?>icons.svg#dropdown-arrow"/></svg>
                Пресс-центр
            </a>
        <?elseif(strpos($_SERVER['HTTP_REFERER'], '/deyatelnost/obshchestvennyy-kontrol/meropriyatiya/') !== false):?>
            <a class="back-link" href="/deyatelnost/obshchestvennyy-kontrol/meropriyatiya/<?=!empty($arBackUrl[$deep]) ? $arBackUrl[$deep].'/' : ''?>">
                <svg class="icon" role="img"><use xlink:href="<?=ASSET_PATH?>icons.svg#dropdown-arrow"/></svg>
                Мероприятия
            </a>
        <?elseif(strpos($_SERVER['HTTP_REFERER'], '/deyatelnost/meropriyatiya/') !== false):?>
            <a class="back-link" href="/deyatelnost/meropriyatiya/<?=!empty($arBackUrl[$deep]) ? $arBackUrl[$deep].'/' : ''?>">
                <svg class="icon" role="img"><use xlink:href="<?=ASSET_PATH?>icons.svg#dropdown-arrow"/></svg>
                Мероприятия
            </a>
        <?elseif(strpos($_SERVER['HTTP_REFERER'], '/deyatelnost/proekty/') !== false):?>
            <a class="back-link" href="/deyatelnost/proekty/">
                <svg class="icon" role="img"><use xlink:href="<?=ASSET_PATH?>icons.svg#dropdown-arrow"/></svg>
                Проекты
            </a>
        <?elseif(strpos($_SERVER['HTTP_REFERER'], '/resursnyy-tsentr-nko/novosty-nko/') !== false):?>
            <a class="back-link" href="/resursnyy-tsentr-nko/novosty-nko/">
                <svg class="icon" role="img"><use xlink:href="<?=ASSET_PATH?>icons.svg#dropdown-arrow"/></svg>
                Новости НКО
            </a>
        <?elseif(strpos($_SERVER['HTTP_REFERER'], '/munitsipalnye-palaty/novosti-munitsipalnykh-palat/') !== false):?>
            <a class="back-link" href="/munitsipalnye-palaty/novosti-munitsipalnykh-palat/">
                <svg class="icon" role="img"><use xlink:href="<?=ASSET_PATH?>icons.svg#dropdown-arrow"/></svg>
                Новости муниципальных палат
            </a>
        <?else:?>
            <a class="back-link" href="/">
                <svg class="icon" role="img"><use xlink:href="<?=ASSET_PATH?>icons.svg#dropdown-arrow"/></svg>
                Главная страница
            </a>
        <?endif;?>
    </header>
    <div class="article__content-wrapper">
        <div class="article__lead content-block"><?=$arResult["PREVIEW_TEXT"]?></div>
    </div>
    <div class="article__content-wrapper">
        <div class="article__content content-block">
            <?=htmlspecialchars_decode($arResult["DETAIL_TEXT"])?>
        </div>
    </div>
</section>