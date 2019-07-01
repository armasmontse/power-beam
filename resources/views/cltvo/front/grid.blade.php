@extends('layouts.client')
@section('content')
<style>
	header, footer {display: none;}
</style>
<div class="debug">
	<h1>.grid__row</h1>
	<div class="grid__row"></div>

	<h1>.grid__container</h1>
	<div class="grid__container"></div>

	<div class="grid__row">
		<h1>.grid__col-1-6</h1>

		<div class="grid__container">
			<div class="grid__col-1-6">1</div>
			<div class="grid__col-1-6">2</div>
			<div class="grid__col-1-6">3</div>
			<div class="grid__col-1-6">4</div>
			<div class="grid__col-1-6">5</div>
			<div class="grid__col-1-6">6</div>
		</div>

		<h1>.grid__col-1-4</h1>
		<div class="grid__container">
			<div class="grid__col-1-4">

			</div>
		</div>

		<h1>.grid__col-1-3</h1>
		<div class="grid__container">
			<div class="grid__col-1-3"></div>
			<div class="grid__col-1-3"></div>
			<div class="grid__col-1-3"></div>
		</div>

		<h1>.grid__col-1-2</h1>
		<div class="grid__container">
			<div class="grid__col-1-6">1</div>
			<div class="grid__col-1-2"></div>
			<div class="grid__col-1-2"></div>
			<div class="grid__col-1-6">1</div>
		</div>
	</div>

</div>
@endsection
