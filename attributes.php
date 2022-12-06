<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
 
<head>
 
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="description" content="">
   <meta name="author" content="">
 
   <title>OpenID Connect: Released Attributes</title>
 
</head>
 
<body>
 
   <!-- Intro -->
   <div class="banner">
      <div class="container">
         <h1 class="section-heading">Claims</h1>
 
         <h3>
            Claims sent back from OpenID Connect
         </h3>
         <br/>
      </div>
   </div>
 
   <!-- Claims -->
   <div class="content-section-a" id="openAthensClaims">
      <div class="container">
 
         <h2>Claims</h2>
         <br/>
         <div class="row">
				<p>
					<?php 
						// var_dump($oidc);
						print_r($_SESSION);
					?>
				</p>
         </div>
		
			<p>
				<a href="logout.php">Log Out</a>
			</p>
      </div>
   </div>
</body>
 
</html>