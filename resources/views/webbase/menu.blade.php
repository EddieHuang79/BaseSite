@section('menu')
<div id="menu" class="col-sm-3 col-md-2 sidebar">
	<ul class="nav nav-sidebar">
		@foreach($service_list as $row)
			<li class="parents_li">
				@if(!empty($row['child']))
				<a href="#">{{ $row['name'] }}<span class="caret"></span></a>
				<ul class="nav nav-sidebar sub-nav">
					@foreach($row['child'] as $child)
					<li><a href="{{ $child['link'] }}?service_id={{ $child['id'] }}" page="page{{ $child['id'] }}">{{ $child['name'] }}</a></li>
					@endforeach
				</ul>
				@else
				<a href="{{ $row['link'] }}?service_id={{ $row['id'] }}" page="page{{ $row['id'] }}">{{ $row['name'] }}</a>
				@endif
			</li>				
		@endforeach
	</ul>
	<input type="hidden" class="service_id" value="{{ $service_id }}">
</div>
@show