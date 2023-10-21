
<?php require_once("connexion.php");
/*Debut. Affiche tous les elections*/
$req="SELECT * FROM election";
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
	if (isset($_GET['libelle_election'])){
		$mc=$_GET['libelle_election'];
		$req="SELECT * FROM election WHERE libelle_election LIKE '%$mc%' LIMIT $size OFFSET $offset ";
	}
	else{
		$req= "SELECT * from election LIMIT $size OFFSET $offset";
	}
	$ps=$pdo->prepare($req);
	$ps->execute();


/*#########  NOMBRE DE PAGE DES TOUS LES SERVICES #######*/
	
	if (isset($_GET['libelle_election']))
		$ps2=$pdo->prepare("SELECT COUNT(*) AS NB_Service FROM election WHERE libelle_election LIKE '%$mc%'");	
	else 
		$ps2=$pdo->prepare("SELECT COUNT(*) AS NB_Service FROM election");
	$ps2->execute();
	$ligne=$ps2->fetch(PDO::FETCH_ASSOC);
	$NBS=$ligne['NB_Service'];
	if (($NBS % $size)==0) $NBP=floor($NBS/$size);
	else $NBP=floor($NBS/$size)+1;
?>
<html>
	<head>
		<meta charset="utf-8"/>
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
					Les élections
				</div>
				<div class="panel-heading"> 
            		<button type="submit" class="btn btn-info btn-sm">
            		<a href="formelection.php">	Publier une élection </a>
					</button> 
            	</div>
            	<div class="panel-body">
            		<table class="table table-striped">
            			<thead>
							<tr>
								<th><center>#</center></th><th><center>Libelle</center></th>
							</tr>
						</thead>
						<tbody>
							<!--Debut. Recupère tous les services et les affiche ligne par ligne-->
							<?php while ( $et=$ps->fetch()) { ?>
							<tr>
								<td><center><strong> <?php echo ($et['id_election']) ?></strong></center></td>
								<td><center> <?php echo ($et['libelle_election']) ?></center></td>
								
								<!--le boutons modifier et supprimer-->
								<td>
									<button type="button" class="btn btn-success">
									<a href="formeditelection.php?id_election=<?php  echo ($et['id_election'])?>"> Modifier
									</a>
									</button>
									
								</td>
								
							<?php } ?>
							<!--Fin. Recupère tous les services et les affiche ligne par ligne-->
						</tbody>
            		</table>
            	</div>
            	<div class="pagination">
				<ul class="nav nav-pills">
					<?php for($i=0; $i<$NBP; $i++){?>
					<li class="<?php echo(($i==$page)?'active':'');?>">
						<a href='election.php?page=<?php echo($i)?>&&motcle=<?php echo($mc)?>'>Page <?php echo($i)?></a>
					</li>
					<?php }?>
				</ul>
			</div>
			</div>
		</div>
		<!--<?php require_once("pied.php");?>-->
	</body>
</html>