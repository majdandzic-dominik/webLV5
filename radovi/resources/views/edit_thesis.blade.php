@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit thesis</div>

                <h5 class="card-header">
                    <a href="{{ route('thesis.index') }}" class="btn btn-sm btn-outline-primary"><i class="fa fa-arrow-left"></i> Go back</a>
                </h5>

                <div class="card-body">

                    @if(session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                    @endif

                    <form method="POST" action="{{ route('thesis.update', $thesis->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label for="title_cro" class="col-form-label text-md-right">Croatian title</label>

                            <input id="title_cro" type="title" class="form-control @error('title') is-invalid @enderror" name="title_cro" value="{{ $thesis->title_cro }}" required autocomplete="title" autofocus>

                            @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="title_eng" class="col-form-label text-md-right">English title</label>

                            <input id="title_eng" type="title" class="form-control @error('title') is-invalid @enderror" name="title_eng" value="{{ $thesis->title_eng }}" required autocomplete="title">

                            @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-form-label text-md-right">Description</label>

                            <textarea name="description" id="description" cols="30" rows="10" class="form-control @error('password') is-invalid @enderror" required autocomplete="description" value="{{ $thesis->description }}">{{ $thesis->description }}</textarea>

                            @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="study_type" class="col-form-label text-md-right">Study type</label>

                            <input id="study_type" type="study_type" class="form-control @error('study_type') is-invalid @enderror" name="study_type" value="{{ $thesis->study_type }}" required autocomplete="study_type">

                            @error('study_type')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection