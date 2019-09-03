<?php 
 require 'db.php';
 include "header.php"; ?>
	<div class="col-md-12">
   <?php
							$user_id = 1;
						
						$page = @$_GET['page'];
						if($page == 0 || $page == 1){
							$page1 = 0;	
							$counterURL = 1;
						}
						else {
							$page1 = ($page * 8) - 8;	
							}
							
						switch ($page) {
						case 2:
							$counterURL = 9;
							break;
						case 3:
							$counterURL = 17;
							break;
						case 4:
						$counterURL = 25;
						break;
						case 5:
						$counterURL = 33;
						break;
					}
						$query = "SELECT * FROM bookrecord LIMIT $page1, 8";
						$result1 = mysqli_query($con,$query);
					?>
                </div>
                
 <body class="bg-success">
				<?php
				 while($result = mysqli_fetch_array($result1)){
				$filename = "u_".$user_id."_image".$counterURL;
					 $counterURL++; ?>
					<div class="main">
							<a href="<?php echo 'pdf.php?filename='.$result["url"].'';?>"><img class="child" src="img/<?php echo $filename?>.jpg" alt="<?php echo $result['title'];?>"></a>
							<h3><?php echo $result['title'];?></h3>
							<p><?php echo $result['description'];?></p>
							<p>Rs:<?php echo $result['price'];?></p>
							<a href="<?php echo $result['url'];?>"><button class="btn btn-success">Download</button></a>
					</div>
	        	<?php }; ?>
				
						<ul class="pagination pagination-lg pages">
						<?php
							$q = mysqli_query($con,"SELECT * FROM bookrecord");
							$count = mysqli_num_rows($q);
							$a = $count / 8;
							$a = ceil($a);
						?>
						
							<?php for ($i = 1; $i <= $a; $i++) {?>
								<li><a href="index.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li> 
				 <?php } ?>	
						</ul>
</body>
</html>
