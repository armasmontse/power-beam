<table class="highlight responsive-table projectsTable">
    <thead class="">
        <tr>
            <th>
                <b>Project Name</b>
            </th>
            <th>
                <b>Code</b>
            </th>
            <th class="center-align">
                <b>Last quote</b>
            </th>
            <th>
                <b>Status</b>
            </th>
            <th class="center-align">
                <b>Final delivery</b>
            </th>
            <th class="">
                <b>Creation date</b>
            </th>
            <th class="center-align">
                <b>View</b>
            </th>
            <th class="center-align">
                <b>Delete</b>
            </th>
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
            <td class="center-align">
                <a v-if="project.last_quote" :href="project.last_quote.file.url"><i class="material-icons">file_download</i></a>
            </td>
            <td>
                <span v-text="project.status.label"></span>
            </td>
            <td class="center-align">
                <a v-if="project.output_file" :href="project.output_file.url"><i class="material-icons">file_download</i></a>
            </td>
            <td>
                <span v-text="project.created_at"></span>
            </td>
	        <td class="center-align">
                <a :href="project.show_url">
                    <i class="material-icons">visibility</i>
                </a>
            </td>
            <td class="center-align col-button">
                {!! Form::open([
                    'method'                => 'DELETE',
                    'route'                 => ['user::projects.destroy', 'user'=>$user->name, 'user_project' => '&#123;&#123;project.slug&#125;&#125;'],
                    'role'                  => 'form',
                    'id'                    => 'delete_project-&#123;&#123;project.id&#125;&#125;_form',
                    'class'                 => '',
                    'data-index'            => '&#123;&#123;$index&#125;&#125;',
                    'v-if'                  => "project.is_deletable"
                ]) !!}
                    <button type="submit" class="btn-floating waves-effect waves-light" form ="delete_project-&#123;&#123;project.id&#125;&#125;_form">
                        <i class="material-icons">delete</i>
                    </button>
                {!!Form::close()!!}
            </td>
        </tr>
    </tbody>
</table>
