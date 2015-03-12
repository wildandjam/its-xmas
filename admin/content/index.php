<?php require('../../res/meta.php'); ?>
<?php require('../../res/admin/meta.php'); ?>
 <title>Content/SEO | Admin | It's Christmas</title>
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

			<h1>Content/SEO</h1>
			<?php 
				$contentQuery = mysqli_query($connect, "SELECT * FROM seo");
				$contentCount = mysqli_num_rows($contentQuery);

				if ($contentCount > 0){ ?>
					<table class="auto-width">
						<thead>
							<tr>
								<th>Page ID</th>
								<th>Page Title</th>
							</tr>
						</thead>
						<tbody>
						<?php
							while($contentRow = mysqli_fetch_array($contentQuery)){
								?>
									<tr>
										<td><?php echo $contentRow['pageID']; ?></td>
										<td><a href="/admin/content/page/?id=<?php echo $contentRow['pageID']; ?>"><?php echo $contentRow['pageTitle']; ?></a></td>
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