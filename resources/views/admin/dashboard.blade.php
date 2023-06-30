
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />

	<link rel="canonical" href="https://demo-basic.adminkit.io/" />

	<title>Admin Dashboard | SnapIt</title>
  	<link rel="stylesheet" href="https://unpkg.com/@adminkit/core@latest/dist/css/app.css">
  	<script src="https://unpkg.com/@adminkit/core@latest/dist/js/app.js"></script>
	<link href="css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
<!--Load the AJAX API-->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">

  // Load the Visualization API and the corechart package.
  google.charts.load('current', {'packages':['corechart']});

  // Set a callback to run when the Google Visualization API is loaded.
  google.charts.setOnLoadCallback(drawChart);

  // Callback that creates and populates a data table,
  // instantiates the pie chart, passes in the data and
  // draws it.
  function drawChart() {

	// Create the data table.
	var data = new google.visualization.DataTable();
	data.addColumn('string', 'Stages');
	data.addColumn('number', 'Total');
	data.addRows([
	  <?php echo $chartdata?>
	]);

	// Set chart options
	var options = {chartArea: {width: 400, height: 300}};

	// Instantiate and draw our chart, passing in some options.
	var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
	chart.draw(data, options);
  }
</script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
  google.charts.load('current', {'packages':['bar']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
	var data = google.visualization.arrayToDataTable([
	  ['Name', 'Opportunities'],
	  <?php echo $chartdata2?>
	]);

	var options = {
	  chart: {
		
		
	  }
	};

	var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

	chart.draw(data, google.charts.Bar.convertOptions(options));
  }
</script>
</head>

<body>
	<div class="wrapper">
		<nav id="sidebar" class="sidebar js-sidebar">
				<div class="sidebar-content js-simplebar">
					<a class="sidebar-brand" href="{{route('admin.dashboard')}}">
			<span class="align-middle">SnapIt</span>
			</a>

					<ul class="sidebar-nav">
						<li class="sidebar-header">
							Pages
						</li>

						<li class="sidebar-item active">
							<a class="sidebar-link" href="{{route('admin.dashboard')}}">
				<i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
				</a>
						</li>

						<li class="sidebar-item">
							<a class="sidebar-link" href="{{route('admin.opportunity')}}">
				<i class="align-middle" data-feather="square"></i> <span class="align-middle">Opportunity</span>
				</a>
						</li>

						<li class="sidebar-header">
							Tools & Components
						</li>

						<li class="sidebar-item">
							<a class="sidebar-link" href="{{route('admin.users')}}">
				<i class="align-middle" data-feather="user"></i> <span class="align-middle">User Management</span>
				</a>
						</li>
						
						<li class="sidebar-header">
							Reports
						</li>
						

						<li class="sidebar-item">
							<a class="sidebar-link" href="{{route('admin.reports')}}">
				<i class="align-middle" data-feather="bar-chart-2"></i> <span class="align-middle">Charts</span>
				</a>
						</li>

						
					</ul>
				</div>
		</nav>

		<div class="main">
			<nav class="navbar navbar-expand navbar-light navbar-bg">
				<a class="sidebar-toggle js-sidebar-toggle">
          <i class="hamburger align-self-center"></i>
        </a>

				<div class="navbar-collapse collapse">
					<ul class="navbar-nav navbar-align">
						
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('admin.logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
					</ul>
				</div>
			</nav>

			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3"><strong>Analytics</strong> Dashboard</h1>

					<div class="row">
						<div class="col-12 d-flex">
							<div class="w-100">
								<div class="row">
									<div class="col-sm-4">
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Total Opportunities</h5>
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
															<i class="align-middle" data-feather="users"></i>
														</div>
													</div>
												</div>
												<h1 class="mt-1 mb-3">{{$opportunities->count()}}</h1>
												<div class="mb-0">
													<span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i> 5.25% </span>
													<span class="text-muted">Since last week</span>
												</div>
											</div>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Total Business in Pipeline</h5>
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
															<i class="align-middle" data-feather="dollar-sign"></i>
														</div>
													</div>
												</div>
												<h1 class="mt-1 mb-3">{{$business->count()}}</h1>
												<div class="mb-0">
													<span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i> 6.65% </span>
													<span class="text-muted">Since last week</span>
												</div>
											</div>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="card">
										<div class="card-body">
											<div class="row">
												<div class="col mt-0">
													<h5 class="card-title">Total Deal Loss</h5>
												</div>

												<div class="col-auto">
													<div class="stat text-primary">
														<i class="align-middle" data-feather="shopping-cart"></i>
													</div>
												</div>
											</div>
											<h1 class="mt-1 mb-3">{{$zero->count()}}</h1>
											<div class="mb-0">
												<span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> -2.25% </span>
												<span class="text-muted">Since last week</span>
											</div>
										</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-12 d-flex">
							<div class="w-100">
								<div class="row">
									<div class="col-xl-6 col-xxl-6">
										<div class="card flex-fill w-100">
											<div class="card-header">
												<h5 class="card-title mb-0">Recent Deals</h5>
											</div>
											<div class="card-body py-3">
												<div id="chart_div"></div>
											</div>
										</div>
									</div>
									<div class="col-xl-6 col-xxl-6">
										<div class="card flex-fill w-100">
											<div class="card-header">

												<h5 class="card-title mb-0">Sales Performance</h5>
											</div>
											<div class="card-body d-flex w-100">
												<div id="columnchart_material"></div>
											</div>
							</div>
						</div>
					</div>

				</div>
			</main>

			<footer class="footer">
				<div class="container-fluid">
					<div class="row text-muted">
						<div class="col-6 text-start">
							<p class="mb-0">
								<a class="text-muted" href="https://adminkit.io/" target="_blank"><strong>SnapIt</strong></a> 
							</p>
						</div>
					</div>
				</div>
			</footer>
		</div>
	</div>

	<script src="js/app.js"></script>

</body>

</html>
