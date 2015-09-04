<!DOCTYPE html>
<html lang="nl">
  	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<meta name="description" content="Pitch, Hit & Run - Score systeem voor Giants Hengelo">
		<meta name="author" content="Niels Witte">

		<title>Pitch, Hit & Run</title>

		<link rel="icon" href="favicon.ico">

		<!-- Bootstrap core CSS -->
		<link href="css/bootstrap.css" rel="stylesheet">
		<link href="css/select.css" rel="stylesheet">
		<link href="css/main.css" rel="stylesheet">

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		<script>
			var baseUrl = '<?php echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>';
		</script>
	</head>
	<body ng-app="giantsApp">
		<div class="container">
			<!-- Static navbar -->
			<nav class="navbar navbar-inverse" role="navigation" bs-navbar>
				<div class="container-fluid">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="#/">
							Pitch, Hit & Run
						</a>
					</div>
					<div id="navbar" class="navbar-collapse collapse">
						<ul class="nav navbar-nav">
							<li data-match-route="^/users"><a href="#/users">Deelnemers</a></li>
							<li data-match-route="^/scores"><a href="#/scores">Scores</a></li>
							<li data-match-route="^/results"><a href="#/results">Uitslagen</a></li>
						</ul>

						<ul class="nav navbar-nav navbar-right">
							<li class="dropdown" data-match-route="^/settings">
								<a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Instellingen <span class="caret"></span></a>
								<ul class="dropdown-menu">
									<li><a href="#/settings/categories">Categorieën</a></li>
									<li><a href="#/settings/sections">Onderdelen</a></li>
								</ul>
							</li>
						</ul>
					</div><!--/.nav-collapse -->
				</div><!--/.container-fluid -->
			</nav>

			<div id="alerts-container"></div>

			<ol class="ab-nav breadcrumb" ng-controller="BreadcrumbCtrl">
				<li ng-repeat="breadcrumb in breadcrumbs.get() track by breadcrumb.path" ng-class="{ active: $last }">
					<a ng-if="!$last" ng-href="#{{ breadcrumb.path }}" ng-bind="breadcrumb.label" class="margin-right-xs"></a>
					<span ng-if="$last" ng-bind="breadcrumb.label"></span>
				</li>
			</ol>

			<div ng-view=""></div>
		</div> <!-- /container -->


		<!-- Bootstrap core JavaScript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="js/libs/jquery.js"></script>
		<script src="js/libs/bootstrap.js"></script>
		<script src="js/libs/lodash.js"></script>
		<script src="js/libs/angularjs/angularjs.js"></script>
		<script src="js/libs/angularjs/angular-animate.js"></script>
		<script src="js/libs/angularjs/angular-resource.js"></script>
		<script src="js/libs/angularjs/angular-route.js"></script>
		<script src="js/libs/angularjs/angular-sanitize.js"></script>
		<script src="js/libs/angularjs/angular-touch.js"></script>
		<script src="js/libs/angularjs/angular-locale_nl.js"></script>
		<script src="js/libs/ng-breadcrumbs.js"></script>
		<script src="js/libs/select.js"></script>
		<script src="js/libs/restangular.js"></script>
		<script src="js/libs/angular-strap.js"></script>
		<script src="js/libs/angular-strap.tpl.js"></script>
		<script src="js/app.js"></script>

		<!-- Directives -->
		<script src="js/directives/sorting.js"></script>

		<!-- Controllers -->
		<script src="js/controllers/breadcrumb.js"></script>
		<script src="js/controllers/categories.js"></script>
		<script src="js/controllers/main.js"></script>
		<script src="js/controllers/results.js"></script>
		<script src="js/controllers/scores.js"></script>
		<script src="js/controllers/sections.js"></script>
		<script src="js/controllers/users.js"></script>

		<script src="js/controllers/modals/category.js"></script>
		<script src="js/controllers/modals/score.js"></script>
		<script src="js/controllers/modals/section.js"></script>
		<script src="js/controllers/modals/user.js"></script>
	</body>
</html>
