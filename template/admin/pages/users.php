<?php
	if(! defined('BASEPATH') ){ exit('Unable to view file.'); }

	// Load Sidebar
	require(BASE_PATH.'/template/admin/common/sidebar.php');
	
	$page = (isset($_GET['x']) ? $_GET['x'] : 0);
	$limit = 25;
	$start = (is_numeric($page) && $page > 0 ? ($page-1)*$limit : 0);

	$db_query = '';
	$paginatorURL = '';
	if(isset($_GET['y']) && $_GET['y'] == 'today')
	{
		$db_query = " WHERE `reg_time`>='".strtotime(date('d M Y'))."'";
		$paginatorURL = '&y=today';
	}

	$total_pages = $db->QueryGetNumRows("SELECT `id` FROM `users`".$db_query);
	include(BASE_PATH.'/system/libs/paginator.php');

	$urlPattern = GenerateURL('users&x=(:num)'.$paginatorURL, false, true);
	$paginator = new Paginator($total_pages, $limit, $page, $urlPattern);
	$paginator->setMaxPagesToShow(5);

	if(isset($_GET['delete']) && is_numeric($_GET['delete']))
	{
		$id = $db->EscapeString($_GET['delete']);
		$db->Query("DELETE FROM `users` WHERE `id`='".$id."'");
	}
?>
<main id="main" class="main">
<div class="pagetitle">
  <h1>Users (<?php echo $total_pages; ?>)</h1>
  <nav>
	<ol class="breadcrumb">
	  <li class="breadcrumb-item"><a href="<?php echo GenerateURL('dashboard', false, true); ?>">Home</a></li>
	  <li class="breadcrumb-item active">Users</li>
	</ol>
  </nav>
</div>
<section class="section">
  <div class="row">
	<div class="col-lg-12">
	  <div class="table-responsive card">
		<table class="table table-striped table-hover table-sm table-responsive-sm text-center m-0">
			<thead>
			  <tr>
				<th scope="col">#</th>
				<th scope="col">User</th>
				<th scope="col">Account Balance</th>
				<th scope="col">Email Address</th>
				<th scope="col">Country</th>
				<th scope="col">Registration Time</th>
				<th scope="col"></th>
			  </tr>
			</thead>
			<tbody>
				<?php
					if(isset($_GET['x']) && $_GET['x'] == 'today')
					{
						$db_query = " WHERE a.reg_time >= '".strtotime(date('d M Y'))."'";
					}

					$users = $db->QueryFetchArrayAll("SELECT a.*, b.country FROM users a LEFT JOIN list_countries b ON b.id = a.country_id".$db_query." ORDER BY a.id DESC LIMIT ".$start.",".$limit);

					if(empty($users))
					{
						echo '<tr><td colspan="7" class="text-center">There is nothing here yet!</td></tr>';
					}

					foreach($users as $user)
					{
						echo '<tr>
							<td>'.$user['id'].'</td>
							<td>'.$user['username'].' <i class="bi bi-gender-'.($user['gender'] == 2 ? 'female' : 'male').' text-'.($user['gender'] == 2 ? 'danger' : 'primary').'"></i></td>
							<td><span class="badge bg-dark">'.number_format($user['account_balance'], 2).' coins</span></td>
							<td>'.$user['email'].'</td>
							<td>'.$user['country'].'</td>
							<td>'.date('d M Y H:i', $user['reg_time']).'</td>
							<td>
								<a href="'.GenerateURL('edituser&x='.$user['id'], false, true).'" class="btn btn-sm btn-primary m-r-2" title="Edit"><i class="bi bi-pencil-square"></i></a>
								<a href="'.GenerateURL('users&delete='.$user['id'], false, true).'" class="btn btn-sm btn-danger m-r-2" title="Delete" onclick="return confirm(\'Are you sure you want to delete this user?\');"><i class="bi bi-trash"></i></a>
							</td>
						  </tr>';
					}
				?>
			  
			</tbody>
		</table>
		<?php if($total_pages > $limit){ ?>
			<nav class="m-3">
				<ul class="pagination justify-content-center mb-0">
				<?php 
					if ($paginator->getPrevUrl()) {
						echo '<li class="page-item"><a class="page-link" href="'.$paginator->getPrevUrl().'">&laquo; Previous</a></li>';
					} else {
						echo '<li class="page-item disabled"><a class="page-link" href="#">&laquo; Previous</a><li>';
					}

					foreach ($paginator->getPages() as $page) {
						if ($page['url']) {
							echo '<li class="page-item'.($page['isCurrent'] ? ' active' : '').'"><a class="page-link" href="'. $page['url'].'">'.$page['num'].'</a></li>';
						} else {
							echo '<li class="page-item disabled"><a class="page-link" href="#">'.$page['num'].'</a></li>';
						}
					}

					if ($paginator->getNextUrl()) {
						echo '<li class="page-item"><a class="page-link" href="'.$paginator->getNextUrl().'">Next &raquo;</a></li>';
					}
				?>
				</ul>
			</nav>
		<?php } ?>
	  </div>
	</div>
  </div>
</section>
</main>