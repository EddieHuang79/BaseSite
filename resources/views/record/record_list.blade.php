<h2 class="sub-header">{{ $txt['record_list'] }}</h2>
<div id="table-responsive">
	@foreach($show_error as $row)
	<h5>{{ $row }}</h5>
	@endforeach

	@if(empty($show_error))
	No Data
	@endif
</div>