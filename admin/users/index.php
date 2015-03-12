<?php require('../../res/meta.php'); ?>
<?php require('../../res/admin/meta.php'); ?>
 <title>Users | Admin | It's Christmas</title>
 </head>
<body class="admin">
<?php require('../../res/admin/header.php'); ?>

	<main>
		<div class="breadcrumb">
			<ul>
				<li><a href="/admin/">Admin dashboard</a></li>
			</ul>
		</div>
		<div class="wrapper">

			<h1>Users</h1>
			<?php 
				$userQuery = mysqli_query($connect, "SELECT * FROM users");
				$userCount = mysqli_num_rows($userQuery);

				if ($userCount > 0){ ?>
					<table>
						<thead>
							<tr>
								<th>User ID</th>
								<th>Username</th>
								<th>User Email</th>
								<th>T&Cs</th>
								<th>Authorised</th>
								<th>Moderated</th>
							</tr>
						</thead>
						<tbody>
						<?php
							while($userRow = mysqli_fetch_array($userQuery)){
								?>
									<tr>
										<td><?php echo $userRow['userID']; ?></td>
										<td><a href="/admin/users/profile/?id=<?php echo $userRow['userID']; ?>"><?php echo $userRow['userName']; ?></a></td>
										<td><?php echo $userRow['userEmail']; ?></td>
										<td>
											<?php
												if ($userRow['userTerms']){
													echo "Yes";
												} else {
													echo "No";
												}
											?>
										</td>
										<td>
											<?php
												if ($userRow['userAuth']){
													echo "Yes";
												} else {
													echo "No";
												}
											?>
										</td>
										<td>
											<?php
												if ($userRow['userModerated']){
													echo "Yes";
												} else {
													echo "No";
												}
											?>
										</td>
									</tr>

								<?php
							}
						?>
						</tbody>
					</table>
					<?php
				}
			?>
				
		</div>
	</main>


</body>
</html>