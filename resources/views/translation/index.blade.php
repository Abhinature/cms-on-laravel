@extends('layouts.admin.app')

@section('content')
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0">Website Content</h1>
			</div>
			<!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item active">Dashboard / Website Content</li>
				</ol>
			</div>
			<!-- /.col -->
		</div>
		<!-- /.row -->
	</div>
	<!-- /.container-fluid -->
</div>
<div class="container-fluid py-4">
	<div class="row">
		<div class="col-sm-12">
			{!! displayAlert() !!}
		</div>
	</div>
	<div class="card mb-4">
		<div class="card-body">
			<!----------------------------------------->
			<div id="America" class="tabcontent">
				<h3>Translation</h3>
				<form>
					<div class="row mt-2 p-1">
						<div class="col-md-12">
							<div style="float:right">
								<a href="{{ route('translation.add') }}" class="btn btn-primary">Add More</a>
							</div>
						</div>
						<div class="col-md-12">
							<div class="card bgcard p-2">
								<div class="col-md-12">
									<div class="table-responsive">
										<table class="table table-stripped">
											{!! $dataTable->table() !!}
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
			<!----------------------------------------->
		</div>
	</div>
</div>
@endsection
@push('script')
{{ $dataTable->scripts() }}
@endpush 