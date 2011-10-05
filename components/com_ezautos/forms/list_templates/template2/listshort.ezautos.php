<?php

#############################################################################
#                                                                           #
#  EZ Autos 5.0.0 - A Mambo Motor Vehicle Sales Listing component           #
#  By: Kathy Strickland (aka PixelBunyiP)                                   #
#  Copyright (C) 2006 K.J. Strickland, Raptor Developments Pty Ltd          #
#  All rights reserved                                                      #
#  http://www.raptorservices.com.au                                         #
#  Released as a commercial component!                                      #
#                                                                           #
#############################################################################

//Don't allow direct linking
  defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

$link = sefRelToAbs( 'index.php?option=com_ezautos&amp;task=detail&amp;id='. $row->id .'&amp;Itemid='. $myItemid );

$status3 = 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=500,height=400,directories=no,location=no';
$link5 = $mosConfig_live_site. '/index2.php?option=com_ezautos&amp;task=lightbox&amp;id='.$row->id.'&amp;Itemid='.$myItemid;

if (mosGetParam($_REQUEST, 'option', '') == "com_ezautos" && mosGetParam($_REQUEST, 'task', '') == "viewlightbox") {
	$link6 = sefRelToAbs( 'index.php?option=com_ezautos&amp;task=removelightbox&amp;id='. $row->litem .'&amp;Itemid='. $myItemid );
}

	$link7 = sefRelToAbs( 'index.php?option=com_ezautos&amp;task=viewlightbox&amp;Itemid='. $myItemid );

?>


<table border="0" width="100%" cellpadding="5" cellspacing="5">
	<tr>
		<td valign="top" rowspan="2" width="<?php echo $ea_thumbwidth;?>"><div align="center">

<div id="watermark_box">
<a href="<?php echo $link; ?>">
<?php if ($row->images) { 

$imagekey = explode(",",$row->images);
$myimage=$imagekey[0];

?>
<img src="<?php echo $myimage;?>" border="0" style="margin-top: 5px; margin-bottom: 5px; padding-left: 5px; margin-right: 5px" width="<?php echo $ea_thumbwidth;?>" alt="<?php echo $row->year.' '.$row->makename.' '.$row->modelname.' '.$row->derivative;?>" />
<?php
} else {
if ($row->image1) { ?><img src="<?php echo $mosConfig_live_site;?>/components/com_ezautos/<?php echo $ea_imagedirectory;?><?php if ( $ea_thumbcreation !== 'none' ) { ?>/th<?php } ?>/<?php echo $row->image1;?>" border="0" style="margin-top: 5px; margin-bottom: 5px; padding-left: 5px; margin-right: 5px" width="<?php echo $ea_thumbwidth;?>" title="<?php echo $row->year.' '.$row->makename.' '.$row->modelname.' '.$row->derivative;?>" alt="<?php echo $row->year.' '.$row->makename.' '.$row->modelname.' '.$row->derivative;?>" /><?php }else{ ?>
<img src="<?php echo $mosConfig_live_site;?>/components/com_ezautos/<?php echo $ea_imagedirectory;?>/th/nothumb.gif" border="0" style="margin-top: 5px; margin-bottom: 5px; padding-left: 5px; margin-right: 5px" width="<?php echo $ea_thumbwidth;?>" title="<?php echo $row->year.' '.$row->makename.' '.$row->modelname.' '.$row->derivative;?>" alt="<?php echo $row->year.' '.$row->makename.' '.$row->modelname.' '.$row->derivative;?>" /><?php } ?>
<?php } ?>
<?php if ( $ea_watermark ){ ?>
<?php if ( $row->availability==_EZAUTOS_AVAIL_SOLD ){ ?>
<img src="<?php echo $mosConfig_live_site;?>/components/com_ezautos/images/sold.png" class="watermark" style="margin-top: 5px; margin-bottom: 5px; padding-left: 5px; margin-right: 5px" alt="" />
<?php } ?>
<?php if ( $row->featured==1 && $row->availability!=_EZAUTOS_AVAIL_SOLD ){ ?>
<img src="<?php echo $mosConfig_live_site;?>/components/com_ezautos/images/wow.png" class="watermark" style="margin-top: 5px; margin-bottom: 5px; padding-left: 5px; margin-right: 5px" alt="" />
<?php } ?>
<?php } ?>
</a>
</div>

</div></td>
		<td class="h3" valign="top"><div align="left"><?php echo $row->year.' '.$row->makename.' '.$row->modelname.' '.$row->derivative;?></div>


<?php echo $row->trans;?> 

<?php if ( $row->doors ) { ?>
<?php

if ($row->doors == 0) {
		echo _EZAUTOS_SPECS_DOORSNS;
}
if ($row->doors == 1) {
		echo _EZAUTOS_SPECS_DOORS1;
}
if ($row->doors == 2) {
		echo _EZAUTOS_SPECS_DOORS2;
}
if ($row->doors == 3) {
		echo _EZAUTOS_SPECS_DOORS3;
}
if ($row->doors == 4) {
		echo _EZAUTOS_SPECS_DOORS4;
}
if ($row->doors == 5) {
		echo _EZAUTOS_SPECS_DOORS5;
}
if ($row->doors == 6) {
		echo _EZAUTOS_SPECS_DOORS6;
}
if ($row->doors == 7) {
		echo _EZAUTOS_SPECS_DOORS7;
}
if ($row->doors == 8) {
		echo _EZAUTOS_SPECS_DOORS8;
}
if ($row->doors == 9) {
		echo _EZAUTOS_SPECS_DOORS9;
}

?>
 <?php echo _EZAUTOS_SPECS_DOORS.' ';?>
<?php } ?>
<?php
if ($row->body > 1 && $row->body <13){
if ($row->body == 1) { echo _EZAUTOS_SPECS_BODY1; }
if ($row->body == 2) { echo _EZAUTOS_SPECS_BODY2; }
if ($row->body == 3) { echo _EZAUTOS_SPECS_BODY3; }
if ($row->body == 4) { echo _EZAUTOS_SPECS_BODY4; }
if ($row->body == 5) { echo _EZAUTOS_SPECS_BODY5; }
if ($row->body == 6) { echo _EZAUTOS_SPECS_BODY6; }
if ($row->body == 7) { echo _EZAUTOS_SPECS_BODY7; }
if ($row->body == 8) { echo _EZAUTOS_SPECS_BODY8; }
if ($row->body == 9) { echo _EZAUTOS_SPECS_BODY9; }
if ($row->body == 10) { echo _EZAUTOS_SPECS_BODY10; }
if ($row->body == 11) { echo _EZAUTOS_SPECS_BODY11; }
if ($row->body == 12) { echo _EZAUTOS_SPECS_BODY12; }
}else{
if ($row->body !=0){
echo $row->body;
}
}
?>
<?php if ( $row->doorsbody && !$row->doors OR !$row->body ) { ?>
<?php echo $row->doorsbody;?> 
<?php } ?>

<?php if ($row->tag){ ?>(<?php echo $row->tag;?>)<?php } ?>

</td>
		<td width="150" valign="top" class="h3"><div align="left">
<?php 
if ( $ea_sitetype==0 ) {
	if ( $row->showprice && $row->price != 0 ) {
		if ( $ea_currencypos==0 ) {
			echo $ea_currencysign.''.$formatted_price.' '.$row->price_type;
		} else {
			echo $formatted_price.' '.$ea_currencysign.' '.$row->price_type;
		}
	} else {
		echo $row->price_type;
		if (!$row->price_type) { echo _EZAUTOS_POR; }
	}
	if ( $row->freq ) {
		if ($row->freq == 1) { echo _EZAUTOS_RENTAL_DAILY; }
		if ($row->freq == 2) { echo _EZAUTOS_RENTAL_WEEKLY; }
		if ($row->freq == 3) { echo _EZAUTOS_RENTAL_FNIGHT; }
		if ($row->freq == 4) { echo _EZAUTOS_RENTAL_MONTH; }
	}
}
?>
</div></td>
		<td width="70">

<div align="center"><input class="button" type="button" value="<?php echo _EZAUTOS_READMORE;?>" onclick="location.href='<?php echo sefRelToAbs("index.php?option=com_ezautos&amp;Itemid=$myItemid&amp;task=detail&amp;id=$row->id");?>'" /></div>

</td>
	</tr>

</table>

<?php if ( $ea_shortlist ) { ?>
<table border="0" cellpadding="5" cellspacing="0" width="100%">
	<tr>
		<td valign="top" width="<?php echo $ea_thumbwidth;?>">
		</td>
		<td>
<?php if (mosGetParam($_REQUEST, 'option', '') == "com_ezautos" && mosGetParam($_REQUEST, 'task', '') != "viewlightbox") { ?>
<div align="left"><img src="<?php echo $mosConfig_live_site;?>/components/com_ezautos/images/add_lightbox.gif" alt="" align="top" hspace="5" border="0" />&nbsp;<a href="javascript:void(0)" onclick="window.open('<?php echo $link5; ?>','win2','<?php echo $status3; ?>');" title="<?php echo _EZAUTOS_LISTINGS_ADDLIGHTBOX;?>"><?php echo _EZAUTOS_LISTINGS_ADDLIGHTBOX;?></a> | 
 <img src="<?php echo $mosConfig_live_site;?>/components/com_ezautos/images/show_lightbox.gif" alt="" align="top" hspace="5" border="0" />&nbsp;<a href="<?php echo $link7; ?>"><?php echo _EZAUTOS_VIEW_LIGHTBOX;?></a></div>

<?php } ?>


<?php if (mosGetParam($_REQUEST, 'option', '') == "com_ezautos" && mosGetParam($_REQUEST, 'task', '') == "viewlightbox") { ?>
<div align="left"><img src="<?php echo $mosConfig_live_site;?>/components/com_ezautos/images/remove_lightbox.gif" alt="" align="top" hspace="5" border="0" />&nbsp;<a href="<?php echo $link6; ?>"><?php echo _EZAUTOS_REMOVE_LIGHTBOX;?></a></div>
<?php } ?>


		</td>
	</tr>
</table>
<?php } ?>


			<table border="0" cellpadding="0" cellspacing="0" width="100%" class="sectiontableheader">
				<tr>
					<td><img src="<?php echo $mosConfig_live_site;?>/components/com_ezautos/images/pixel.gif" border="0" height="1" width="1" alt="" /></td>
				</tr>
			</table>

