<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div id="all-sections-modal" class="modal-window all-sections-modal" data-target="modal-window.window">
    <div class="modal-window__content">
        <div class="all-sections">
            <?
            $currentLevel = 0;
            foreach($arResult as $arItem):
                // if($arParams["MAX_LEVEL"] == 2 && $arResult[$i]["DEPTH_LEVEL"] > 2)
                //     continue;

                // если элемент выше предыдущего, то закрываем блок ссылок
                if($arItem["DEPTH_LEVEL"] < $currentLevel):?>
                    </ul></div>
                <?endif;?>

                <?if($arItem["DEPTH_LEVEL"] == 1):?>
                    <div class="all-sections__column">
                        <h3 class="all-sections__title"><a href="<?=$arItem["LINK"];?>" class="all-sections__link"><?=$arItem["TEXT"];?></a></h3>
                        <?if($arItem["IS_PARENT"] == 1):?>
                            <ul class="links">
                        <?else:?>
                            </div>
                        <?endif;?>
                <?else:?>
                    <li class="links__item"><a class="links__link" href="<?=$arItem["LINK"];?>"><?=$arItem["TEXT"];?></a></li>
                <?endif;?>
                <?$currentLevel = $arItem["DEPTH_LEVEL"];?>
            <?endforeach;?>
            <?if($currentLevel !== 1):?>
                    </ul>
                </div>
            <?endif;?>

        </div>
    </div>
    
    <button class="modal-window__close" data-action="modal-window#onClose">
        <svg class="icon" role="img">
            <use xlink:href="<?=ASSET_PATH?>icons.svg#close-button"/>
        </svg>
    </button>
</div>