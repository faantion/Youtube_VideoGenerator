<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Random Youtube video generator">
    <meta name="ROBOTS" content="INDEX, FOLLOW">
    <link rel="canonical" href="https://www.fantaziu.it/">
    <meta name="keywords" content="Youtube video, random youtube video,  youtube video generator, funny youtube videos">
	<title>Random video generator</title>
  	<script type='text/javascript' src='http://code.jquery.com/jquery-1.7.1.js'></script>  
  	<link href='http://fonts.googleapis.com/css?family=Ranchers' rel='stylesheet' type='text/css'>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="yvg.css">
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
	<link rel="icon" href="favicon.ico" type="image/x-icon">
</head>
<body>

	<div class="container conav">
	  <nav class="navbar navbar-default">
	    <!-- Brand and toggle get grouped for better mobile display -->
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	    </div>

	    <!-- Collect the nav links, forms, and other content for toggling -->
	    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	      <ul class="nav navbar-nav col-md-8">
	        <li>
	        	<a href="https://www.fantaziu.it/" alt="home page" class="home page">
	        		Home
	        	</a>
	        </li>
	        <li>
	        	<a href="#" alt="video page" class="video page" onclick="window.location.reload(true);">
	        		Random Video
	        	</a>
	        </li>
	        <li>
	        	<a href="https://www.fantaziu.it/blog-dell-informatico/" alt="blog page" class="blog page">
	        		Blog
	        	</a>
	        </li>
	      </ul>
	      
	      <ul class="nav navbar-nav navbar-right logo col-md-4">
	        <li>
		        <a href="#">
		        	<img src="logo-yvg.png">
		        </a>
	        </li>
	        
	      </ul>
	    </div><!-- /.navbar-collapse -->
	  </nav>
	</div><!-- /.container-fluid -->
<div class="container videi">
	<div class="col-md-8">
		<iframe class="ember video" width="750" height="420" src="https://www.youtube.com/embed/<?php

		$key = 'AIzaSyBbBW8_9ERIqAJ_dI_QIIlDcDCNC_-y4rA';

		$cs = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, '-', '_'];
		$vids = [];
		$video = '';
		// try to find a video 10 times
		for ($k = 1; $k <= 10; $k++) {
			$query = '';
			// get 4 char random string
			for ($i = 1; $i <= 4; $i++) {
				$query .= $cs[rand(0, sizeof($cs) - 1)];
			}

			//$querystring = 'v%3D' . $q;
			$url = 'https://www.googleapis.com/youtube/v3/search?part=id&maxResults=50&videoEmbeddable=true&type=video&q='
				. $query . '&key=' . $key
			//	. '&topicId=' . '/m/04rlf'  // music videos
			//	. '&videoDuration=long'
			// usw
			;

			$resp = file_get_contents($url);
			$a = json_decode($resp, true);
			if ($a["pageInfo"]["totalResults"] > 50) {
				// continue?
			}
			if ($a["pageInfo"]["totalResults"] == 0) {
				// nothing found
				continue;
			}

			foreach ($a["items"] as $item) {
				if (stripos($item["id"]["videoId"], $query) !== false) {
					// q in vid id
					$vids[] = $item["id"]["videoId"];
				} else {
					// q was somewhere else like description etc -> ignore video
				}
			}
			if (sizeof($vids) > 0) {
				break;
			} else {
				// nothing found
				//echo "Nothing Found... :'( ";
				continue;
			}
		}
		if (sizeof($vids) > 0) {
			$videoId = $vids[rand(0, sizeof($vids) - 1)];
			// echo "<a href=\"http://youtube.com/watch?v=".$videoId."\">".$videoId."</a>";
			echo $videoId;
		} else {
			echo -1;
		}
		?>" frameborder="0" allowfullscreen></iframe>
	</div>
		<div class="sidebar col-md-4">
			<a href="#" class="btn btn-primary" onclick="window.location.reload(true);"><span class="glyphicon glyphicon-refresh"></span> Refresh</a>
			<div class="donate">
				<strong>
					Donation options
				</strong><br>
				<span>
					YotubeVideo Generator is developed by volunteers on their spare time. If you like this piece of software, please make a donation and <a href="#" alt="liking it">help it survive</a>.
				</span>
			</div>
			<div class="add">
				<img src="thumb.jpg" class="img-responsive">
			</div>
		</div>

	</div>
</div>
<div class="container how-it-works">
    <div class="panel callout">
    	<h1 class="heading_supersize">
    		Welcome to YouTubeVideo Generator
    	</h1>
    </div>
    <div class="features">
        <div class="col-md-4">
          <h2>Youtube Video Generator</h2>
          <p>Really fast and strong video generator using YouTube Content to please you with a video you never knew about.</p>
        </div>

        <div class="col-md-4">
          <h2>YouTube Video Randomizer</h2>
          <p>
          	Are you bored with the same old suggestions fo Youtube Videos?<br> Then you come to the right place. A real time Youtube Video Randomizer will help you with never seeing the same video again and again...
          </p>
        </div>

        <div class="col-md-4">
          <h2>How to cure boredom?</h2>
          <p>
          	Maybe see a doctor... But whyle you're here why not to <strong>TRY YOUR LUCK</strong> with the most epic youtube video randomizer software? 
          </p>
        </div>
  	</div>
</div>
<footer class="footer">
	<p class="text-center container">
		<em>
			<strong>
				Made with <img src="heart.png"> by <a href="https://www.fantaziu.it"  target="_blank" title="Das Web Developer">Fantaziu Ion</a>, <a href="http://www.fantaziu.com" target="_blank"  title="Das International Web Developer">Fantaziu Ion</a> and <a href="https://www.bigdatacluster.com" target="_blank" title="Open Project">Fantaziu Ion</a>
			</strong>
		</em>
	</p>
</footer>
</body>
</html>
