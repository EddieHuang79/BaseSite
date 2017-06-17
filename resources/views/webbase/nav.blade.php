<nav class="navbar navbar-inverse navbar-fixed-top">
	<div class="container-fluid">
		<div class="navbar-header"><a href="#" class="navbar-brand">{{ $txt['Site'] }}</a></div>
		<div class="navbar-collapse collapse" id="navbar">
			<ul class="nav navbar-nav navbar-right">
				<li><a href="#">{{ $user['real_name'] }}</a></li>
				<li><a href="/logout">{{ $txt['logout'] }}</a></li>
			</ul>
		</div>
	</div>
</nav>