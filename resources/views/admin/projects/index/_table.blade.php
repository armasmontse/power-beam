<table class="bordered highlight responsive-table ">
    <thead class="">
        <tr>
			<th>{!! trans('manage_projects.index.table.name') !!} </th>
			<th>{!! trans('manage_projects.index.table.code') !!} </th>
            <th>{!! trans('manage_projects.index.table.user') !!}</th>
            <th>{!! trans('manage_projects.index.table.manager') !!}</th>
            <th>{!! trans('manage_projects.index.table.status') !!}</th>
            <th>{!! trans('manage_projects.index.table.updated_at') !!}</th>
            <th>{!! trans('manage_projects.index.table.show') !!}</th>
            <th>{!! trans('manage_projects.index.table.edit') !!}</th>
        </tr>
    </thead>

    <tbody class="">
        <tr class="" v-for="project in filtered_list">
            <td>
                <span v-text="project.name"></span>
			</td>
			<td>
                <span v-text="project.code"></span>
            </td>
            <td>
                <span v-text="project.user.full_name"></span>
            </td>
            <td>
                <span v-if="!project.manager_id" style="color:red;">SIN ASIGNAR</span>
                <span v-else v-text="project.manager.full_name"></span>
            </td>
            <td>
                <span v-text="project.status.label"></span>
            </td>
            <td>
                <span v-text="project.updated_at"></span>
            </td>
            <td>
                <a :href="project.admin_show_url" class="btn-floating btn-creel">
                    <i class="material-icons waves-effect waves-light">remove_red_eye</i>
                </a>
            </td>
            <td>
                <a :href="project.admin_edit_url" class="btn-floating btn-creel">
                    <i class="material-icons waves-effect waves-light">mode_edit</i>
                </a>
            </td>
        </tr>
    </tbody>
</table>
