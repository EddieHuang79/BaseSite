<h2 class="sub-header">{{ $txt["admin_user_input"] }}</h2>
<div id="table-responsive">
	<form action="/user" method="POST">
		<table class="table table-stroped">
			<tbody>
				<tr>
					<th>{{ $txt["account"] }}</th>
					<td>
						@if(!empty($user))
						{{ $user->account }}
						<input type="hidden" name="user_id" value="{{ $user->id }}">
						@else
						<input type="text" name="account" value=""/>
						@endif</td>
				</tr>
				<tr>
					<th>{{ $txt["password"] }}</th>
					<td><input type="password" name="password" value=""/></td>
				</tr>
				<tr>
					<th>{{ $txt["real_name"] }}</th>
					<td><input type="text" name="real_name" value="@if(!empty($user->real_name)){{ $user->real_name }}@endif"/></td>
				</tr>
				<tr>
					<th>{{ $txt["telephone"] }}</th>
					<td><input type="text" name="mobile" value="@if(!empty($user->mobile)){{ $user->mobile }}@endif"/></td>
				</tr>
				<tr>
					<th>{{ $txt["auth"] }}</th>
					<td>
						@foreach($role_list as $row)
						<input type="checkbox" value="{{ $row->id }}" name="auth[]" @if( isset($user_role) && in_array( $row->id, $user_role ) ) checked @endif ) /> {{ $row->name }} <br />
						@endforeach	
					</td>
				</tr>
				<tr>
					<th>{{ $txt["status"] }}</th>
					<td>
						<input type="radio" value="1" name="active" @if( !empty($user) && $user->status == 1 ) checked  @endif />{{ $txt["enable"] }}
						<input type="radio" value="2" name="active" @if( !empty($user) && $user->status == 2 ) checked  @endif />{{ $txt["disable"] }}
					</td>
				</tr>
				<tr>
					<th colspan="2"><input type="submit" value="{{ $txt['send'] }}"/></th>
				</tr>															
			</tbody>
		</table>
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
	</form>
</div>