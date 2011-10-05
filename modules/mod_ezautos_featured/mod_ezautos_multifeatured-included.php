<?php



/**

* FileName: mod_ezautos_multifeatured.php

* Date: 14-10-2008

* License: Commercial copyright

* Script Version #: 1.8

* EZ Autos Version #: 5.2.0 stable

* Author: K.J. Strickland - http://www.raptorservices.com.au

**/



/** ensure this file is being included by a parent file */

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );





# Kill notices because people panic for no reason

error_reporting(E_ALL ^ E_NOTICE);



# call some core configuration variables:

global $mainframe, $mosConfig_lang;



DEFINE("EZADMIN_PATH5b","administrator/components/com_ezautos");



if (file_exists(EZADMIN_PATH5b."/config.ezautos.php")) {

  include(EZADMIN_PATH5b."/config.ezautos.php");

} else {

echo 'Configuration file not available';

}



# Get the right language file



if ($ea_cms == 3){

DEFINE("LANGUAGE_PATH5b","modules/mod_ezautos_multifeatured/mod_ezautos_multifeatured");

} else {

DEFINE("LANGUAGE_PATH5b","modules/mod_ezautos_multifeatured");

}



if (file_exists(LANGUAGE_PATH5b."/".$mainframe->getCfg( 'lang' ).".php")) {

  include(LANGUAGE_PATH5b."/".$mainframe->getCfg( 'lang' ).".php");

} elseif (file_exists(LANGUAGE_PATH5b."/english.php"))  {

  include(LANGUAGE_PATH5b."/english.php");

} else {

echo "Language file is not available";

}





$moduleclass_sfx    = $params->get( 'moduleclass_sfx' );

$count 		= intval( $params->get( 'count', 5 ) );

$horizspace = $params->get( 'horizspace' ) ;

$vertspace = $params->get( 'vertspace' ) ;

$colcount 	= $params->get( 'colcount' ) ;

$colwidth 	= $params->get( 'colwidth' ) ;

$align		= $params->get( 'align' ) ;

$slimbox3 	= $params->get( 'slimbox3' ) ;

$popwidth3 	= $params->get( 'popwidth3' ) ;

?> <div   align="center"> <div  align="center"> <div align="center" > <div align="center" > 
<?php

echo '<table width="100%" >';

echo '<tr>';





if ( $ea_expmgmt==1 ) {



if ( $ea_expsys==0 ) {



	$query = "SELECT a.*, ma.make as makename, mo.model as modelname"

	. "\n FROM #__ezautos AS a"

    . "\n LEFT JOIN #__ezautos_make as ma ON ma.maid=a.make"

    . "\n LEFT JOIN #__ezautos_model as mo ON mo.moid=a.model"

    . "\n WHERE a.published = '1' AND a.featured = 1 AND a.hits<$ea_impnum ORDER BY RAND() LIMIT $count"

	;

	$database->setQuery( $query );



} else {



$currentdate=mktime(0, 0, 0, date("m"), date("d"), date("Y"));



	$query = "SELECT a.*, ma.make as makename, mo.model as modelname"

	. "\n FROM #__ezautos AS a"

    . "\n LEFT JOIN #__ezautos_make as ma ON ma.maid=a.make"

    . "\n LEFT JOIN #__ezautos_model as mo ON mo.moid=a.model"

    . "\n WHERE a.published = '1' AND a.featured = 1 AND a.expdate>$currentdate ORDER BY RAND() LIMIT $count"

	;

	$database->setQuery( $query );



}



} else {



	$query = "SELECT a.*, ma.make as makename, mo.model as modelname"

	. "\n FROM #__ezautos AS a"

    . "\n LEFT JOIN #__ezautos_make as ma ON ma.maid=a.make"

    . "\n LEFT JOIN #__ezautos_model as mo ON mo.moid=a.model"

    . "\n WHERE a.published = '1' AND a.featured = 1 ORDER BY RAND() LIMIT $count"

	;

	$database->setQuery( $query );



}





	$rows = $database->loadObjectList();

	if ($database->getErrorNum()) {

		echo $database->stderr();

		return false;

	}



    $num_rows=ceil( count( $rows ) / 1 );

	if ($num_rows > 0) {



    $rowcounter = 0;

    foreach($rows as $row) {

      if (($rowcounter%$colcount==0) AND ($rowcounter<>0)) echo "</tr><tr>";





if ($slimbox3 == 1) { ?>
<br />
<a href="<?php echo sefRelToAbs("index.php?option=com_ezautos&amp;task=detail&amp;id=$row->id&amp;Itemid=$myItemid");?>"><strong><?php echo $row->year.' '.$row->makename.' '.$row->modelname.' '.$row->derivative;?></strong></a><br />
<br />
<?php if ($row->image1) { ?>
<a href="components/com_ezautos/<?php echo $ea_imagedirectory;?>/<?php echo $row->image1;?>" rel="lightbox" title="<?php echo $row->year.' '.$row->makename.' '.$row->modelname.' '.$row->derivative;?>">
<?php } ?>
<?php if ($row->image1) { ?>
<img src="<?php echo $mosConfig_live_site;?>/components/com_ezautos/<?php echo $ea_imagedirectory;?><?php if ( $ea_thumbcreation !== 'none' ) { ?>/th<?php } ?>/<?php echo $row->image1;?>" border="0" align="<?php echo $align;?>" style="margin-top: <?php echo $vertspace;?>px; margin-bottom: <?php echo $vertspace;?>px; padding-left: <?php echo $horizspace;?>px; margin-right: <?php echo $horizspace;?>px" width="<?php echo $ea_thumbwidth;?>" title="<?php echo $row->year.' '.$row->makename.' '.$row->modelname.' '.$row->derivative;?>" alt="<?php echo $row->year.' '.$row->makename.' '.$row->modelname.' '.$row->derivative;?>" /> 
<?php }else{ ?>
<img src="<?php echo $mosConfig_live_site;?>/components/com_ezautos/<?php echo $ea_imagedirectory;?>/th/nothumb.gif" align="<?php echo $align;?>" border="0" style="margin-top: <?php echo $vertspace;?>px; margin-bottom: <?php echo $vertspace;?>px; padding-left: <?php echo $horizspace;?>px; margin-right: <?php echo $horizspace;?>px" width="<?php echo $ea_thumbwidth;?>" title="<?php echo $row->year.' '.$row->makename.' '.$row->modelname.' '.$row->derivative;?>" alt="<?php echo $row->year.' '.$row->makename.' '.$row->modelname.' '.$row->derivative;?>" />
<?php } ?>
<?php if ($row->image1) { ?>
</a>
<?php } ?>
<?php echo $row->smalldesc;?> <a class="readon" href="<?php echo sefRelToAbs("index.php?option=com_ezautos&amp;task=detail&amp;id=$row->id&amp;Itemid=$myItemid");?>"><?php echo _MOD_EZAUTOS_MFREADMORE;?></a><br />
<td valign="top" width="<?php echo $colwidth;?>" align="left">
<td valign="top" width="40%">
			<table border="0" width="100%" cellspacing="3" cellpadding="3">
				<tr>
					<td><img src="<?php echo $mosConfig_live_site;?>/components/com_ezautos/images/bullet.gif" border="0" width="12" height="12" alt="" />&nbsp;<strong><?php echo _EZAUTOS_VLDET_ADDNUM; ?>&nbsp;:</strong>&nbsp;&nbsp;<?php echo $row->id;?></td>
				</tr><br />
  <td width="10"><img src="<?php echo $mosConfig_live_site;?>/components/com_ezautos/images/pixel.gif" width="10" alt="" /></td>
    <?php } elseif ($slimbox3 == 2) { ?>
    <td valign="top" width="<?php echo $colwidth;?>" align="left"> <table width="148" border="0" align="right" cellpadding="0" cellspacing="0">
        <tr>
          <td height="8" valign="top">&nbsp;</td>
        </tr>
        <tr> 
          <td height="8" valign="top"><img src="/components/com_ezautos/images/blueTop.gif" width="192" height="9"></td>
        </tr>
        <tr> 
          <td height="160" valign="top" background="/components/com_ezautos/images/blueBGD.gif"> 
            <table width="100%" border="0" cellspacing="4" cellpadding="0">
              <tr> 
                <td><a href="<?php echo sefRelToAbs("index.php?option=com_ezautos&amp;task=detail&amp;id=$row->id&amp;Itemid=$myItemid");?>"><font color="#e26920" size="2"><strong><?php echo $row->year.' '.$row->makename.' '.$row->modelname.' '.$row->derivative;?></strong></font></a></td>
              </tr>
              <tr> 
                <td height="65" bgcolor="eecdb9"><div align="center"><a href='<?php echo sefRelToAbs("index.php?option=com_ezautos&amp;task=detail&amp;id=$row->id&amp;Itemid=$myItemid");?>'> 
                    <?php if ($row->image1) { ?>
                    <img src="<?php echo $mosConfig_live_site;?>/components/com_ezautos/<?php echo $ea_imagedirectory;?>/th/<?php echo $row->image1;?>" border="0" width="<?php echo $ea_thumbwidth;?>" align="<?php echo $align;?>" style="margin-top: <?php echo $vertspace;?>px; margin-bottom: <?php echo $vertspace;?>px; padding-left: <?php echo $horizspace;?>px; margin-right: <?php echo $horizspace;?>px" alt="<?php echo $row->year;?> <?php echo $row->makename;?> <?php echo $row->modelname;?>" /> 
                    <?php }else{ ?>
                    <img src="<?php echo $mosConfig_live_site;?>/components/com_ezautos/<?php echo $ea_imagedirectory;?>/th/nothumb.gif" border="0" width="<?php echo $ea_thumbwidth;?>" align="<?php echo $align;?>" style="margin-top: <?php echo $vertspace;?>px; margin-bottom: <?php echo $vertspace;?>px; padding-left: <?php echo $horizspace;?>px; margin-right: <?php echo $horizspace;?>px" alt="<?php echo $row->year.' '.$row->makename.' '.$row->modelname.' '.$row->derivative;?>" /> 
                    <?php } ?>
                </a></div></td>
              </tr>
              <tr> 
                <td><strong>Price:</strong> 
                  <?php
if ( $row->showprice && $row->price != 0 ) {
	if ( $ea_currencypos==0 ) {
		echo $ea_currencysign.''.$formatted_price.' '.$row->price_type;
	} else {
		echo $formatted_price.' '.$ea_currencysign.' '.$row->price_type;
	}
} else {
	echo $row->price_type;
		if (!$row->price_type) { echo "Price on Request"; }
}

if ( $row->freq ) {
	if ($row->freq == 1) { echo _EZAUTOS_RENTAL_DAILY; }
	if ($row->freq == 2) { echo _EZAUTOS_RENTAL_WEEKLY; }
	if ($row->freq == 3) { echo _EZAUTOS_RENTAL_FNIGHT; }
	if ($row->freq == 4) { echo _EZAUTOS_RENTAL_MONTH; }
}
?>
                  <br>
                  <strong>Engine Size &nbsp;:</strong>&nbsp;&nbsp;<?php echo $row->engine;?><br>
                  <strong>Mileage&nbsp;:</strong><?php echo $row->odometer.' '.$row->mileage_unit;?> 
                  <br> 
                  <strong>Transmission &nbsp;:</strong>&nbsp;&nbsp;<?php echo $row->trans;?><br>
                  <strong>Colour &nbsp;:</strong>&nbsp;&nbsp;<?php echo $row->colour;?> 
                </td>
              </tr>
            </table>          </td>
        </tr>
        <tr> 
          <td height="7" valign="top"><img src="/components/com_ezautos/images/blueBottom.gif" width="192" height="7"></td>
        </tr>
      </table></td>
  <td width="10"><img src="<?php echo $mosConfig_live_site;?>/components/com_ezautos/images/pixel.gif" width="10" alt="" /></td>
  <?php } else { ?>
  <td valign="top" width="<?php echo $colwidth;?>" align="left"> <a href="<?php echo sefRelToAbs("index.php?option=com_ezautos&amp;task=detail&amp;id=$row->id&amp;Itemid=$myItemid");?>"><strong><?php echo $row->year.' '.$row->makename.' '.$row->modelname.' '.$row->derivative;?></strong></a><br /> 
    <?php if ($row->image1) { ?>
    <img src="<?php echo $mosConfig_live_site;?>/components/com_ezautos/<?php echo $ea_imagedirectory;?><?php if ( $ea_thumbcreation !== 'none' ) { ?>/th<?php } ?>/<?php echo $row->image1;?>" border="0" align="<?php echo $align;?>" style="margin-top: <?php echo $vertspace;?>px; margin-bottom: <?php echo $vertspace;?>px; padding-left: <?php echo $horizspace;?>px; margin-right: <?php echo $horizspace;?>px" width="<?php echo $ea_thumbwidth;?>" title="<?php echo $row->year.' '.$row->makename.' '.$row->modelname.' '.$row->derivative;?>" alt="<?php echo $row->year.' '.$row->makename.' '.$row->modelname.' '.$row->derivative;?>" /> 
    <?php }else{ ?>
    <img src="<?php echo $mosConfig_live_site;?>/components/com_ezautos/<?php echo $ea_imagedirectory;?>/th/nothumb.gif" align="<?php echo $align;?>" border="0" style="margin-top: <?php echo $vertspace;?>px; margin-bottom: <?php echo $vertspace;?>px; padding-left: <?php echo $horizspace;?>px; margin-right: <?php echo $horizspace;?>px" width="<?php echo $ea_thumbwidth;?>" title="<?php echo $row->year.' '.$row->makename.' '.$row->modelname.' '.$row->derivative;?>" alt="<?php echo $row->year.' '.$row->makename.' '.$row->modelname.' '.$row->derivative;?>" />
    <?php } ?>
    <?php if ($row->image1) { ?></a>
    <?php } ?>
    <?php echo $row->smalldesc;?> <a class="readon" href="<?php echo sefRelToAbs("index.php?option=com_ezautos&amp;task=detail&amp;id=$row->id&amp;Itemid=$myItemid");?>"><?php echo _MOD_EZAUTOS_MFREADMORE;?></a><br /> 
  </td>
  <td width="10"><img src="<?php echo $mosConfig_live_site;?>/components/com_ezautos/images/pixel.gif" width="10" alt="" /></td>
  <?php
}

	$rowcounter++;

	}

    if ($rowcounter%$colcount<>0) {

      for ($i = 1; $i <= ($colcount-($rowcounter%$colcount)); $i++) {

        echo "<td width='$colwidth' valign='top'> </td>";

      }

    }

    echo "</tr></table>";

}else{

}

?>
  <p></div></p><p></div><p></div></div>

