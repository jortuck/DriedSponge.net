<!DOCTYPE html>


<html>
	<head>
<!--         Site created: 9/19/19
		Author: DriedSponge(Jordan Tucker) -->

		<meta name="description" content="Admins only guys">
		<meta name="keywords" content="driedsponge.net mange">
		<meta name="author" content="Jordan Tucker">
		<meta property="og:site_name" content="DriedSponge.net | Mangement" />
	   
		<?php 
			include("views/includes/meta.php"); 
			?>
		
		<title>Manage - Content Management</title>
		<script src="https://kit.fontawesome.com/0add82e87e.js" crossorigin="anonymous"></script>
		<script src="https://www.google.com/recaptcha/api.js" async defer></script>
		<link rel="stylesheet" href = "//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" type="text/css" >
		
	</head>
 <body>

<?php
include("views/includes/navbar.php");

?>
<style>
.dropdown-head-link{
  color: black;
  text-decoration: none;

}
.dropdown-head-link:hover{
  color: black;
  text-decoration: underline;

}

</style>

	<div class="app">
	<div class="container-fluid-lg" style="padding-top: 80px;">
		
			<div class="container">
			
			<?php 
			$notadmin = false;
			$cachecleared = false;
			$motdchanged = false;
			if (isset($_SESSION['steamid'])){ 
			  if (isAdmin($_SESSION['steamid'])){


			 $cachedfiles = scandir("cache");
				$ignored = array('.', '..', '.svn', '.htaccess','.gitignore','.gitkeep'); 
				$totalcached = count($cachedfiles) - 3;
					if(isset($_POST['clear-cache']) && isMasterAdmin($_SESSION['steamid'])){
					   
					   foreach ($cachedfiles as $deletefile){
						if (in_array($deletefile, $ignored)) continue;
						$filename = 'cache/'.$deletefile;
						unlink ($filename);
						

					   }
					   header("Location: /manage/content/cache-cleared"); 
					}elseif(isset($_POST['clear-cache'])){
						$notadmin = true;
					}

					

					 if(isset($_POST['unlock-ad'])){
						if (isMasterAdmin($_SESSION['steamid'])){ 
						$unlockid = $_POST['unlock-ad'];
						
						$unlocadq = SQLWrapper()->prepare("UPDATE ads SET overide = :overide WHERE user= :id");
						$unlocadq->execute([':id' => $unlockid,':overide' => "1"]);
						header("Location: /manage/content/unlock-success"); 
						}else{
							header("Location: /manage/content/not-sponge"); 
						}
						
					}
					if(isset($_POST['delete-page'])){
						if (isMasterAdmin($_SESSION['steamid'])){ 
						$deleteid = $_POST['delete-page'];
						$deletepageq = SQLWrapper()->prepare("DELETE FROM content WHERE thing= :thing");
						$deletepageq->execute([':thing' => $deleteid]);
						header("Location: /manage/content/delete-page"); 
						}else{
							header("Location: /manage/content/not-sponge"); 
						}
						
					}
					if(isset($_POST['newpage'])){
						if (isMasterAdmin($_SESSION['steamid'])){ 
						$pagename = $_POST['pagename'];
						$pageid = str_replace(" ","",$_POST['pageid']);
						$pageslug = $pageid;
						$newpq = SQLWrapper()->prepare("INSERT INTO content (thing,title,created,slug)VALUES (?,?,?,?)")->execute([$pageid, $pagename,$_SESSION['steamid'],$pageslug]);
						header("Location: /manage/content/page-created"); 
						}else{
							header("Location: /manage/content/not-sponge"); 
						}
						
					}

				
                    include("views/includes/manage/navtab.php");
                ?>
				<br>
				<hgroup>
						<h1 class="display-4"><strong>Content Mangement</strong></h1>
				</hgroup>
				<br>
				<?php if(isMasterAdmin($steamprofile['steamid'])){
					  ?> 
					<div class="card">
						<div class="card-header">
							<h3>Cache</h3>
						</div>
							<div class="card-body text-center">
								<p class="paragraph">Current ammout of items in cache: <strong><?=htmlentities($totalcached);?></strong></p>
								<br>
								<form action="/manage/content/" method="post" >
										<button type="submit" name="clear-cache" class="btn btn-danger paragraph" >
										Clear Cache
									</button>
								</form>
							</div>
					</div>
					<br>
					<div class="card">
						<div class="card-header">
							<h3>Pages</h3>
						</div>
						<div class="card-body">  
							<form  action="/manage/content/" method="post" >
								<div class="form-row">
									<div class="form-group col">
										<label for="pagename">Page Name</label>
										<input type="text" class="form-control" name="pagename" id="pagename" placeholder="Enter the name of the page" required>
									</div>
									<div class="form-group col">
										<label for="pageid">Page ID</label>
										<input type="text" class="form-control" name="pageid" id="pageid" placeholder="Enter a unquie ID for the page" required>
									</div>
								</div>
								<div class="form-group">
									<button type="submit" class="btn btn-primary" name="newpage">Create New Page</button>
								</div>
							</form>

						<br>
														  
								<table class="table paragraph text-center">
									<thead>
										<tr>
										
										<th scope="col">Page Name</th>
										<th scope="col">Last Modified</th>
										<th scope="col">Last Editor</th>
										<th scope="col"></th>
										</tr>
									</thead>
									<tbody>
									<?php
										$pagesq = SQLWrapper()->prepare("SELECT thing,slug,UNIX_TIMESTAMP(stamp) AS stamp,created,title FROM content");
										$pagesq->execute();
										while($row = $pagesq->fetch()){ 
											$createdurl = "https://steamcommunity.com/profiles/".$row['created']."/"; 
											$href = "/manage/edit/".$row['thing'];
											$href2 = "/".$row['slug']."/";
											$title = $row["title"];

									?>
										<tr>
									   
										<td><a href="<?=htmlspecialchars($href2)?>" target="_blank"><?=htmlspecialchars($title);?></a></td>
										<td><?=htmlspecialchars(date("m/d/Y g:i a", $row["stamp"]));?></td>
										<td><a href="<?=htmlspecialchars($createdurl)?>" target="_blank"><?=htmlspecialchars($row["created"]);?></a></td>
										<td>
										<div class="dropdown">
										<button class="btn btn-primary dropdown-toggle" type="button" id="options" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											Options
										</button>
										<div class="dropdown-menu" aria-labelledby="options">
										<a class="dropdown-item" href="<?=htmlspecialchars($href)?>" target="_blank"><i class="fas fa-cog"></i> Settings</a>
										<div class="dropdown-divider"></div>
										<button  data-toggle="modal" data-target="#delete-<?=htmlspecialchars($row["thing"]);?>" class="dropdown-item text-danger" target="_blank"><i class="fas fa-trash-alt"></i> Delete</button >
										</div>
										</div>
										<div class="modal fade" id="delete-<?=htmlspecialchars($row["thing"]);?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
											<div class="modal-dialog" role="document">
												<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title text-danger" id="deleteModalLabel">Delete the <?=htmlspecialchars($row["title"]);?></h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body text-left">
													Are you sure you want to delete the <?=htmlspecialchars($row["title"]);?>? Doing this will erase all of it's contents and data.
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
												<form action="/manage/content/" method="POST">
													<button type="submit" name="delete-page" value="<?=htmlspecialchars($row["thing"]);?>" class="btn btn-danger">Delete</button>
												</form>
												</div>
												</div>
											</div>
											</div>
										</td>
										</tr>
										<?php }?>
									</tbody>
								</table>
							</div>
					</div>
					<br>
					
					<?php }?>
					<div class="card">
						<div class="card-header">
						  <h3>Currently running ads</h3>
						</div>
					  <div class="card-body">   
									  <p class="subsubhead" style="color: black; text-align: left;">Current ads in the last 24 hours</p>
										<table class="table paragraph " style="color: black;">
										<thead>
										<tr>
										<th scope="col"></th>
											<th scope="col">Submitor</th>
											<th scope="col">Timestamp</th>
											</tr>
										</thead>
										<tbody>
									  <?php
									  $sql2 = "SELECT user,overide, UNIX_TIMESTAMP(stamp) AS stamp FROM ads";
									  $result2 = SQLWrapper()->query($sql2);
										while($row2 = $result2->fetch()){ 
										  $aduurl = "https://steamcommunity.com/profiles/".$row2['user']."/"; 
										  $admnormalstamp =  date("m/d/Y g:i a", $row2["stamp"]); 
										  $numDays = abs($row2["stamp"] - time())/60/60/24;
										  if($numDays <= 1 and !$row2['overide']){
											
											?>
											
											<tr><td>
											<form action="content.php" method="post" >
											<button type="submit" value="<?=htmlspecialchars($row2["user"]);?>" name="unlock-ad" class="btn btn-primary" >
												Unlock
											</button>
										</form>
									</td><td><a href="<?=htmlspecialchars($aduurl)?>" target="_blank"><?=htmlspecialchars($row2["user"]);?></a></td><td><?=htmlspecialchars($admnormalstamp);?></td></tr> 
											
											<?php
										}
									}
									  ?>
									  </tbody>
										</table>
							</div>
						  </div>
						<br>
				<?php }else{ ?>
					<hgroup>
						<h1 class="display-2"><strong>You are not management, get out!</strong></h1>
						<?php
						header("Location: /home/");
						?>
					
					<br>
				</hgroup>

				<?php 
			}
			
		}else{
		?>
		<h1 class="articleh1">Please login to manage.</h1>
					<br>
					<p class="text-center"><a href='?login'><img src='https://steamcommunity-a.akamaihd.net/public/images/signinthroughsteam/sits_02.png'></a></p>
		<?php
		}
			?>
					</div>
				</div>

			</div>
			<!-- end of app -->
			<?php 
			include("views/includes/footer.php"); // we include footer.php here. you can use .html extension, too.
			?>
				<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
				<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
				<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
				<script src="https://unpkg.com/popper.js@1"></script>
				<script src="https://unpkg.com/tippy.js@4"></script>
				<script src="main.js"></script>
				<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
				<script src="https://cdn.tiny.cloud/1/dom10ctinmaceofbm524vgsfebgy22lsh2ooomg0oqs8wu28/tinymce/5/tinymce.min.js"></script>
				<script>tinymce.init({selector:'textarea', branding: false, plugins: "link",default_link_target: "_blank"});</script>
				<script>
					function basicPopup() {
						popupWindow = window.open(document.getElementById("privacy").value,'popUpWindow','height=500,width=500,left=100,top=100,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');
							}
				</script>
				
					<?php
					
					if(isset($action)){
					  if($action === "cache-cleared"){
					  ?>
					  <script type="text/JavaScript">  
					  toastr["success"]("The cache has been cleared!", "Congratulations!")     
					  </script>
					  <?php 
					  } 
					  
						if($action === "not-sponge"){
						?>
						<script type="text/JavaScript">  
					  toastr["error"]("You are not DriedSponge", "Error")     
					  </script>
						<?php
						}
						if($action === "unlock-success"){
						?>
								<script type="text/JavaScript">  
								toastr["success"]("This user can now advertise again", "Congratulations!")     
								</script>
						<?php
						}
						if($action === "privacy-success"){
							?>
							<script type="text/JavaScript">  
							toastr["success"]("The privacy policy has been changed!", "Congratulations!")     
							</script>
							<?php
						}
						if($action === "page-created"){
							?>
							<script type="text/JavaScript">  
							toastr["success"]("The new page was successfully created!", "Congratulations!")     
							</script>
							<?php
						}
					}
						?>
						<script>
                    		navitem = document.getElementById('contenttab').classList.add('active')
                		</script> 
 </body>

</html>