<!-- friendlink -->
<?php echo get_friendlink(@$cateId,@$lang);?>
<?php
	$front_common_lang = @lang ( 'front_common_home' );
	$arr_footer_lang = @$front_common_lang ['footer'];
	$arr_common_lang=@$front_common_lang['common'];
// 	array_push($arr_footer_lang, $arr_common_lang);
// 	$arr_footer_lang=array_merge($arr_common_lang,$arr_footer_lang);
	//$inputSearch=$arr_footer_lang['inputSearch'];
	$company=$arr_common_lang['company'];
	$websiteRecords=$arr_footer_lang['websiteRecords'];
	$to24Phone=$arr_footer_lang['to24Phone'];
	$address=$arr_footer_lang['address'];
	$allRightReserved=$arr_footer_lang['allRightReserved'];
	$designBy=$arr_footer_lang['designBy'];
	
	$copyRight='Copyright '.date('Y',time()).' © ';
?>

<!-- footer -->
<div class="footer">
	<div class="footer_t">
		<p>
			<?=$copyRight.$company; ?>
			&nbsp;&nbsp;<?=$websiteRecords;?>&nbsp;&nbsp; <label
				style="color: #0094ff; font-weight: bolder;"><?=$to24Phone; ?></label>
		</p>
		<p>
			<?=$address; ?>&nbsp;&nbsp;<?=$allRightReserved.' '.$designBy; ?>
		</p>
	</div>
</div>
</div>

</body>
</html>