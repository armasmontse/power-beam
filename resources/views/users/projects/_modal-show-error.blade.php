<div id="projects-modal-show-error" class="modal">
    <div class="" role="document">
        <div class="modal-content">
            <div class="modal__header">
                <div class="row">
                    <div class="col s11">
                        <h5 class="">Hello</h5>
                    </div>
                    <div class="col s1">
                        @include('admin.general.modals.partials._header')
                    </div>
                </div>
            </div>
            <div class="modal__body">
                <div class="row">
                    <div class="col s12">
                        <p v-text="store.project.error"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<form action="{{ route('user::projects.errorReaded', ['user' => $user, 'user_project' => $project]) }}" id="read-at-form">
	{{ csrf_field() }}
	{{ method_field('PATCH') }}
</form>