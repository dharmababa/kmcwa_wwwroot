<?php echo "<?xml version=\"1.0\" encoding=\"utf-8\"?".">"; ?><?
require_once ('/home/kadampa/public_html/nktevents/0.9.3.1/bookingForm.php');
new EventOptions (20, 1792, 'xahygy', '/home/seattle/public_html/celebration/bookingForm09NWDC.xml');
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>2009 NWDC Registration</title>

<meta name="title" content="default meta title" />
<meta name="description" content="default meta description" />


<style type="text/css">
<!--
.style1 {font-size: 1px}
-->
</style>
<link href="nwdc_09.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function prepareCalculateFee () {
 var elDate3 = document.getElementById ('elDate3');
 var elDatePrayers3 = document.getElementById ('elDatePrayers3');
 if (elDatePrayers3.checked) {
  datesTicked = true;
 }
}


</script>

<? new JavaScriptFile (); ?>

</head>

<body>
<table width="894" border="0" align="center" bgcolor="#FCFCFC"
>
  <tr bgcolor="#FCFCFC">
    <td colspan="4" bgcolor="#FCFCFC"><img src="images_09/header.jpg" width="900" height="314" /></td>
  </tr>
  <tr bgcolor="#816A19">
    <td height="11" colspan="4"id="side_links"><p align="right" id="side_links"><a href="http://www.meditateinskagitvalley.org" target="_blank" id="side_links">Bellingham, WA</a> • <a href="http://www.meditateinolympia.org" target="_blank" id="side_links">Olympia, WA</a> • <a href="http://www.meditationinoregon.org" target="_blank" id="side_links">Portland, or</a> • <a href="http://www.meditateinseattle.org/" target="_blank" id="side_links"> Seattle, WA</a></p>    </td>
  </tr>
  <tr bordercolor="#C7D5EC" bgcolor="#C7D5EC">
    <td width="179" valign="top" bordercolor="#C7D5EC1" bgcolor="#C7D5EC"><table width="175" border="0">
      <tr>
        <td width="169" id="nav_bar2">&nbsp;</td>
      </tr>
      <tr>
        <td id="nav_bar"><a href="welcome.html">Welcome</a></td>
      </tr>
      <tr>
        <td id="nav_bar"><a href="program.html">Program</a></td>
      </tr>
      <tr>
        <td id="nav_bar"><a href="teachers.html">Teachers</a></td>
      </tr>
      <tr>
        <td id="nav_bar"><a href="venue.html">Venue</a></td>
      </tr>
      <tr>
        <td id="nav_bar"><a href="registration.html">Registration</a></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table></td>


<td width="3" valign="top" bordercolor="#FCFCFC" bgcolor="#FCFCFC">&nbsp;</td>
    <td width="694" valign="top" bordercolor="#FCFCFC" bgcolor="#FCFCFC"><!-- InstanceBeginEditable name="EditRegion3" -->      <table border="0">
        <tr>
          <td width="750"><h1>2009 NWDC Registration Form</h1>
<? new FormHeader (); ?>
      <fieldset id="kem_p_details">
<table border="0" cellspacing="0" cellpadding="0" style="text-align:left">
<?
new FormLayout (3);
echo ('<tr><td valign="bottom">First Name:</td><td>'); new FormElement ('FirstName'); echo ('</td></tr>');
echo ('<tr><td>&nbsp;</td><td><i>If ordained, please list Kelsang as your first name.</i></td></tr>');
echo ('<tr><td valign="bottom">Last Name:</td><td>'); new FormElement ('LastName'); echo ('</td></tr>');
echo ('<tr><td valign="bottom">Gender:</td><td>'); new FormElement ('Gender'); echo ('</td></tr>');
echo ('<tr><td valign="bottom">NKT Center which you attend (if applicable):&nbsp;&nbsp;</td><td>'); new FormElement ('Centre'); echo ('</td></tr>');
echo ('<tr><td valign="bottom">Street:</td><td>'); new FormElement ('Street'); echo ('</td></tr>');
echo ('<tr><td valign="bottom">City:</td><td>'); new FormElement ('City'); echo ('</td></tr>');
echo ('<tr><td valign="bottom">State:</td><td>'); new FormElement ('State'); echo ('</td></tr>');
echo ('<tr><td valign="bottom">Zip/Post Code:</td><td>'); new FormElement ('PostCode'); echo ('</td></tr>');
echo ('<tr><td valign="bottom">Country, if other than USA:</td><td>'); new FormElement ('Country'); echo ('</td></tr>');
echo ('<tr><td valign="bottom">Phone:</td><td>'); new FormElement ('Phone'); echo ('</td></tr>');
echo ('<tr><td valign="bottom">Email:</td><td>'); new FormElement ('Email'); echo ('</td></tr>');
?>
</table>
      </fieldset>
      <fieldset id="kem_dates">
      <p align="left" style="text-align:left"> 
        <?
new FormLayout (2);
new FormElement ('DateAll');
echo ("<br />Individual Days:<br />");
new FormElement ('Date0');
echo ("&nbsp;&nbsp;&nbsp;&nbsp;");
new FormElement ('Student0');
new FormElement ('Date1');
new FormElement ('Date2');
new FormElement ('Date3');
echo ("&nbsp;&nbsp;&nbsp;&nbsp;");
new FormElement ('Prayers3');


?>
      </p>

<p style="text-align:left">
<?
new FormElement ('Dinner1');
?>
</p>


      </fieldset>
      <!-- course details -->
      <fieldset id="kem_course_details">
      <p align="left" style="text-align:left"> 
        <?
 new FormLayout (3);
 new FormElement ('SpecialNeeds');
?>
      </fieldset>
<fieldset id="kem_cost">

<?
new FormLayout (2);
echo ('<label>Total Fee: US$ '); new FormElement ('Fee'); echo ('</label><br />');
new FormElement ('AmountPayNow');
echo ('25% deposit refundable up until September 18, after which, it is non-refundable.<br />');
echo ('<label>Balance: US$ '); new FormElement ('Balance'); echo ('</label><br />');
?>


</fieldset>

<p style="text-align:center">
<? echo('Once you click Register Now, please be patient. This may take a few moments.<br />'); new FormElement ('Submit'); ?>
</p>

</form>
</td></tr>

        <tr>
          <td><div align="center"><em>Proceeds from the NWDC will be donated to the <a href="http://kadampa.org/en/temples/international-temples-project/" target="_blank">NKT-IKBU International Temples Projec</a>t, <br />
      a non-profit Buddhist organization building for world peace.</em></div></td>
        </tr>
    <td width="12" valign="top" bordercolor="#FCFCFC" bgcolor="#FCFCFC">&nbsp;</td>
  </tr>
  <tr bordercolor="#FCFCFC" bgcolor="#FCFCFC">
    <td colspan="4" bgcolor="#C7D5EC"><div align="center">
      <p>&nbsp;</p>
    </div>      <span class="style1"></span><span class="style1"></span></td>
  </tr>
  <tr bordercolor="#C7D5EC1" bgcolor="#2D66B5">
    <td height="1" colspan="4" nowrap="nowrap">&nbsp;</td>
  </tr>
  <tr bordercolor="#C7D5EC" bgcolor="#C7D5EC">
    <td colspan="4" bgcolor="#C4D5EE"><div align="center" class="subHeader">
      <p>2009 NORTHWEST DHARMA CELEBRATION </p>
      <p>A member of the New Kadampa Tradition - International Kadampa Buddhist Union<br />
        © 2009 Kadampa Meditation Center Washington, All rights reserved</p>
    </div></td>
  </tr></table>

</body>
</html>
