<?php require_once("connexion.php");
/*Debut. Affiche tous les services*/
$req="SELECT * FROM candidat AS C, election AS E WHERE C.id_election = E.id_election ";
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
		$req= "SELECT * FROM candidat AS C, election AS E WHERE C.id_election = E.id_election  LIMIT $size OFFSET $offset";
	}
	$ps=$pdo->prepare($req);
	$ps->execute();


/*#########  NOMBRE DE PAGE DES TOUS LES SERVICES #######*/
	
	if (isset($_GET['motcle']))
		$ps2=$pdo->prepare("SELECT COUNT(*) AS NB_Registre FROM registre WHERE nom_registre LIKE '%$mc%'");	
	else 
		$ps2=$pdo->prepare("SELECT COUNT(*) AS NB_Registre FROM candidat");
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
					Liste des candidats
				</div>
				<div class="panel-heading"> 
            		<button type="submit" class="btn btn-info btn-sm">
            		<a href="formaddcandidat.php">Nouveau candidat</a>
					</button> 
            	</div>
            	<div class="panel-body">
            		<table class="table table-striped">
            			<thead>
							<tr>
								<th><center>#</center></th><th><center>Nom</center></th><th><center>Prénom</center></th> <th><center>Parti</center></th><th><center>Election</center></th><th><center>Photo</center></th>
							</tr>
						</thead>
						<tbody>
							<!--Debut. Recupère tous les registres et les affiche ligne par ligne-->
							<?php while ( $et=$ps->fetch()) { ?>
							<tr>
								<td> <center><strong><?php echo ($et['id_candidat']) ?></strong></center></td>
								<td><center> <?php echo ($et['nom_candidat']) ?></center></td>
								<td><center> <?php echo ($et['prenom_candidat']) ?></center></td>
								<td> <center><?php echo ($et['parti_candidat']) ?></center></td>
								<td value="<?php echo $et['id_election']; ?>"><center> <strong><?php echo ($et['libelle_election']) ?></strong></center></td>
								<td><center><img src="photo/<?php echo ($et['photo_candidat'])?>" width="50" height="50" class="img-circle"></center></td>
								<!--le boutons modifier et supprimer-->
								<td>
									<button type="button" class="btn btn-success">
									<a href="formeditcandidat.php?id_candidat=<?php  echo ($et['id_candidat'])?>"> Modifier
										
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
						<a href='registre.php?page=<?php echo($i)?>&&motcle=<?php echo($mc)?>'> Page <?php echo($i)?></a>
					</li>
					<?php }?>
				</ul>
			</div>
			</div>
		</div>
	</body>
</html>