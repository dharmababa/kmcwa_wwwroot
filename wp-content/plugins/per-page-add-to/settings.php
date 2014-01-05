<?php
function perpageath_config(){
  $currenturl = 'http';
   if (isset($_SERVER['HTTPS']) && $_SERVER["HTTPS"] == "on") {$currenturl .= "s";}
   $currenturl .= "://";
   if ($_SERVER["SERVER_PORT"] != "80") {
	$currenturl .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
   } else {
	$currenturl .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
  }
  $htmlfile = dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'evonapluginconfig'.DIRECTORY_SEPARATOR.'everyheadpage.html';
  ?>
  <div class="wrap">
  <h2>Insert HTML on every page</h2>
  <h3>Everything you put in here will be inserted into the &lt;head&gt; tag on every page. Ideal for favicons!</h3>
  <?php
  if(!file_exists($htmlfile)){
	  if($htmlcreatehandle = fopen($htmlfile, 'x')){
		  fwrite($htmlcreatehandle, "");
		  fclose($htmlcreatehandle);
	  }else{
		  echo "Error creating ".$htmlfile." ! Is the underlying folder writable?";
	  }
  }
  if(isset($_POST['html'])){
	  if($htmlwritehandle = fopen($htmlfile, 'w')){
		  fwrite($htmlwritehandle, stripslashes_deep($_POST['html']));
		  fclose($htmlwritehandle);
		  echo "<p>Succesfully edited ".$htmlfile."!</p>";
	  }else{echo "Error writing HTML to ".$htmlfile.". Is this file writable?";}
  }
  if($htmlhandle = fopen($htmlfile, 'r')){
	  if(filesize($htmlfile) > 0){
		$html = fread($htmlhandle, filesize($htmlfile));
	  }else{
		  $html = "";
	  }
	  fclose($htmlhandle);
	  ?>
	  <form method="post" action="<?php echo $currenturl; ?>">
	  <textarea style="white-space:pre; width:80%; min-width:600px; height:300px;" name="html"><?php echo $html; ?></textarea>
	  <?php
	  submit_button();
  }else{echo "Failed reading HTML file".$htmlfile.". Is the file readable?";}
  echo "</form></div>";
}
?>