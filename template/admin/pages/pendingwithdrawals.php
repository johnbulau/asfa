<?php
	if(! defined('BASEPATH') ){ exit('Unable to view file.'); }
	
	// Load Sidebar
	require(BASE_PATH.'/template/admin/common/sidebar.php');

	$page = (isset($_GET['x']) ? $_GET['x'] : 0);
	$limit = 25;
	$start = (is_numeric($page) && $page > 0 ? ($page-1)*$limit : 0);

	$total_pages = $db->QueryGetNumRows("SELECT `id` FROM `withdrawals` WHERE `status`='0'");
	include(BASE_PATH.'/system/libs/paginator.php');

	$urlPattern = GenerateURL('pendingwithdrawals&x=(:num)', false, true);
	$paginator = new Paginator($total_pages, $limit, $page, $urlPattern);
	$paginator->setMaxPagesToShow(5);
		
	if(isset($_GET['pay']) && is_numeric($_GET['pay']))
	{
		$id = $db->EscapeString($_GET['pay']);
		$db->Query("UPDATE `withdrawals` SET `status`='1' WHERE `id`='".$id."'");
				
		$errMessage = '<div class="alert alert-success"><b>SUCCESS:</b> Withdrawal request was successfully marked as paid!</div>';
	}
	
	if(isset($_GET['reject']) && is_numeric($_GET['reject']))
	{
		$id = $db->EscapeString($_GET['reject']);
		$db->Query("UPDATE `withdrawals` SET `status`='2' WHERE `id`='".$id."'");
		$errMessage = '<div class="alert alert-warning"><b>SUCCESS:</b> Withdrawal request was successfully rejected!</div>';
	}
	
	if(isset($_GET['refund']) && is_numeric($_GET['refund']))
	{
		$id = $db->EscapeString($_GET['refund']);
		$withdrawal = $db->QueryFetchArray("SELECT * FROM `withdrawals` WHERE `id` = '".$id."' AND `status` = '0' LIMIT 1");
		
		if(empty($withdrawal['id']))
		{
			$errMessage = '<div class="alert alert-danger" role="alert"><b>ERROR:</b> This reward request no longer exists!</div>';
		}
		else
		{
			$db->Query("UPDATE `users` SET `account_balance`=`account_balance`+'".$withdrawal['coins']."' WHERE `id`='".$withdrawal['user_id']."'");
			$db->Query("UPDATE `withdrawals` SET `status`='3' WHERE `id`='".$id."'");
			$errMessage = '<div class="alert alert-success"><b>SUCCESS:</b> Withdrawals request was successfully refunded!</div>';
		}
	}
?>
<main id="main" class="main">
<div class="pagetitle">
  <h1>Pending Withdrawals (<?php echo number_format($total_pages); ?>)</h1>
  <nav>
	<ol class="breadcrumb">
	  <li class="breadcrumb-item"><a href="<?php echo GenerateURL('dashboard', false, true); ?>">Home</a></li>
	  <li class="breadcrumb-item">Withdrawals</li>
	  <li class="breadcrumb-item active">Pending</li>
	</ol>
  </nav>
</div>
<section class="section">
  <div class="row">
	<div class="col-lg-12">
	  <div class="alert alert-primary alert-dismissible fade show" role="alert">
		<h4 class="alert-heading">Pending withdrawals <div class="spinner-border spinner-border-sm" role="status"></div></h4>
		<p>Below you can see all pending withdrawal requests. If you accept withdrawal request, make sure you manually send payment to user's account before marking it as complete.</p>
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	  </div>
	  <?php echo $errMessage; ?>
	  <div class="table-responsive card">
		<table class="table table-striped table-hover table-sm table-responsive-sm text-center m-0">
			<thead class="thead-dark">
				<tr>
					<th>#</th>
					<th>User</th>
					<th>Coins</th>
					<th>Value</th>
					<th>Payment Info</th>
					<th>User IP</th>
					<th>Date</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php
					$requests = $db->QueryFetchArrayAll("SELECT a.*, b.username FROM withdrawals a LEFT JOIN users b ON b.id = a.user_id WHERE a.status = '0' ORDER BY a.id DESC LIMIT 25");
					
					if(count($requests) == 0)
					{
						echo '<td colspan="8"><center>There is nothing here yet!</center></td>';
					}
					else
					{
						foreach($requests as $request) 
						{
							echo '<tr>
								<td>'.$request['id'].'</td>
								<td><b><a href="'.GenerateURL('edituser&x='.$request['user_id'], false, true).'">'.$request['username'].'</a></b></td>
								<td><span class="badge bg-light text-dark">'.number_format($request['coins']).'</span></td>
								<td><span class="badge bg-success">$'.number_format($request['amount'], 2).'</span></td>
								<td><span class="badge bg-dark text-light">'.$request['payment_info'].'</span></td>
								<td><span class="badge bg-light text-dark">'.$request['ip_address'].'</span></td>
								<td><span class="badge bg-light text-dark">'.date('d M Y - H:i', $request['time']).'</span></td>
								<td>
									<a href="'.GenerateURL('pendingwithdrawals&pay='.$request['id'], false, true).'" class="btn btn-sm btn-success m-r-2" title="Approve" onclick="return confirm(\'Are you sure you want to accept this request?\');"><i class="bi bi-check-circle-fill"></i></a>
									<a href="'.GenerateURL('pendingwithdrawals&reject='.$request['id'], false, true).'" class="btn btn-sm btn-danger m-r-2" title="Reject" onclick="return confirm(\'Are you sure you want to reject this request?\');"><i class="bi bi-x-circle-fill"></i></a>
									<a href="'.GenerateURL('pendingwithdrawals&refund='.$request['id'], false, true).'" class="btn btn-sm btn-warning m-r-2" title="Refund" onclick="return confirm(\'Are you sure you want to refund this request?\');"><i class="bi bi-arrow-repeat"></i></a>
								</td>
							  </tr>';
						}
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