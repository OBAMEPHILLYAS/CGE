<?php require_once("connexion.php");
/*Debut. Affiche tous les services*/
$req="SELECT * FROM electeur AS e, bureau AS b, centre AS c WHERE c.id_centre = b.id_centre AND b.id_bureau = e.id_electeur";
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
		$req="SELECT * FROM candidat WHERE nom_registre LIKE '%$mc%' LIMIT $size OFFSET $offset ";
	}
	else{
		$req= "SELECT * FROM electeur AS e, bureau AS b, centre AS c WHERE c.id_centre = b.id_centre AND b.id_bureau = e.id_electeur  LIMIT $size OFFSET $offset";
	}
	$ps=$pdo->prepare($req);
	$ps->execute();


/*#########  NOMBRE DE PAGE DES TOUS LES SERVICES #######*/
	
	if (isset($_GET['motcle']))
		$ps2=$pdo->prepare("SELECT COUNT(*) AS NB_Registre FROM registre WHERE nom_registre LIKE '%$mc%'");	
	else 
		$ps2=$pdo->prepare("SELECT COUNT(*) AS NB_Registre FROM electeur");
	$ps2->execute();
	$ligne=$ps2->fetch(PDO::FETCH_ASSOC);
	$NBR=$ligne['NB_Registre'];
	if (($NBR % $size)==0) $NBP=floor($NBR/$size);
	else $NBP=floor($NBR/$size)+1;
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
					Liste des electeurs
				</div>
				<div class="panel-heading"> 
            		<button type="submit" class="btn btn-info btn-sm">
            		<a href="formaddelecteur.php">Nouvel électeur</a>
					</button> 
            	</div>
            	<div class="panel-body">
            		<table class="table table-striped">
            			<thead>
							<tr>
								<th><center>#</center></th><th><center>CIN</center></th><th><center>Nom</center></th><th><center>Prénom</center></th> <th><center>Adresse</center></th><th><center>Date naissance</center></th><th><center>Lieu</center></th><th><center>Centre</center></th><th><center>Bureau</center></th><th><center>Photo</center></th>
							</tr>
						</thead>
						<tbody>
							<!--Debut. Recupère tous les registres et les affiche ligne par ligne-->
							<?php while ( $et=$ps->fetch()) { ?>
							<tr>
								<td> <center><strong><?php echo ($et['id_electeur']) ?></strong></center></td>
								<td> <center><?php echo ($et['cni_electeur']) ?></center></td>
								<td><center> <?php echo ($et['nom_electeur']) ?></center></td>
								<td><center> <?php echo ($et['prenom_electeur']) ?></center></td>
								<td> <center><?php echo ($et['adresse_electeur']) ?></center></td>
								<td> <center><?php echo ($et['date_electeur']) ?></center></td>
								<td> <center><?php echo ($et['lieu_electeur']) ?></center></td>
								<td value="<?php echo $et['id_centre']; ?>"><center> <strong><?php echo ($et['nom_centre']) ?></strong></center></td>
								<td value="<?php echo $et['id_bureau']; ?>"><center> <strong><?php echo ($et['nom_bureau']) ?></strong></center></td>
								<td><center><img src="photo/<?php echo ($et['photo_electeur'])?>" width="50" height="50" class="img-circle"></center></td>
								<!--le boutons modifier et supprimer-->
								<td>
									<button type="button" class="btn btn-success">
									<a href="formeditelecteur.php?id_electeur=<?php  echo ($et['id_electeur'])?>"> Modifier
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
						<a href='electeur.php?page=<?php echo($i)?>&&motcle=<?php echo($mc)?>'> Page <?php echo($i)?></a>
					</li>
					<?php }?>
				</ul>
			</div>
			</div>
		</div>
	</body>
</html>