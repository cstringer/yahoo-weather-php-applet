<?php
/***
 * yahoo-weather-applet.php - Simple weather applet using Yahoo! Weather API
 * $ rev 1.2.2, 2013-09-14 10:46, cstringer42@gmail.com $
 */

define ("ZIP_CODE", '66044');
define ("IMG_BASE", 'http://l.yimg.com/a/i/us/we/52/');
define ("YWA_BASE", 'http://query.yahooapis.com/v1/public/yql');
define ("YWA_QUERY", '?q=select%20*%20from%20weather.forecast%20where%20location%3D%22[ZIP]%22&format=json');

// build URL to REST endpoint
$yw_url = YWA_BASE . str_replace ('[ZIP]', ZIP_CODE, YWA_QUERY);

// get JSON feed
$yw_json = file_get_contents ($yw_url);
if ($yw_json === FALSE)
  {
  // error fetching JSON
  exit();
  }

// convert to PHP obj
$yw_data = json_decode ($yw_json);

// copy data fields
$yw_code = $yw_data->{'query'}->{'results'}->{'channel'}->{'item'}->{'condition'}->{'code'};
$yw_desc = $yw_data->{'query'}->{'results'}->{'channel'}->{'item'}->{'condition'}->{'text'};
$yw_temp = $yw_data->{'query'}->{'results'}->{'channel'}->{'item'}->{'condition'}->{'temp'};
$yw_date = $yw_data->{'query'}->{'results'}->{'channel'}->{'item'}->{'pubDate'};

// create src URL to condition graphic
$yw_img = IMG_BASE . $yw_code . '.gif';

?>

<div id="yw-applet">
 <img class="ywa-img" src="<?php echo $yw_img; ?>" alt="" />
 <span class="ywa-title">Current Weather</span><br />
 <span class="ywa-cond"><?php echo $yw_desc; ?>, <?php echo $yw_temp; ?>&deg;F</span><br />
 <span class="ywa-date"><?php echo $yw_date; ?></span>
</div>
