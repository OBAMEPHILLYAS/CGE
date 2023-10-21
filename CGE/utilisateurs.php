<?php
	require_once("security.php");
?>
<?php 
	require_once("connexion.php");
	
/*##########       PAGINATION      ##########*/
	$mc="";	
	$size=4;
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
		$req="SELECT * FROM user WHERE login LIKE '%$mc%' LIMIT $size OFFSET $offset ";
	}
	else{
		$req= "SELECT * from user LIMIT $size OFFSET $offset";
	}
	$ps=$pdo->prepare($req);
	$ps->execute();

/*#########  NOMBRE DE PAGE DES TOUS LES UTILISATEURS #######*/
	
	if (isset($_GET['motcle']))
		$ps2=$pdo->prepare("SELECT COUNT(*) AS NB_Utilisateurs FROM user WHERE login LIKE '%$mc%'");	
	else 
		$ps2=$pdo->prepare("SELECT COUNT(*) AS NB_Utilisateurs FROM user");
	$ps2->execute();
	$ligne=$ps2->fetch(PDO::FETCH_ASSOC);
	$NBU=$ligne['NB_Utilisateurs'];
	if (($NBU % $size)==0) $NBP=floor($NBU/$size);
	else $NBP=floor($NBU/$size)+1;
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
				<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
</svg>
				Tous les utilisateurs
				<form method="get" action="utilisateurs.php" class="form-search pull-right">
                  <input type="text" name="motcle" value="<?php echo($mc)?>" class="input-medium search-query">
                  <button type="submit" class="btn btn-dark btn-sm"> 
                  	<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
  <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
</svg>
                  	RECHERCHER </button>
                </form>  
            </div>
            <div class="panel-heading"> 
            	<button type="submit" class="btn btn-info btn-sm">
            		<a href="newuser.php">
            			<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person-plus" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M11 14s1 0 1-1-1-4-6-4-6 3-6 4 1 1 1 1h10zm-9.995-.944v-.002.002zM1.022 13h9.956a.274.274 0 0 0 .014-.002l.008-.002c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664a1.05 1.05 0 0 0 .022.004zm9.974.056v-.002.002zM6 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0zm4.5 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
  <path fill-rule="evenodd" d="M13 7.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0v-2z"/>
</svg>
            			Nouveau utilisateur</a>
				</button> 
            </div>
			<div class="panel-body">

			 	<table class="table table-striped">
					<thead>
						<tr>
							<th><center>Login</center></th><th><center>Mot de passe</center></th><th><center>Rôle</center></th><th><center>Photo</center></th>
						</tr>
					</thead>
					<tbody>
						<?php while ( $et=$ps->fetch()) { ?>
							<tr>
								<td><center> <?php echo ($et['login']) ?></center></td>
								<td> <center><?php echo ($et['password']) ?></center></td>
								<td><center> <?php echo ($et['role']) ?></center></td>
								<td><center><img src="photo/<?php echo ($et['photo'])?>" width="50" height="50" class="img-circle"></center></td>
								<td>
									<button type="button" class="btn btn-success">
									<a href="edituser.php?login=<?php echo ($et['login'])?>">
										<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
</svg>
									</a>
									</button>
									
								</td>
								<td>
									<button type="button" class="btn btn-warning">
										<a onclick="return confirm('Etes-vous sûr..?');" href="deleteuser.php?login=<?php echo ($et['login'])?>">
											<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
  <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
</svg>
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
						<a href='utilisateurs.php?page=<?php echo($i)?>&&motcle=<?php echo($mc)?>'>Page <?php echo($i)?></a>
					</li>
					<?php }?>
				</ul>
			</div>
		</div>
		
	</div> 
	<?php require_once("pied.php");?>
	</body>

</html>
