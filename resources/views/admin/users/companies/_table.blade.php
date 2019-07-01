<div class="col s10 offset-s1">

    <table class="highlight responsive-table ">
        <thead class="">
            <tr>
                <th><b>{!! trans('manage_companies.index.table.name') !!}</b></th>
                <th class="col-button" ><b>{!! trans('manage_companies.index.table.edit') !!}</b></th>
                <th class="col-button"><b>{!! trans('manage_companies.index.table.delete') !!}</b></th>
            </tr>
        </thead>

        <tbody class="">
            <tr class="" v-for="company in filtered_list">
                <td class="categoriestable__name" >
                    @{{company.name}}
                </td>

                <td class="col-button">

                    <span {{--v-if="company.deletable"--}}
                        data-target="companies-modal-edit"
                        {{-- data-index="@{{$index}}" --}}
                        class=" btn-floating waves-effect waves-light categoriestable__edit--button  "
                        @click="openModal('#companies-modal-edit' ,$index)">
                        <i class="material-icons waves-effect waves-light">mode_edit</i>
                    </span>
                </td>

                <td class="col-button">
                    {!! Form::open([
                        'method'                => 'DELETE',
                        'route'                 => ['admin::companies.ajax.destroy','&#123;&#123;company.id&#125;&#125;'],
                        'role'                  => 'form' ,
                        'id'                    => 'delete_company-&#123;&#123;company.id&#125;&#125;_form',
                        'class'                 => '',
                        'data-index'            => '&#123;&#123;$index&#125;&#125;',
                        'v-on:submit.prevent'   => 'post',
                        //'v-if'                  => "ally.is_deletable"
                    ]) !!}
                        <button type="submit" class=" btn-floating waves-effect waves-light red darken-1 categoriestable__edit--button" form ="delete_company-&#123;&#123;company.id&#125;&#125;_form">
                            <i class="material-icons">delete</i>
                        </button>
                    {!!Form::close()!!}
                </td>

            </tr>
        </tbody>
    </table>
</div>
