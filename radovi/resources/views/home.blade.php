@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <a href="{{ route('make_admin') }}" class="btn btn-sm btn-outline-primary">Make me admin</a>
        <div class="col-md-8">
            @if ($user->isAdmin)
            <div class="card">
                <div class="card-header">User list</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    @if(session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                    @endif

                    <table class="table table-hover table-borderless">
                        <thead>
                            <th scope="col">Name</th>
                            <th scope="col">Is teacher</th>
                            <th scope="col">Is student</th>
                            <th scope="col"></th>
                        </thead>
                        <tbody>
                            @forelse ($user_list as $us)
                            <tr>
                                <td>{{ $us->name }}</td>
                                <td>
                                    @if($us->isTeacher)
                                    Yes
                                    @else
                                    No
                                    @endif
                                </td>
                                <td>
                                    @if($us->isStudent)
                                    Yes
                                    @else
                                    No
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('edit_user', $us->id) }}" class="btn btn-sm btn-outline-success"><i class="fa fa-pencil-square-o"></i></a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td>Empty</td>
                            </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
            @endif

            @if ($user->isTeacher)
            <div class="card">
                <div class="card-header">Theses list</div>

                <h5 class="card-header">
                    <a href="{{ route('thesis.create') }}" class="btn btn-sm btn-outline-primary">Add thesis</a>
                </h5>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    @if(session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                    @endif

                    <table class="table table-hover table-borderless">
                        <thead>
                            <th scope="col">Croatian title</th>
                            <th scope="col">English title</th>
                            <th scope="col">Study type</th>
                            <th scope="col">Description</th>
                            <th scope="col"></th>
                        </thead>
                        <tbody>
                            @forelse ($theses as $thesis)
                            <tr>
                                <td>{{ $thesis->title_cro }} </td>
                                <td>{{ $thesis->title_eng }} </td>
                                <td>{{ $thesis->description }} </td>
                                <td>{{ $thesis->study_type }} </td>
                                <td>
                                    <a href="{{ route('thesis.edit', $thesis->id) }}" class="btn btn-sm btn-outline-success"><i class="fa fa-pencil-square-o"></i></a>
                                    <a href="{{ route('thesis.show', $thesis->id) }}" class="btn btn-sm btn-outline-danger"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td>Empty</td>
                            </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
            @endif

            @if ($user->isStudent)
            <div class="card">
                <div class="card-header">Applied theses list</div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    @if(session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                    @endif

                    <table class="table table-hover table-borderless">
                        <thead>
                            <th scope="col">Croatian title</th>
                            <th scope="col">English title</th>
                            <th scope="col">Study type</th>
                            <th scope="col">Description</th>
                            <th scope="col"></th>
                        </thead>
                        <tbody>
                            @forelse ($applied_theses as $thesis)
                            <tr>
                                <td>{{ $thesis->title_cro }} </td>
                                <td>{{ $thesis->title_eng }} </td>
                                <td>{{ $thesis->description }} </td>
                                <td>{{ $thesis->study_type }} </td>
                                <td>
                                    <a href="{{ route('delete_thesis_application', $thesis->id) }}" class="btn btn-sm btn-outline-danger">Remove</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td>Empty</td>
                            </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card">
                <div class="card-header">Available theses list</div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    @if(session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                    @endif

                    <table class="table table-hover table-borderless">
                        <thead>
                            <th scope="col">Croatian title</th>
                            <th scope="col">English title</th>
                            <th scope="col">Study type</th>
                            <th scope="col">Description</th>
                            <th scope="col"></th>
                        </thead>
                        <tbody>
                            @forelse ($not_applied_theses as $thesis)
                            <tr>
                                <td>{{ $thesis->title_cro }} </td>
                                <td>{{ $thesis->title_eng }} </td>
                                <td>{{ $thesis->description }} </td>
                                <td>{{ $thesis->study_type }} </td>
                                <td>
                                    <a href="{{ route('apply_thesis', $thesis->id) }}" class="btn btn-sm btn-outline-success">Apply</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td>Empty</td>
                            </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection