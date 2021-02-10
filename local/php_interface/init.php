<?
    try {
        \Bitrix\Main\Loader::registerAutoLoadClasses(
            "highloadblock", array("HighloadBlockTable" => "include.php")
        );
    } catch (Exception $e) {
        echo $e->getMessage();
    }

    CModule::IncludeModule("iblock");
    CModule::IncludeModule('highloadblock');

    define('BX_COMPRESSION_DISABLED',true);
    define('ENVIRONMENT', 'production');
    define('ASSET_PATH', '/public/webpack/');

    function getFileSize($size) {
        if($size > 1000000) {
            return round($size / 1000000) . " Мб";
        } elseif ($size > 1000) {
            return round($size / 1000) . " кб";
        } else {
            return $size . " б";
        }
    }

    function GetEntityDataClass($HlBlockId) {
        if (empty($HlBlockId) || $HlBlockId < 1)
        {
            return false;
        }
        $hlblock = HLBT::getById($HlBlockId)->fetch();	
        $entity = HLBT::compileEntity($hlblock);
        $entity_data_class = $entity->getDataClass();
        return $entity_data_class;
    }

    function getPhoneForLink($phoneString) {
        $length = strlen($phoneString);
        $phoneLink = "";

        for($i = 0; $i < $length; $i++) {
            $char = $phoneString[$i];
            if (is_numeric($char)) {
                $phoneLink = $phoneLink . $char;
            }
        }

        $phoneLink = "+" . $phoneLink;
        return $phoneLink;
    }

    function getElement($iblockId, $id) {
        $db_element = CIBlockElement::GetList([], ["IBLOCK_ID" => $iblockId, "ID" => $id]);
        $db_element = $db_element->GetNextElement();
        if ($db_element) {
            $arElement = $db_element->GetFields();
            $arElement["PROPERTIES"] = $db_element->GetProperties();
            return $arElement;
        } else {
            return false;
        }
    }

    function autoVer($url){
        return $url."?v=".filemtime($_SERVER['DOCUMENT_ROOT'].$url);
    }

//AddEventHandler("main",'OnFileSave','OnFileSave');
function OnFileSave(&$arFile, $fileName, $module)
{
	// Если загружается картинка, то сжимаем ее до 1024х768
	if(in_array($arFile['type'],array('image/gif','image/png','image/jpeg')))
	{
		if(CModule::IncludeModule("iblock"))
		{
			$arNewFile = CIBlock::ResizePicture($arFile, array("WIDTH" => 1920, "HEIGHT" => 1080, "METHOD" => "resample"));
			if(is_array($arNewFile))
				$arFile = $arNewFile;
			else
				$APPLICATION->throwException("Ошибка масштабирования изображения в свойстве \"Файлы\":".$arNewFile);
		}
	}

}

function getElCount($arFilter) {
    CModule::IncludeModule('iblock');
    $res = CIBlockElement::GetList(false, $arFilter, array('IBLOCK_ID'));
    if ($el = $res->Fetch())
        return $el['CNT'];

    return 0;
}
?>
