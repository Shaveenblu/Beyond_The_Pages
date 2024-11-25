@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Users Management</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success mb-2" href="{{ route('users.create') }}"><i class="fa fa-plus"></i> Create New User</a>
            </div>
        </div>
    </div>

    @session('success')
    <div class="alert alert-success" role="alert">
        {{ $value }}
    </div>
    @endsession

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Email</th>
            <th>Roles</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($data as $key => $user)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @if(!empty($user->getRoleNames()))
                        @foreach($user->getRoleNames() as $v)
                            <label class="badge bg-success">{{ $v }}</label>
                        @endforeach
                    @endif
                </td>
                <td>
                    <a class="btn btn-info btn-sm" href="{{ route('users.show',$user->id) }}"><i class="fa-solid fa-list"></i> Show</a>
                    <a class="btn btn-primary btn-sm" href="{{ route('users.edit',$user->id) }}"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                    <form method="POST" action="{{ route('users.destroy', $user->id) }}" style="display:inline">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteUser{{ $user->id }}"><i class="fa-solid fa-trash"></i> Delete</button>
                    </form>
                </td>

                <!-- Delete popup -->
                <div class="modal fade" id="deleteUser{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteUserLabel{{ $user->id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteUserLabel{{ $user->id }}">Confirm Delete</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete this user?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                    <form method="post" action="{{ route('users.destroy', ['user' => $user]) }}" style="display: inline;">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger rounded-[10px]">Delete</button>
                                    </form>

                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="successModalLabel">User Deleted</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    The User has been successfully deleted.
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary rounded-[10px]" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </tr>
        @endforeach
    </table>

    {!! $data->links('pagination::bootstrap-5') !!}

@endsection
