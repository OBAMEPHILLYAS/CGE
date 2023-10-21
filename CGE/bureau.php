<?php
	require_once("security.php");
?>
<?php 
	require_once("connexion.php");

	/*Debut. Affiche tous les services*/
$req="SELECT * FROM bureau AS b, centre AS c WHERE c.id_centre = b.id_bureau ";
$ps=$pdo->prepare($req);
$ps->execute();
/*Fin. Affiche tous les services*/
	
/*##########       PAGINATION      ##########*/
	$mc="";	
	$size=5;
	if(isset($_GET['page'])){
		
		$page=$_GET['page'];
	}
	else{
		$page=0;
	}
	$offset=$size*$page;
/*##########  RECHERCHER PAR MOT CLE ########*/
	if (isset($_GET['motcle'])){
		$mc=$_GET['motcle'];
		$req="SELECT * FROM document WHERE nom_document  LIKE '%$mc%' LIMIT $size OFFSET $offset";
	}
	else{
		$req= "SELECT * FROM bureau AS b, centre AS c WHERE c.id_centre = b.id_bureau  LIMIT $size OFFSET $offset";
	}
	$ps=$pdo->prepare($req);
	$ps->execute();

/*#########  NOMBRE DE PAGE DES TOUS LES UTILISATEURS #######*/
	
	if (isset($_GET['motcle']))
		$ps2=$pdo->prepare("SELECT COUNT(*) AS NB_Document FROM document WHERE nom_document LIKE '%$mc%'");	
	else 
		$ps2=$pdo->prepare("SELECT COUNT(*) AS NB_Document FROM bureau");
	$ps2->execute();
	$ligne=$ps2->fetch(PDO::FETCH_ASSOC);
	$NBD=$ligne['NB_Document'];
	if (($NBD % $size)==0) $NBP=floor($NBD/$size);
	else $NBP=floor($NBD/$size)+1;
?>
<html>
	<head>
		<meta charset="utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- Link bootstrap css-->
		<link rel="stylesheet" type="text/css" href="css\bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="css\mystyle.css" />
		<!-- js 
		<script type="text/javascript"  href="js/bootstrap.js"></script>
		<script type="text/javascript" href="js/bootstrap.min.js"></script>
		<script type="text/javascript"  href="js/jquery.js"></script>

		<script type="text/javascript"  href="js/script.js"></script> -->
	</head>
	<body>
	<?php require_once("entete.php");?>
	<div class="container">
		<div class="panel panel-info spacer">
			<div class="panel-heading"> 
				Les bureaux
            </div>
            <div class="panel-heading"> 
            	<button type="submit" class="btn btn-info btn-sm">
            		<a href="formnaddbureau.php">
            			Nouveau bureau</a>
				</button> 
            </div>
			<div class="panel-body">

			 	<table class="table table-striped">
					<thead>
						<tr>
							<th id="th"><center>Nom bureau</center></th><!--<th id="th">Index</th>--><th id="th"><center>Responsable bureau</center></th><th id="th"><center>Libelle centre</center></th>
						</tr>
					</thead>
					<tbody>
						<?php while ( $et=$ps->fetch()) { ?>
							<tr>
								<td><center> <?php echo ($et['nom_bureau']) ?></center></td>
								<td> <center><?php echo ($et['responsable_bureau']) ?></center></td>
								<td value="<?php echo $et['id_election']; ?>"><center> <?php echo ($et['nom_centre']) ?></center></td>
								<!--le boutons modifier et supprimer-->
								<td>
									<button type="button" class="btn btn-success">
									<a href="formeditbureau.php?id_bureau=<?php  echo ($et['id_bureau'])?>"> Modifier
										
									</a>
									</button>
									
								</td>

							</tr>
						<?php } ?>
					</tbody>
				</table>

			</div>
			<div class="pagination">
				<ul class="nav nav-pills">
					<?php for($i=0; $i<$NBP; $i++){?>
					<li class="<?php echo(($i==$page)?'active':'');?>">
						<a href='document.php?page=<?php echo($i)?>&&motcle=<?php echo($mc)?>'>Page <?php echo($i)?></a>
					</li>
					<?php }?>
				</ul>
			</div>
		</div>
		
	</div>
	</br> 
	</body>

</html>
