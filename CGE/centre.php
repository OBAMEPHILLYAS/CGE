<?php require_once("connexion.php");
/*Debut. Affiche tous les dossiers*/
$req="SELECT * FROM centre AS c, election AS e WHERE c.id_election = e.id_election ";
$ps=$pdo->prepare($req);
$ps->execute();
/*Fin. Affiche tous les dossiers*/

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
		$req="SELECT * FROM dossier WHERE nom_dossier LIKE '%$mc%' LIMIT $size OFFSET $offset ";
	}
	else{
		$req= "SELECT * FROM centre AS c, election AS e WHERE c.id_election = e.id_election LIMIT $size OFFSET $offset"; 
	}
	$ps=$pdo->prepare($req);
	$ps->execute();


/*#########  NOMBRE DE PAGE DES TOUS LES DOSSIERS #######*/
	
	if (isset($_GET['motcle']))
		$ps2=$pdo->prepare("SELECT COUNT(*) AS NB_Dossier FROM centre WHERE nom_dossier LIKE '%$mc%'");	
	else 
		$ps2=$pdo->prepare("SELECT COUNT(*) AS NB_Dossier FROM centre");
	$ps2->execute();
	$ligne=$ps2->fetch(PDO::FETCH_ASSOC);
	$NBD=$ligne['NB_Dossier'];
	if (($NBD % $size)==0) $NBP=floor($NBD/$size);
	else $NBP=floor($NBD/$size)+1;
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
					Les centres
				</div>
				<div class="panel-heading"> 
            		<button type="submit" class="btn btn-info btn-sm">
            		<a href="formaddcentre.php">
            			Nouveau centre</a>
					</button> 
            	</div>
            	<div class="panel-body">
            		<table class="table table-striped">
            			<thead>
							<tr>
								<th><center>Election</center></th><th><center>Nom</center></th><th><center>Adresse</center></th> <th><center>Province</center></th><th><center>Responsable</center></th>
							</tr>
						</thead>
						<tbody>
							<!--Debut. Recupère tous les dossiers et les affiche ligne par ligne-->
							<?php while ( $et=$ps->fetch()) { ?>
							<tr>
								<td value="<?php echo $et['id_election']; ?>"><center> <strong><?php echo ($et['libelle_election']) ?></strong></center></td>
								<td> <center><?php echo ($et['nom_centre']) ?></center></td>
								<td><center> <?php echo ($et['adresse_centre']) ?></center></td>
								<td><center> <?php echo ($et['province_centre']) ?></center></td>
								<td><center> <strong><?php echo ($et['responsable_centre']) ?></strong></center></td>
								<!--le boutons modifier et supprimer-->
								<td>
									<button type="button" class="btn btn-success">
									<a href="formeditcentre.php?id_centre=<?php  echo ($et['id_centre'])?>"> Modifier
									</a>
									</button>
									
								</td>

							</tr>
							<?php } ?>
							<!--Fin. Recupère tous les services et les affiche ligne par ligne-->
						</tbody>
            		</table>
            	</div>
            	<div class="pagination">
				<ul class="nav nav-pills">
					<?php for($i=0; $i<$NBP; $i++){?>
					<li class="<?php echo(($i==$page)?'active':'');?>">
						<a href='centre.php?page=<?php echo($i)?>&&motcle=<?php echo($mc)?>'> Page <?php echo($i)?></a>
					</li>
					<?php }?>
				</ul>
			</div>
			</div>
		</div>
	</body>
</html>