<?
	$query = $arResult["REQUEST"]["QUERY"];

	if (count($arResult["SEARCH"]) > 0):
		$curentSection = '';
		$resultFinalArray = [];
		$query = $arResult["REQUEST"]["QUERY"];
		foreach ($arResult["SEARCH"] as $arItem):

					if ($curentSection != $arResult['DROPDOWN']['iblock_'.$arItem['PARAM1']] && $arItem['MODULE_ID'] == 'iblock'):
						$curentSection = $arResult['DROPDOWN']['iblock_'.$arItem['PARAM1']];

					elseif ($arItem['MODULE_ID'] != 'iblock' && $curentSection != 'Страницы'):
						$curentSection = 'Страницы';
					endif;

					$resultFinalArray[$curentSection][] = array(
						'URL_WO_PARAMS' => $arItem["URL_WO_PARAMS"],
						'PARAM2' => $arItem["PARAM2"],
						'TITLE_FORMATED' => $arItem["TITLE_FORMATED"],
						'BODY_FORMATED' => $arItem["BODY_FORMATED"],
						"DATE_CHANGE" => $arItem["DATE_CHANGE"]
					);


		endforeach;
			$arResult['DATA'] = $resultFinalArray;
	else:
		$arResult['DATA'] = [];
	endif;
	$arResult["REQUEST"]["QUERY"] = $query;