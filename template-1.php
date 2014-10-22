<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="news_detail">

		<?if(count($arResult["ITEMS_THEME"]) > 0 ):?>
   		 <div class='readalse_newsdetail'>
		 		<span><?=GetMessage('READ_ALSO_TITLE')?>:</span>

			<?foreach($arResult["ITEMS_THEME"] as $pid=>$arProperty):?>
				<p><?=$arProperty?></p>
			<?endforeach;?>
   		</div>
		<?endif?>
	

<script>
$(document).ready(function() {
	$("#caruselreadaslo").carouFredSel({
	    items: 3,
	    circular: true,
	    auto : 6000,
     	scroll : {
	        pauseOnHover : true,
	        fx : 'fade',
	        pauseDuration : 6000,
	        duration : 300
				 },
	    prev : {
	        button  : "#caruselreadaslo_prev",
	        key     : "left"
	    },
	    next : {
	        button  : "#caruselreadaslo_next",
	        key     : "right"
	    },
	    pagination  : "#caruselreadaslo_pag"
	});
});
</script>


<?if(count($arResult["ITEMS_THEME_CARUSEL"]) > 0):?>
<div style="clear:both"></div>
<div class="caruselreadaslo_wrapper">
<div class='carusel-article-title'><?=GetMessage('READ_ALSO_CARUCEL_TITLE')?></div>
<div class='carusel-article-title-separator'></div>
<div id="caruselreadaslo">

<?
$alt_text = "";
$title_text = "";
?>
<?foreach($arResult["ITEMS_THEME_CARUSEL"] as $key=>$arItem):?>

	<div class='caruselreadaslo-item'>
    <?
  	//$hmargin = ($arItem["DISPLAY_PROPERTIES"]["YEN_PHOTO_LIST"]['FILE_VALUE']['HEIGHT'] - 80) / 2;
  	//$hmargin *= -1;
  	$hmargin = 0;
    ?>

<?
  		if(strlen($arResult["DISPLAY_PROPERTIES"]["YEN_PHOTO_ORIGINAL"]['DESCRIPTION'][0]) > 0)
			{
			  $alt_text = $arResult["DISPLAY_PROPERTIES"]["YEN_PHOTO_ORIGINAL"]['DESCRIPTION'][0];
			}
			if(strlen($alt_text) == 0) $alt_text = $arResult["NAME"];

			if(strlen($arResult["DISPLAY_PROPERTIES"]["TITLE_IMAGES"]['VALUE'][0]) > 0)
			{
			  $title_text = $arResult["DISPLAY_PROPERTIES"]["TITLE_IMAGES"]['VALUE'][0];
			}
			if(strlen($title_text) == 0) $title_text = $arResult["NAME"];

?>
		<?if($arItem["DISPLAY_PROPERTIES"]["YEN_PHOTO_LIST"]['VALUE'] > 0):?>
			<?$picture_param = "border=0 alt='".$alt_text."' title='".$title_text."' style='margin-top:".$hmargin."px'";?>

      <div class='carucel-img'>
    	<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
			<a href="<?echo $arItem["DETAIL_PAGE_URL"]?>">
			<?endif?>

			<?echo CFile::ShowImage($arItem["DISPLAY_PROPERTIES"]["YEN_PHOTO_LIST"]['VALUE'], 150, 1000, $picture_param, "", false);?>

			<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
			</a>
			<?endif?>
			</div>
  	<?endif?>

  	<?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?>
  		<div style="clear:both"></div>
			<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
				<h3 class='caruselreadaslonews-item'><a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><?echo $arItem["NAME"]?></a>
				</h3>
			<?else:?>
				<h3 class='caruselreadaslonews-item'><?echo $arItem["NAME"]?>
				</h3>
			<?endif;?>
		<?endif;?>

  <div style="clear:both"></div>
	</div>

<?endforeach?>

  </div>
	    <div class="clearfix"></div>
	    <a class="prev" id="caruselreadaslo_prev" href="#"><span>prev</span></a>
	    <a class="next" id="caruselreadaslo_next" href="#"><span>next</span></a>
	    <div class="pagination" id="caruselreadaslo_pag"></div>
	</div>
	
<?endif?>

	<div style="clear:both"></div>
<script>
$(function(){
	$('#mistake_form').submit(function() {        
	  var mistake = document.getElementById('mistake_text');
		$.ajax({
  		type: "POST",
  		url: "<?=SITE_TEMPLATE_PATH?>/send_mistake.php",
  		data: "sendstr=" + mistake.value + "&url_mistake_text=<?=htmlspecialcharsEx($_SERVER["HTTP_HOST"]);?><?=htmlspecialcharsEx($_SERVER["REQUEST_URI"]);?>",
		  success: function(html){
	    	alert('<?=GetMessage("HELP_MISTAKE5")?>');
   		}
		});

	  mistake.value = "";
  	return false;
	});

	$(document).keypress(function(e){
			//alert(e.ctrlKey);
			//alert(e.keyCode);
  	  if (e.ctrlKey && (e.keyCode == 13 || e.keyCode == 10)) {
				var ie = false;
    			if ( window.getSelection ) {
        		var selectedText = window.getSelection();
    			} else if ( document.getSelection ) {
        		var selectedText = document.getSelection();
    			} else if ( document.selection ) {
        		ie = true;
        		var selectedText = document.selection.createRange();
    			}
    			if(!ie){
        		mistake_Text = selectedText;
    			}else{
        		mistake_Text = selectedText.text;
        	}
        	var retVal = confirm(mistake_Text + "\n\n<?=GetMessage('HELP_MISTAKE3')?>" + "\n<?=GetMessage('HELP_MISTAKE4')?>");

        	if(retVal == true) {
        		var mistake = document.getElementById('mistake_text');
        		mistake.value = mistake_Text;
        	  $('#mistake_form').submit();
					}
    	}
	});
});
</script>
	<div class="mistake">
	
	<!--
	<form id="mistake_form" class="ajax form ajax-ready" rel="{"connector":"box_tsnua","point":"central_article"}" enctype="multipart/form-data" method="post" action="/ukrayina/kabmin-urizav-derzhzamovlennya-dlya-vishiv.html#mistake_msg">
	-->
	
	<form id="mistake_form" name='mistake_form' action="" method="post">
		<div class="caption"><?=GetMessage('HELP_MISTAKE1')?></div>
		<div class="content"><?=GetMessage('HELP_MISTAKE2')?></div>
		<input id="mistake_text" type="hidden" value="" name="mistake_text">
	</form>
	</div>

</div>

<?//echo "<pre width='95' style=\"font-size:11px\">Template "; print_r($arResult['DETAIL_PAGE_URL']); echo "</pre>";?>