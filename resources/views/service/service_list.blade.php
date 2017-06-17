<h2 class="sub-header">{{ $txt['service_list'] }}</h2>
<div id="table-responsive">
	<table class="table table-stroped">
		<thead>
			<tr>
				<th>{{ $txt['service_name'] }}</th>
				<th>{{ $txt['link'] }}</th>
				<th>{{ $txt['parents_service'] }}</th>
				<th>{{ $txt['auth'] }}</th>
				<th>{{ $txt['status'] }}</th>
				<th>{{ $txt['sort'] }}</th>
				<th>{{ $txt['action'] }}</th>
			</tr>							
		</thead>
		<tbody>
			@foreach($service as $row)
				<tr>
					<th>{{ $row->name }}</th>
					<td>{{ $row->link }}</td>
					<td>{{ $row->parents_service }}</td>
					<td>@foreach($row->auth as $role) {{$role}} <br /> @endforeach </td>
					<td>{{ $active_to_text[$row->status] }}</td>
					<td>{{ $row->sort }}</td>
					<td><input type="button" value="{{ $txt['edit'] }}" onClick="location.href='/service/{{ $row->id }}/edit?';"/></td>
				</tr>
			@endforeach													
		</tbody>
	</table>
	{{ $service->links() }}
</div>