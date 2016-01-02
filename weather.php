<?php


/*
Author : Sabarish KRE
Purpose : To find weather details of some city. (Assignment for 1st round of webyog's selection process)
Softwares used : notepad++, Microsoft word (for weather info table design), Web browser, Web server(for testing)

Resources:
Icons - http://stupay.com/project_icon.php
Weather API - http://worldweatheronline.com
Other images - google images
Dropdown list for all countries : http://www.geekpedia.com/code54_Drop-down-list-of-countries.html
*/

function str($tag,$text)
{
	//this is one of the most important functions here as it parses the XML and extracts data between the tags using RegEX
	$pattern = "/<$tag>(.*?)<\/$tag>/";
    preg_match($pattern, $text, $matche);
    return $matche[1]; //this contains the text between the specified tags
}



if(isset($_GET['city']))	//if there is any value entered in city. we dont check country as its optional field
{
	$city=trim($_GET['city']);  //remove unwanted spaces at end and start
	$country=trim($_GET['country']);
	$len=strlen($country);
	if($len>1)
		$country=",".$country;  //a country is selected, so we pass that also to the API
	else 
		$country=""; //if no country selected, leave it blank
		
	//$url='http://free.worldweatheronline.com/feed/weather.ashx?format=xml&num_of_days=1&key=b4fb7e81f6063810113010&q='.urlencode($city).''.urlencode($country); 
	$url='http://api.worldweatheronline.com/free/v2/weather.ashx?format=xml&num_of_days=1&key=4362a161f785b70a8aec959cd6bdb&q='.urlencode($city).''.urlencode($country); 
	//Using the free weather API provided by worldweatheronline.com
	
	
	//Get the contents of the resultant URL
	$result=file_get_contents($url); 
	
	/*
		Here i have defined the function str, whose purpose is to find the text between two tags from some text.
		it accepts two parameters, tagname and the text from which we have to extract data from between	the tags		
	*/
	
	$err=str("msg",$result);  
	if(strlen($err)>10) //some error message is encountered denoting that weather for that location is not available.
	notfound($city,$country);	//function that handles when a weather not found condition happens
	
	$result=str_replace("<![CDATA[","",$result); //unwanted xml stuff as i am not using any built in XML parser. I used RegEx in oreg_natch to get data from XML
	$result=str_replace("]]></","</",$result);
	
	$city=str("query",$result);
	preg_match("/\<current_condition\>(.*)\<\/current_condition\>/",$result,$cc);  //to separate the current weather information from other info, we take only this into consideration
		
	
	/*
	the following code extracts the data from the XML tags using the str function which i defined later in this script.
	The weather information according to the API can be seen here : http://www.worldweatheronline.com/free-weather-feed.aspx?menu=xmldata
	*/
	$observation_time=str("observation_time",$cc[1]);
	$temp_C=str("temp_C",$cc[1]);
	$temp_F=str("temp_F",$cc[1]);
	$weatherIconUrl=str("weatherIconUrl",$cc[1]);	
	$weatherDesc=str("weatherDesc",$cc[1]);
	$windspeedMiles=str("windspeedMiles",$cc[1]);
	$windspeedKmph=str("windspeedKmph",$cc[1]);
	$winddirDegree=str("winddirDegree",$cc[1]);
	$humidity=str("humidity",$cc[1]);
	$precipMM=str("precipMM",$cc[1]);
	$humidity=str("humidity",$cc[1]);
	$pressure=str("pressure",$cc[1]);
	$cloudcover=str("cloudcover",$cc[1]);
	$winddir16Point=str("winddir16Point",$cc[1]);
	$visibility=str("visibility",$cc[1]);
	
	
	//************Once the data is parsed and gathered, the output of HTML table starts!! I used microsoft office word to design the table quickly****************//
?>

<html xmlns:v="urn:schemas-microsoft-com:vml"
xmlns:o="urn:schemas-microsoft-com:office:office"
xmlns:w="urn:schemas-microsoft-com:office:word"
xmlns="http://www.w3.org/TR/REC-html40">

<head>
<meta http-equiv=Content-Type content="text/html; charset=windows-1252">




<title>Current weather conditions in <?php echo $city;?></title>

<style>

</style>

</head>

<body bgcolor="#E8EEF7" lang=EN-US style='tab-interval:.5in'>

<div class=Section1>

<div>

<p style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto'><span
class=GramE><span style='font-size:14.0pt'></span></span><span
style='font-size:14.0pt'><o:p></o:p></span></p>

<p style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto'><span
style='font-size:14.0pt'><o:p>&nbsp;</o:p></span></p>

<div align=center>

<table class=MsoNormalTable border=1 cellspacing=3 cellpadding=0 width=937
 style='width:702.75pt;mso-cellspacing:2.0pt;border-top:inset;border-left:inset;
 border-bottom:outset;border-right:outset;border-width:1.0pt;mso-border-top-alt:
 inset;mso-border-left-alt:inset;mso-border-bottom-alt:outset;mso-border-right-alt:
 outset;mso-border-color-alt:windowtext;mso-border-width-alt:.75pt;mso-yfti-tbllook:
 480;mso-padding-alt:2.15pt 5.75pt 2.15pt 5.75pt;mso-border-insideh:.75pt solid windowtext;
 mso-border-insidev:.75pt solid windowtext'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;height:73.05pt'>
  <td width=932 colspan=3 style='width:698.75pt;border:solid windowtext 1.0pt;
  border-top:outset 1.0pt;mso-border-alt:solid windowtext .75pt;mso-border-top-alt:
  outset windowtext .75pt;background:#CDDCEC;mso-shading:white;mso-pattern:
  gray-20 black;padding:2.15pt 5.75pt 2.15pt 5.75pt;height:73.05pt'>
  <p align=center style='mso-margin-top-alt:auto;mso-margin-bottom-alt:
  auto;text-align:center'><b><i style='mso-bidi-font-style:normal'><span
  style='font-size:16.0pt'><o:p>&nbsp;</o:p></span></i></b></p>
  <p align=center style='mso-margin-top-alt:auto;mso-margin-bottom-alt:
  auto;text-align:center'><b><i style='mso-bidi-font-style:normal'><span
  style='font-size:16.0pt'>Current weather condition in <?php echo ''.$city.' - '.$weatherDesc;?><o:p></o:p><br /></span></i></b></p>
  <p align=center style='mso-margin-top-alt:auto;mso-margin-bottom-alt:
  auto;text-align:center'><span style='font-size:14.0pt;mso-bidi-font-weight:
  bold'><br /><img width=78 height=78
  src="<?php echo $weatherIconUrl;?>" v:shapes="_x0000_i1035"><![endif]><o:p></o:p></span></p>
  <p align=center style='mso-margin-top-alt:auto;mso-margin-bottom-alt:
  auto;text-align:center'><span style='font-size:14.0pt'><o:p>&nbsp;</o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:1;height:55.5pt'>
  <td width=242 style='width:181.3pt;border:solid windowtext 1.0pt;mso-border-alt:
  solid windowtext .75pt;background:#E8EEF7;mso-shading:white;mso-pattern:gray-5 black;
  padding:2.15pt 5.75pt 2.15pt 5.75pt;height:55.5pt'>
  <p align=center style='mso-margin-top-alt:auto;mso-margin-bottom-alt:
  auto;text-align:center'><span style='font-size:14.0pt'>
  <img width=65 height=52
  src="images/time.png" v:shapes="_x0000_i1025"><![endif]><o:p></o:p></span></p>
  </td>
  <td width=272 style='width:204.0pt;border:solid windowtext 1.0pt;mso-border-alt:
  solid windowtext .75pt;background:#E8EEF7;mso-shading:white;mso-pattern:gray-5 black;
  padding:2.15pt 5.75pt 2.15pt 5.75pt;height:55.5pt'>
  <p style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto'><span
  style='font-size:14.0pt'>Observation time (UTC)<o:p></o:p></span></p>
  </td>
  <td width=413 style='width:309.45pt;border:solid windowtext 1.0pt;mso-border-alt:
  solid windowtext .75pt;background:#E8EEF7;mso-shading:white;mso-pattern:gray-5 black;
  padding:2.15pt 5.75pt 2.15pt 5.75pt;height:55.5pt'>
  <p style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto'><span
  style='font-size:14.0pt'><span class=SpellE><?php echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$observation_time;?></span><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:2;height:55.05pt'>
  <td width=242 style='width:181.3pt;border:solid windowtext 1.0pt;mso-border-alt:
  solid windowtext .75pt;background:#E8EEF7;mso-shading:white;mso-pattern:gray-5 black;
  padding:2.15pt 5.75pt 2.15pt 5.75pt;height:55.05pt'>
  <p align=center style='mso-margin-top-alt:auto;mso-margin-bottom-alt:
  auto;text-align:center'><span style='font-size:14.0pt'>
  
  <img width=48 height=48
  src="<?php echo $weatherIconUrl;?>" v:shapes="_x0000_i1026"><![endif]><o:p></o:p></span></p>
  </td>
  <td width=272 style='width:204.0pt;border:solid windowtext 1.0pt;mso-border-alt:
  solid windowtext .75pt;background:#CDDCEC;mso-shading:white;mso-pattern:gray-20 black;
  padding:2.15pt 5.75pt 2.15pt 5.75pt;height:55.05pt'>
  <p style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto'><span
  style='font-size:14.0pt'>Weather description<o:p></o:p></span></p>
  </td>
  <td width=413 style='width:309.45pt;border:solid windowtext 1.0pt;mso-border-alt:
  solid windowtext .75pt;background:#CDDCEC;mso-shading:white;mso-pattern:gray-20 black;
  padding:2.15pt 5.75pt 2.15pt 5.75pt;height:55.05pt'>
  <p style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto'><span
  style='font-size:14.0pt'><span class=SpellE><?php echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$weatherDesc;?></span><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:3;height:36.6pt'>
  <td width=242 rowspan=2 style='width:181.3pt;border:solid windowtext 1.0pt;
  mso-border-alt:solid windowtext .75pt;background:#E8EEF7;mso-shading:white;
  mso-pattern:gray-5 black;padding:2.15pt 5.75pt 2.15pt 5.75pt;height:36.6pt'>
  <p align=center style='mso-margin-top-alt:auto;mso-margin-bottom-alt:
  auto;text-align:center'><span style='font-size:14.0pt'>
  
  <img width=49 height=49
  src="images/thermometer.png" v:shapes="_x0000_i1027"><![endif]><o:p></o:p></span></p>
  </td>
  <td width=272 style='width:204.0pt;border:solid windowtext 1.0pt;mso-border-alt:
  solid windowtext .75pt;background:#E8EEF7;mso-shading:white;mso-pattern:gray-5 black;
  padding:2.15pt 5.75pt 2.15pt 5.75pt;height:36.6pt'>
  <p style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto'><span
  style='font-size:14.0pt'>Temperature (°C)<o:p></o:p></span></p>
  </td>
  <td width=413 style='width:309.45pt;border:solid windowtext 1.0pt;mso-border-alt:
  solid windowtext .75pt;background:#E8EEF7;mso-shading:white;mso-pattern:gray-5 black;
  padding:2.15pt 5.75pt 2.15pt 5.75pt;height:36.6pt'>
  <p style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto'><span
  style='font-size:14.0pt'><span class=SpellE><?php echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$temp_C;?></span><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:4;height:36.15pt'>
  <td width=272 style='width:204.0pt;border:solid windowtext 1.0pt;mso-border-alt:
  solid windowtext .75pt;background:#CDDCEC;mso-shading:white;mso-pattern:gray-20 black;
  padding:2.15pt 5.75pt 2.15pt 5.75pt;height:36.15pt'>
  <p style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto'><span
  style='font-size:14.0pt'>Temperature (°F)<o:p></o:p></span></p>
  </td>
  <td width=413 style='width:309.45pt;border:solid windowtext 1.0pt;mso-border-alt:
  solid windowtext .75pt;background:#CDDCEC;mso-shading:white;mso-pattern:gray-20 black;
  padding:2.15pt 5.75pt 2.15pt 5.75pt;height:36.15pt'>
  <p style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto'><span
  style='font-size:14.0pt'><span class=SpellE><?php echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$temp_F;?></span><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:5;height:37.5pt'>
  <td width=242 rowspan=2 style='width:181.3pt;border:solid windowtext 1.0pt;
  mso-border-alt:solid windowtext .75pt;background:#E8EEF7;mso-shading:white;
  mso-pattern:gray-5 black;padding:2.15pt 5.75pt 2.15pt 5.75pt;height:37.5pt'>
  <p align=center style='mso-margin-top-alt:auto;mso-margin-bottom-alt:
  auto;text-align:center'><span style='font-size:14.0pt'>
  
  <img width=64 height=64
  src="images/wind_speed.png" v:shapes="_x0000_i1028"><![endif]><o:p></o:p></span></p>
  </td>
  <td width=272 style='width:204.0pt;border:solid windowtext 1.0pt;mso-border-alt:
  solid windowtext .75pt;background:#E8EEF7;mso-shading:white;mso-pattern:gray-5 black;
  padding:2.15pt 5.75pt 2.15pt 5.75pt;height:37.5pt'>
  <p style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto'><span
  style='font-size:14.0pt'>Wind speed (mph)<o:p></o:p></span></p>
  </td>
  <td width=413 style='width:309.45pt;border:solid windowtext 1.0pt;mso-border-alt:
  solid windowtext .75pt;background:#E8EEF7;mso-shading:white;mso-pattern:gray-5 black;
  padding:2.15pt 5.75pt 2.15pt 5.75pt;height:37.5pt'>
  <p style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto'><span
  style='font-size:14.0pt'><span class=SpellE><?php echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$windspeedMiles;?></span><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:6;height:36.6pt'>
  <td width=272 style='width:204.0pt;border:solid windowtext 1.0pt;mso-border-alt:
  solid windowtext .75pt;background:#CDDCEC;mso-shading:white;mso-pattern:gray-20 black;
  padding:2.15pt 5.75pt 2.15pt 5.75pt;height:36.6pt'>
  <p style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto'><span
  style='font-size:14.0pt'>Wind speed (<span class=SpellE>kph</span>)<o:p></o:p></span></p>
  </td>
  <td width=413 style='width:309.45pt;border:solid windowtext 1.0pt;mso-border-alt:
  solid windowtext .75pt;background:#CDDCEC;mso-shading:white;mso-pattern:gray-20 black;
  padding:2.15pt 5.75pt 2.15pt 5.75pt;height:36.6pt'>
  <p style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto'><span
  style='font-size:14.0pt'><span class=SpellE><?php echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$windspeedKmph;?></span><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:7;height:46.5pt'>
  <td width=242 rowspan=2 style='width:181.3pt;border:solid windowtext 1.0pt;
  mso-border-alt:solid windowtext .75pt;background:#E8EEF7;mso-shading:white;
  mso-pattern:gray-5 black;padding:2.15pt 5.75pt 2.15pt 5.75pt;height:46.5pt'>
  <p align=center style='mso-margin-top-alt:auto;mso-margin-bottom-alt:
  auto;text-align:center'><span style='font-size:14.0pt'>
  
  <img width=64 height=64
  src="images/wind_dir.png" v:shapes="_x0000_i1029"><![endif]><o:p></o:p></span></p>
  </td>
  <td width=272 style='width:204.0pt;border:solid windowtext 1.0pt;mso-border-alt:
  solid windowtext .75pt;background:#E8EEF7;mso-shading:white;mso-pattern:gray-5 black;
  padding:2.15pt 5.75pt 2.15pt 5.75pt;height:46.5pt'>
  <p style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto'><span
  style='font-size:14.0pt'>Wind direction (degree)<o:p></o:p></span></p>
  </td>
  <td width=413 style='width:309.45pt;border:solid windowtext 1.0pt;mso-border-alt:
  solid windowtext .75pt;background:#E8EEF7;mso-shading:white;mso-pattern:gray-5 black;
  padding:2.15pt 5.75pt 2.15pt 5.75pt;height:46.5pt'>
  <p style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto'><span
  style='font-size:14.0pt'><span class=SpellE><?php echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$winddirDegree;?></span><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:8;height:45.6pt'>
  <td width=272 style='width:204.0pt;border:solid windowtext 1.0pt;mso-border-alt:
  solid windowtext .75pt;background:#CDDCEC;mso-shading:white;mso-pattern:gray-20 black;
  padding:2.15pt 5.75pt 2.15pt 5.75pt;height:45.6pt'>
  <p style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto'><span
  style='font-size:14.0pt'>16-Point wind direction compass<o:p></o:p></span></p>
  </td>
  <td width=413 style='width:309.45pt;border:solid windowtext 1.0pt;mso-border-alt:
  solid windowtext .75pt;background:#CDDCEC;mso-shading:white;mso-pattern:gray-20 black;
  padding:2.15pt 5.75pt 2.15pt 5.75pt;height:45.6pt'>
  <p style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto'><span
  style='font-size:14.0pt'><span class=SpellE><?php echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$winddir16Point;?></span></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:9;height:54.15pt'>
  <td width=242 style='width:181.3pt;border:solid windowtext 1.0pt;mso-border-alt:
  solid windowtext .75pt;background:#E8EEF7;mso-shading:white;mso-pattern:gray-5 black;
  padding:2.15pt 5.75pt 2.15pt 5.75pt;height:54.15pt'>
  <p align=center style='mso-margin-top-alt:auto;mso-margin-bottom-alt:
  auto;text-align:center'><span style='font-size:14.0pt'>
  
  <img width=48 height=48
  src="images/precip.png" v:shapes="_x0000_i1030"><![endif]><o:p></o:p></span></p>
  </td>
  <td width=272 style='width:204.0pt;border:solid windowtext 1.0pt;mso-border-alt:
  solid windowtext .75pt;background:#E8EEF7;mso-shading:white;mso-pattern:gray-5 black;
  padding:2.15pt 5.75pt 2.15pt 5.75pt;height:54.15pt'>
  <p style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto'><span
  style='font-size:14.0pt'>Precipitation amount (mm)<o:p></o:p></span></p>
  </td>
  <td width=413 style='width:309.45pt;border:solid windowtext 1.0pt;mso-border-alt:
  solid windowtext .75pt;background:#E8EEF7;mso-shading:white;mso-pattern:gray-5 black;
  padding:2.15pt 5.75pt 2.15pt 5.75pt;height:54.15pt'>
  <p style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto'><span
  style='font-size:14.0pt'><span class=SpellE><?php echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$precipMM;?></span><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:10;height:38.4pt'>
  <td width=242 style='width:181.3pt;border:solid windowtext 1.0pt;mso-border-alt:
  solid windowtext .75pt;background:#E8EEF7;mso-shading:white;mso-pattern:gray-5 black;
  padding:2.15pt 5.75pt 2.15pt 5.75pt;height:38.4pt'>
  <p align=center style='mso-margin-top-alt:auto;mso-margin-bottom-alt:
  auto;text-align:center'><span style='font-size:14.0pt'>
  
  <img width=48 height=48
  src="images/humidity.png" v:shapes="_x0000_i1031"><![endif]><o:p></o:p></span></p>
  </td>
  <td width=272 style='width:204.0pt;border:solid windowtext 1.0pt;mso-border-alt:
  solid windowtext .75pt;background:#CDDCEC;mso-shading:white;mso-pattern:gray-20 black;
  padding:2.15pt 5.75pt 2.15pt 5.75pt;height:38.4pt'>
  <p style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto'><span
  style='font-size:14.0pt'>Humidity (%)<o:p></o:p></span></p>
  </td>
  <td width=413 style='width:309.45pt;border:solid windowtext 1.0pt;mso-border-alt:
  solid windowtext .75pt;background:#CDDCEC;mso-shading:white;mso-pattern:gray-20 black;
  padding:2.15pt 5.75pt 2.15pt 5.75pt;height:38.4pt'>
  <p style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto'><span
  style='font-size:14.0pt'><span class=SpellE><?php echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$humidity;?><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:11;height:46.05pt'>
  <td width=242 style='width:181.3pt;border:solid windowtext 1.0pt;mso-border-alt:
  solid windowtext .75pt;background:#E8EEF7;mso-shading:white;mso-pattern:gray-5 black;
  padding:2.15pt 5.75pt 2.15pt 5.75pt;height:46.05pt'>
  <p align=center style='mso-margin-top-alt:auto;mso-margin-bottom-alt:
  auto;text-align:center'><span style='font-size:14.0pt'>
  
  <img width=48 height=48
  src="images/visibility.jpg" v:shapes="_x0000_i1032"><![endif]><o:p></o:p></span></p>
  </td>
  <td width=272 style='width:204.0pt;border:solid windowtext 1.0pt;mso-border-alt:
  solid windowtext .75pt;background:#E8EEF7;mso-shading:white;mso-pattern:gray-5 black;
  padding:2.15pt 5.75pt 2.15pt 5.75pt;height:46.05pt'>
  <p style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto'><span
  style='font-size:14.0pt'>Visibility (km)<o:p></o:p></span></p>
  </td>
  <td width=413 style='width:309.45pt;border:solid windowtext 1.0pt;mso-border-alt:
  solid windowtext .75pt;background:#E8EEF7;mso-shading:white;mso-pattern:gray-5 black;
  padding:2.15pt 5.75pt 2.15pt 5.75pt;height:46.05pt'>
  <p style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto'><span
  style='font-size:14.0pt'><span class=SpellE><?php echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$visibility;?></span><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:12;height:50.1pt'>
  <td width=242 style='width:181.3pt;border:solid windowtext 1.0pt;mso-border-alt:
  solid windowtext .75pt;background:#E8EEF7;mso-shading:white;mso-pattern:gray-5 black;
  padding:2.15pt 5.75pt 2.15pt 5.75pt;height:50.1pt'>
  <p align=center style='mso-margin-top-alt:auto;mso-margin-bottom-alt:
  auto;text-align:center'><span style='font-size:14.0pt'>
  <img width=51 height=51
  src="images/pressure.png" v:shapes="_x0000_i1033"><![endif]><o:p></o:p></span></p>
  </td>
  <td width=272 style='width:204.0pt;border:solid windowtext 1.0pt;mso-border-alt:
  solid windowtext .75pt;background:#CDDCEC;mso-shading:white;mso-pattern:gray-20 black;
  padding:2.15pt 5.75pt 2.15pt 5.75pt;height:50.1pt'>
  <p style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto'><span
  style='font-size:14.0pt'>Atmospheric Pressure (<span class=SpellE>millibar</span>)<o:p></o:p></span></p>
  </td>
  <td width=413 style='width:309.45pt;border:solid windowtext 1.0pt;mso-border-alt:
  solid windowtext .75pt;background:#CDDCEC;mso-shading:white;mso-pattern:gray-20 black;
  padding:2.15pt 5.75pt 2.15pt 5.75pt;height:50.1pt'>
  <p style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto'><span
  style='font-size:14.0pt'><span class=SpellE><?php echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$pressure;?></span><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:13;mso-yfti-lastrow:yes;height:46.05pt'>
  <td width=242 style='width:181.3pt;border:solid windowtext 1.0pt;mso-border-alt:
  solid windowtext .75pt;background:#E8EEF7;mso-shading:white;mso-pattern:gray-5 black;
  padding:2.15pt 5.75pt 2.15pt 5.75pt;height:46.05pt'>
  <p align=center style='mso-margin-top-alt:auto;mso-margin-bottom-alt:
  auto;text-align:center'><span style='font-size:14.0pt'>
  <![if !vml]><img width=50 height=50
  src="images/cloud.jpg" v:shapes="_x0000_i1034"><![endif]><o:p></o:p></span></p>
  </td>
  <td width=272 style='width:204.0pt;border:solid windowtext 1.0pt;mso-border-alt:
  solid windowtext .75pt;background:#E8EEF7;mso-shading:white;mso-pattern:gray-5 black;
  padding:2.15pt 5.75pt 2.15pt 5.75pt;height:46.05pt'>
  <p style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto'><span
  style='font-size:14.0pt'>Cloud cover (%)<o:p></o:p></span></p>
  </td>
  <td width=413 style='width:309.45pt;border:solid windowtext 1.0pt;mso-border-alt:
  solid windowtext .75pt;background:#F2F2F2;mso-shading:white;mso-pattern:gray-5 black;
  padding:2.15pt 5.75pt 2.15pt 5.75pt;height:46.05pt'>
  <p style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto'><span
  style='font-size:14.0pt'><span class=SpellE><?php echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$cloudcover;?></span><o:p></o:p></span></p>
  </td>
 </tr>
</table>

</div>

<p style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto'><span
style='font-size:14.0pt'><o:p>&nbsp;</o:p></span></p>

<p style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto'><span
class=GramE><span style='font-size:14.0pt'><center><h2><a href="./">Click here to check the weather conditions of another location</a></h2></center></span></span><span
style='font-size:14.0pt'><o:p></o:p></span></p>

</div>

<p class=MsoNormal><span style='font-size:14.0pt'><o:p>&nbsp;</o:p></span></p>

</div>
</body>
</html>
<?php
exit(0);
}

//Results have been printed out now!





//the following function is called when the weather for a location was not found!
function notfound($city,$country)
{
?>
<html>
	<head>
		<title>Find the weather conditions of any location in the world!</title>
	</head>
	<body bgcolor="#E8EEF7" style="text-align:center;">
	<center>
	<form action="./weather.php" method=GET>
	
	<table frame="border" bgcolor="#C3D9FF" style="padding: 10px 10px 10px 10px;" cellspacing="20px">
	<tr>
		 <td colspan=2><center><img src="./images/w.png"><img src="./images/w1.png"><img src="./images/w3.png"><img src="./images/w2.png"></center></td>
	</tr>
	
	<tr>
		 <td colspan=2><font size=5.5 color=red >Sorry, the weather details for <?php echo $city."".$country;?> was not found!</font></td>
	</tr>
	<tr>
		<td colspan=2><font size=5>1.Make sure the spellings are correct. 
		</td>		
	</tr>
	
	<tr>
		<td colspan=2><font size=5>2.If you have not selected any country, please select it from the list. 
		</td>		
	</tr>

	<tr>
		<td colspan=2><font size=5>3.If you have selected a country, make sure the city belongs to that country. 
		</td>		
	</tr>

	<tr>
		<td colspan=2><font size=5>4.The weather details for that location might not be available at this moment.
		</td>		
	</tr>

	<tr>
		<td colspan=2><font size=5><a href="./">Click here to try again.</a>
		</td>		
	</tr>

	
	</center>
	</div>
	</body>		
</html>

<?php
exit();
}
?>