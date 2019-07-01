<table class="highlight responsive-table " >
    <thead class="">
        <tr>
            <th><b>{!! trans('manage_users.index.table.name') !!}</b></th>
            <th><b>{!! trans('manage_users.index.table.roles') !!}</b></th>
            <th><b>{!! trans('manage_users.index.table.email') !!}</b></th>
            <th class="center-align"><b>{!! trans('manage_users.index.table.edit') !!}</b></th>
            <th class="center-align"><b>{!! trans('manage_users.index.table.delete') !!}</b></th>
        </tr>
    </thead>

    <tbody class="" v-if= "filtered_list.length > 0" >
            <tr class="" v-for="user in filtered_list">
                <td class="">
                    @{{ user.full_name }}
                </td>

                <td class="">
					<span v-if = "user.roles.length > 0">
						<span v-for = "role in user.roles" > @{{role.label}}<br> </span>
					</span>
                    <span v-else >cliente</span>
                </td>

                <td class="">
					@{{user.email}}
				</td>

                <td class="center-align">
                    <a href="{{ route( 'admin::users.edit', ['user' =>'&#123;&#123;user.id&#125;&#125;'] ) }}" class="btn-floating btn-icon">
                        <i class="material-icons waves-effect waves-light " >mode_edit</i>
                    </a>
                </td>


                <td class="center-align">

                    {!! Form::open([
                        'method'             => 'delete',
                        'route'              => ['admin::users.destroy','user' =>'&#123;&#123;user.id&#125;&#125;'],
                        'role'               => 'form' ,
                        'id'                 => 'delete_user-&#123;&#123;user.id&#125;&#125;_form',
                        'class'              => '',
						'v-if'				 => 'user.id != '.$user->id
                    ]) !!}

                        <button type="submit" class=" btn-floating waves-effect waves-light red" form ="delete_user-&#123;&#123;user.id&#125;&#125;_form">
                            <i class="material-icons">delete</i>
                        </button>
                    {{ Form::close() }}

                </td>

            </tr>
    </tbody>

	<tbody v-if= "filtered_list.length == 0"  >
		<tr>
			<td colspan=5 class="center-align">
				{!! trans('manage_users.index.table.empty') !!}
			</td>
		</tr>
	</tbody>

</table>
