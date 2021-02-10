<?
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
if (!$_SERVER["REAL_FILE_PATH"]) {
    require($_SERVER["DOCUMENT_ROOT"] . "/local/templates/main/header.php");
}

$APPLICATION->SetTitle("Страница не найдена");
$APPLICATION->SetPageProperty("keywords", "Страница не найдена");
$APPLICATION->SetPageProperty("description", "Страница не найдена");

if ($_SERVER["ENVIRONMENT"] == "production") {
    echo '<script type="text/javascript" src="<?=ASSET_PATH?>static_page_2.js"></script>';
} else {
    echo '<script type="text/javascript" src="http://localhost:3808/webpack/static_page_2.js"></script>';
}
?>

<div class="b-page">
    <div class="static-page-2">
        <div class="static-page-2-content">
            <div class="container">
                    <div class="not-found-wrapper">
                        <h1 class="not-found">404</h1>
                        <p class="not-found-description">Страница не найдена</p>
                        <div class="not-found-button-wrapper">
                            <a href="/" class="base-button--middle not-found-to-main-page-link">
                                Перейти на главную
                            </a>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/local/templates/main/footer.php");?>