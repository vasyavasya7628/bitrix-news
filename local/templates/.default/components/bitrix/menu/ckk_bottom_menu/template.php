<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
die();
?>

<?if (!empty($arResult)):?>
<ul class="footer__navigation-block">
	<?
	foreach($arResult as $item):
	?>
	<li class="footer__navigation-item">
		<a class="footer__button" href="<?=$item["LINK"]?>">
			<?=$item["TEXT"]?>
		</a>
	</li>
	<?endforeach;?>
</ul>
<?endif;?>