<?php
define ("URL_BASE", 'http://query.yahooapis.com/v1/public/yql');
define ("URL_QUERY", '?q=select%20*%20from%20weather.forecast%20where%20location%3D%2266044%22&format=json');
define ("IMG_BASE", 'http://l.yimg.com/a/i/us/we/52/');

// build URL
$yw_url = URL_BASE . URL_QUERY;

// get JSON feed
$yw_json = file_get_contents ($yw_url);

// convert to PHP obj
$yw_data = json_decode ($yw_json);

// copy data fields
$yw_code = $yw_data->{'query'}->{'results'}->{'channel'}->{'item'}->{'condition'}->{'code'};
$yw_desc = $yw_data->{'query'}->{'results'}->{'channel'}->{'item'}->{'condition'}->{'text'};
$yw_temp = $yw_data->{'query'}->{'results'}->{'channel'}->{'item'}->{'condition'}->{'temp'};
$yw_pubdate = $yw_data->{'query'}->{'results'}->{'channel'}->{'item'}->{'pubDate'};

?>

<div id="yw-output">
 <img src="<?php echo IMG_BASE . $yw_code . '.gif'; ?>" alt="" />
 <b>Current Weather</b><br />
 <?php echo $yw_desc; ?>, <?php echo $yw_temp; ?>&deg;F<br />
 <span><?php echo $yw_pubdate; ?></span>
</div>
