<?php
	session_start();
	include_once("inc/global.php");
	include_once(DOCUMENT_ROOT . "inc/user.php");
	include_once(DOCUMENT_ROOT . "inc/topic.php");
	include_once(DOCUMENT_ROOT . "inc/post.php");
?>
<html>
<head>
	<title>Spot SPOC</title>
	<link rel="stylesheet" href="css/default.css" />
</head>
<body>
	<?php include(DOCUMENT_ROOT . "header.php"); ?>

	<?php
		if (isset($_POST['reply']) && isset($_POST['reply']['content'])) {
			$content = $_POST['reply']['content'];

			Post::create($content, $_GET['id'], User::current_user_id());
			echo '<meta http-equiv="refresh" content="5">';
		}
	?>
	<div id="content">
		<div id="LeftContent">
			<?php include(DOCUMENT_ROOT . "sidebar.php"); ?>
		</div>
		<?php
			if (isset($_GET['id']) && $_GET['id'] > 0): ?>
				<table border="1">
					<tr>
						<th><?php echo htmlspecialchars(Topic::subject_by_id($_GET['id']), ENT_QUOTES, 'UTF-8') ?></th>
					</tr>
					<?php foreach(Post::all($_GET['id']) as $post): ?>
						<tr>
							<td class="leftpart">
								<h4><?php echo User::name_by_id($post[4]) ?></h4><br />
								<h5><?php echo $post[2] ?></h5>
							</td>
							<td class="rightpart">
								<p><?php echo htmlspecialchars($post[1], ENT_QUOTES, 'UTF-8') ?></p>
							</td>
						</tr>
					<?php endforeach; ?>
				</table>
		<?php endif; ?>

		<form id="community_topic" action="" method="POST">
			<div class="field">
				<label for="reply_content">Content: </label><br />
				<textarea name="reply[content]" class="required" id="reply_content"></textarea>
			</div>
			<div class="field">
				<input type="submit" class="required" value="Submit reply" />
			</div>
		</form>
	</div>
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/jquery.validate.js"></script>
	<script type="text/javascript" src="js/community.js"></script>
</body>
</html>