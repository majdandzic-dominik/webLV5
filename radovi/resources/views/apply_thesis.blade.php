@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Apply for thesis</div>

                <h5 class="card-header">
                    <a href="{{ route('thesis.index') }}" class="btn btn-sm btn-outline-primary"><i class="fa fa-arrow-left"></i> Go back</a>
                </h5>

                <div class="card-body">


                    <form method="POST" action="{{ route('confirm_thesis_application', $thesis->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <h4>Are you sure you want to apply for this thesis?</h4>
                            </div>
                        </div>
                            
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-danger">
                                    Yes
                                </button>
                                <a href="{{ route('thesis.index') }}" class="btn btn-info">No</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection