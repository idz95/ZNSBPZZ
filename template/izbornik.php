<nav class="fh5co-nav" role="navigation">
		<div class="container-wrap">
			<div class="top-menu">
				<div class="row">
					<div class="col-xs-2">
						<div id="fh5co-logo"><a href="<?php echo $putanjaAPP; ?>index.php" style="color: #66D37E;">ŽNS BPŽ</a></div>
					</div>
					<div class="col-xs-10 text-right menu-1">
						<ul>
							<?php //poziv funkcije koja je definirana u /Edunova05/funkcije.php:4
							stavkaIzbornika($putanjaAPP . "index.php", "Naslovnica");
 							?>

									<?php stavkaIzbornika($putanjaAPP."lige.php", "Lige"); ?>
									
									
									<?php if(isset($_SESSION[$appID."autoriziran"])): ?>
										
									<?php 
									if($_SESSION[$appID."autoriziran"]->uloga==="admin"){
										stavkaIzbornika($putanjaAPP . "privatno/nadzornaPloca.php", "Nadzorna ploča"); }
										
									?>


                                        <?php
                                        if($_SESSION[$appID."autoriziran"]->uloga==="admin"){
                                            stavkaIzbornika($putanjaAPP . "privatno/profil/profilSuca.php", "Moj profil"); }
                                        ?>

                                        <?php
                                        if($_SESSION[$appID."autoriziran"]->uloga==="sudac"){
                                            stavkaIzbornika($putanjaAPP . "privatno/profil/profilSuca.php", "Moj profil"); }
                                        ?>

                                        <?php
                                        if($_SESSION[$appID."autoriziran"]->uloga==="delegat"){
                                            stavkaIzbornika($putanjaAPP . "privatno/profil/profilDelegat.php", "Moj profil"); }
                                        ?>
									
									<?php endif;
									?>
      							
      							
      			
						      <?php if(!isset($_SESSION[$appID."autoriziran"])): ?>
	  		
							<li><a href="<?php echo $putanjaAPP; ?>prijava.php" >Prijava</a>
							<?php else: ?>
							<li><a href="<?php echo $putanjaAPP; ?>logout.php">Odjava <?php 
	  		
				  			echo $_SESSION[$appID."autoriziran"]->ime;
				  			
				  			?></a>
							<?php endif;?>	
							</li>
						</ul>
					</div>
				</div>
				
			</div>
		</div>
	</nav>