@extends('layouts.app')

@section('content')
<div class="container-fluid">

    @if($message = Session::get('error'))
        @include('components.alert', ['message'=>$message, 'color'=>'danger'])
    @elseif($message = Session::get('success'))
        @include('components.alert', ['message'=>$message, 'color'=>'success'])
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">{{ ucfirst('user') }}</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-dark table-hover table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Timestamp</td>
                            <td>Nama</td>
                            <td>Role</td>
                            <td>Username</td>
                            <td>Status</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->created_at }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->role->name }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->is_active }}</td>
                            <td>
                                <button type="button" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#edit{{ $user->id }}">
                                    @include('components.icon', ['icon' => 'edit '])
                                    Edit
                                </button>
                                <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#delete{{ $user->id }}">
                                    @include('components.icon', ['icon' => 'trash '])
                                    Hapus
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#create">
                @include('components.icon', ['icon' => 'plus '])
                Tambah
            </button>
        </div>
    </div>
</div>

<div class="modal fade" id="create" tabindex="-1" user="dialog" aria-labelledby="createLabel" aria-hidden="true">
    <div class="modal-dialog" user="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createLabel">Tambah {{ ucfirst('user') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">

                <form method="POST" action="{{ route('users.store') }}" class="text-dark">
                @csrf
                @method('POST')

                <div class="form-group row">
                    <label for="role_id" class="col-sm-2 col-form-label">Role</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="role_id">
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">
                                    {{ $role->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                @include('components.input',[
                    'label' => 'Nama',
                    'name' => 'name',
                    'type' => 'text',
                    'value' => '',
                    'modifier' => 'required',
                ])

                @include('components.input',[
                    'label' => 'Username',
                    'name' => 'username',
                    'type' => 'text',
                    'value' => '',
                    'modifier' => 'required',
                ])

                @include('components.input',[
                    'label' => 'Password',
                    'name' => 'password',
                    'type' => 'password',
                    'value' => '',
                    'modifier' => 'required',
                ])

                @include('components.input',[
                    'label' => 'ID Card',
                    'name' => 'hmi_access',
                    'type' => 'password',
                    'value' => '',
                    'modifier' => '',
                ])

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save
                    @include('components.icon', ['icon' => 'save'])
                </button>
                </form>
            </div>
        </div>
    </div>
</div>

@foreach($users as $user)
<div class="modal fade" id="edit{{ $user->id }}" tabindex="-1" user="dialog" aria-labelledby="edit{{ $user->id }}Label" aria-hidden="true">
    <div class="modal-dialog" user="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit{{ $user->id }}Label">Edit {{ ucfirst('user') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">

                <form method="POST" action="{{ route('users.update', $user->id) }}" class="text-dark">
                @csrf
                @method('PUT')

                <div class="form-group row">
                    <label for="is_active" class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="is_active">
                            @if($user->is_active == 1)
                                <option {{ 'selected' }} value="1">Active</option>
                                <option value="0">Non-Active</option>
                            @else
                                <option {{ 'selected' }} value="0">Non-Active</option>
                                <option value="1">Aktif</option>
                            @endif
                          </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="role_id" class="col-sm-2 col-form-label">Role</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="role_id">
                            @foreach ($roles as $role)
                                <option
                                @if($user->role_id == $role->id)
                                {{ 'selected' }}
                                @endif
                                value="{{ $role->id }}">
                                {{ $role->id }} | {{ $role->name }}
                                </option>
                            @endforeach
                          </select>
                    </div>
                </div>

                @include('components.input',[
                    'label' => 'Nama',
                    'name' => 'name',
                    'type' => 'text',
                    'value' => $user->name,
                    'modifier' => 'required',
                ])

                @include('components.input',[
                    'label' => 'Username',
                    'name' => 'username',
                    'type' => 'text',
                    'value' => $user->username,
                    'modifier' => 'required',
                ])

                @include('components.input',[
                    'label' => 'Password',
                    'name' => 'password',
                    'type' => 'password',
                    'value' => '',
                    'modifier' => 'required',
                ])

                @include('components.input',[
                    'label' => 'ID Card',
                    'name' => 'hmi_access',
                    'type' => 'password',
                    'value' => $user->hmi_access,
                    'modifier' => '',
                ])

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save
                    @include('components.icon', ['icon' => 'edit'])
                </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

@foreach($users as $user)
<div class="modal fade" id="delete{{ $user->id }}" tabindex="-1" user="dialog" aria-labelledby="delete{{ $user->id }}Label" aria-hidden="true">
    <div class="modal-dialog" user="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="delete{{ $user->id }}Label">Hapus {{ ucfirst('user') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
            <form method="POST" action="{{ route('users.destroy', $user->id) }}" class="text-dark">
                @csrf
                @method('DELETE')
                <p>Apakah Anda yakin ?</p>

                @include('components.input',[
                    'label' => 'Nama',
                    'name' => 'name',
                    'type' => 'text',
                    'value' => $user->name,
                    'modifier' => 'readonly',
                ])
                <input type="hidden" name="user_id" value="{{ $user->user_id }}">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                <button type="submit" class="btn btn-primary">Yes
                    @include('components.icon', ['icon' => 'trash'])
                </button>
            </form>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection

