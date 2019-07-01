@extends('layouts.modal', ["modal_id" => "projects-modal-reject-quote"])

@section('modal-title')
    Thanks for contributing with us
@overwrite

@section('modal-content')
    <form action="{{ route('user::projects.quotes.reject', ['user' => $project->user, 'user_project' => $project, 'quote' => $quote]) }}" method="POST" style="margin: 0 10px;">
    	{{ csrf_field() }}
		{{ method_field('PATCH') }}
		<div class="">
			<label for="" class="" style="display: inline-block; margin-bottom: 10px;">
				We would like to know the reasons why you decided not to
				produce the project. Thank you very much for your answer.
			</label>
			<textarea name="feedback" id="" cols="30" rows="10" placeholder="Your message here..." style="padding: 10px;"></textarea>
		</div>
		<br>
    	<div style="text-align: right;">
    		<input class="btn" style="width: auto; background-color: #DC3847; display: inline-block;" type="submit" value="Send feedback">
    	</div>
    </form>
@overwrite
