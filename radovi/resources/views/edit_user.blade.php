@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit user</div>

                <h5 class="card-header">
                    <a href="{{ route('thesis.index') }}" class="btn btn-sm btn-outline-primary"><i class="fa fa-arrow-left"></i> Go back</a>
                </h5>

                <div class="card-body">
                    @if(session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                    @endif


                    <form method="POST" action="{{ route('update_user', $user->id) }}">
                        @csrf
                        @method('PUT')
                        <table class="table table-hover table-borderless">
                            <thead>
                                <th scope="col">Name</th>
                                <th scope="col">Is teacher</th>
                                <th scope="col">Is student</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>
                                        @if ($user->isTeacher)
                                        <input class="form-check-input" type="checkbox" name="isTeacher" id="isTeacher" value="{{ $user->isTeacher }}" checked>
                                        @else
                                        <input class="form-check-input" type="checkbox" name="isTeacher" id="isTeacher" value="{{ $user->isTeacher }}">
                                        @endif
                                    </td>
                                    <td>
                                        @if ($user->isStudent)
                                        <input class="form-check-input" type="checkbox" name="isStudent" id="isStudent" value="{{ $user->isStudent }}" checked>
                                        @else
                                        <input class="form-check-input" type="checkbox" name="isStudent" id="isStudent" value="{{ $user->isStudent }}">
                                        @endif
                                    </td>
                                </tr>

                            </tbody>
                        </table>
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