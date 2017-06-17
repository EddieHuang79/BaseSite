@include('webbase.header')
@include('webbase.nav')
<div id="content" class="container-fluid col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	<div id="main">
		@include('webbase.menu')
		@include('webbase.search_tool')
		@include($assign_page)
	</div>		
</div>
@include('webbase.footer')