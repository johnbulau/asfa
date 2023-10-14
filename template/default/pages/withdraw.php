<?php
	if(! defined('BASEPATH') ){ exit('Unable to view file.'); }
	
	// Load Sidebar
	require(BASE_PATH.'/template/'.$config['theme'].'/common/sidebar.php');
	
	$coins_value = number_format($data['account_balance'] / $config['coins_rate'], 2);
?>
<main id="main" class="main">
<div class="pagetitle">
  <h1>Withdraw	</h1>
  <nav>
	<ol class="breadcrumb">
	  <li class="breadcrumb-item"><a href="/">Home</a></li>
	  <li class="breadcrumb-item">Withdraw</li>
	</ol>
  </nav>
</div>
<section class="section">
  <div class="row">
	<div class="col-lg-12">
	  <div class="alert alert-warning text-center"><i class="bi bi-info-circle-fill"></i> You have <b><?php echo number_format($data['account_balance'], 2); ?> Coins</b> which are worth <b>$<?php echo $coins_value; ?></b></div>
	  <div class="card">
		<div class="card-body p-2">
			<form class="row g-3" method="POST" id="withdrawForm">
                <div class="col-md-6">
                  <div class="form-floating">
                    <select class="form-select" id="method" aria-label="method">
                      <option selected disabled>-- Please Select --</option>
					  <?php
						$methods = $db->QueryFetchArrayAll("SELECT * FROM `withdraw_methods` ORDER BY `minimum` ASC");
					  
						foreach($methods as $method)
						{
							echo '<option value="'.$method['id'].'"'.($coins_value < $method['minimum'] ? ' disabled' : '').'>'.$method['method'].' - Min: $'.$method['minimum'].'</option>';
						}
					  ?>
                    </select>
                    <label for="method">Payment Method</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="col-md-12">
                    <div class="form-floating">
                      <input type="number" class="form-control" id="amount" placeholder="Coins Amount" disabled>
                      <label for="amount">Coins Amount</label>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="col-md-12">
                    <div class="form-floating">
                      <textarea class="form-control" id="info" placeholder="Payment Info" disabled></textarea>
                      <label for="info" id="labelInfo">Payment Info</label>
                    </div>
                  </div>
                </div>
                <div class="col-md-8 mx-auto text-center" id="result">Please select your withdrawal method!</div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
		</div>
	  </div>
	</div>
	<div class="col-lg-12">
	  <div class="table-responsive card">
		<table class="table table-striped table-hover table-sm table-responsive-sm text-center m-0">
			<thead>
				<tr>
					<th>#</th>
					<th>Amount</th>
					<th>Method</th>
					<th>Status</th>
					<th>Date</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$requests = $db->QueryFetchArrayAll("SELECT * FROM `withdrawals` WHERE `user_id`='".$data['id']."' ORDER BY `id` DESC");
					
					if(count($requests) == 0)
					{
						echo '<td colspan="5"><center>There is nothing here yet!</center></td>';
					}
					else
					{
						foreach($requests as $request) 
						{
							echo '<tr><td>'.$request['id'].'</td><td><span class="badge bg-success">'.$request['coins'].' Coins - $'.$request['amount'].'</span></td><td>'.$request['method_name'].'</td><td>'.($request['status'] == 0 ? '<span class="spinner-border spinner-border-sm text-primary" title="Pending"></span>' : ($request['status'] == 1 ? '<i class="bi bi-patch-check-fill text-success" title="Sent"></i>' : ($request['status'] == 3 ? '<i class="bi bi-arrow-counterclockwise text-warning" data-toggle="tooltip" data-placement="top" title="Returned"></i>' : '<i class="bi bi-x-octagon-fill text-danger" data-toggle="tooltip" data-placement="top" title="Rejected: '.$request['reason'].'"></i>'))).'</td><td>'.date('d M Y - H:i', $request['time']).'</td></tr>';
						}
					}
					
					$total = $db->QueryFetchArray("SELECT COUNT(*) AS `total`, SUM(`amount`) AS `amount` FROM `withdrawals` WHERE `user_id`='".$data['id']."'");
				?>
			</tbody>
			<tfoot class="bg-info">
				<tr>
					<th colspan="3" class="text-start">Withdrawals: <?php echo number_format($total['total'], 0); ?></th>
					<th colspan="2" class="text-end">Worth: $<?php echo number_format($total['amount'], 2); ?></th>
				</tr>
			</tfoot>
		</table>
	  </div>
	</div>
  </div>
</section>
</main>
<?php
	$footer_js = '$(document).ready(function() {
	var minWithdraw = 0;
	$(document).on("change", "#method", function(b) {
		method = $(this).val();
		$.ajax({
			type: "GET",
			url: "system/ajax.php",
			data: {a: "getWithdraw", id: method},
			dataType: "json",
			success: function(a) {
				$("#info").attr("placeholder", a.payInfo);
				$("#labelInfo").html(a.payInfo);
				$("#info").removeAttr("disabled");
				$("#amount").removeAttr("disabled");
				$("#amount").val(a.min);
				$("#amount").attr("min", a.min);
				calculateAmount(a.min);
				minWithdraw = a.min;
			}
		});
	});
	
	function calculateAmount(amount)
	{
		$.ajax({
			type: "GET",
			url: "system/ajax.php",
			data: {a: "calculateWithdraw", amount: amount},
			success: function(a) {
				$("#result").html(a);
			}
		});
	}
	
	$(document).on("change", "#amount", function(b) {
		calculateAmount($(this).val());
	});

	$(document).on("submit", "#withdrawForm", function(e) {
		e.preventDefault();
		info = $("#info").val();
		method = $("#method").val();
		amount = $("#amount").val();
		$("#result").html(\'<div class="alert alert-info"><div class="spinner-border spinner-border-sm"></div> Please wait...</div>\');
		if (info == "" || method == "" || amount == "") {
			$("#result").html(\'<div class="alert alert-danger">Please complete all fields!</div>\');
		} else if (amount < minWithdraw) {
			$("#result").html(\'<div class="alert alert-danger">You should withdraw atleast \'+result+\' Coins!</div>\');
		} else {
			$.ajax({
				type: "POST",
				url: "system/ajax.php",
				data: {a: "sendWithdraw", method: method, amount: amount, info: info},
				dataType: "json",
				success: function(a) {
					$("#result").html(a.message);
				}
			});
		}
	});
});';
?>