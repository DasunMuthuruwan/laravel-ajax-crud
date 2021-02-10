@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- Success message -->
        @if(Session::has('success'))
            <div class="alert alert-success">
                {{Session::get('success')}}
            </div>
        @endif

        <div class="d-flex bd-highlight mb-4">
            <div class="p-2 w-100 bd-highlight">
                <h3>Laravel AJAX Example</h3>
            </div>
            <div class="p-2 w-100 bd-highlight">
                <div class="form-group">
                    <input type="text" name="title1" id="title1" placeholder="Enter title" class="form-control">
                </div>
                <div id="title_list"></div>
            </div>
            <div class="p-2 flex-shrink-0 bd-highlight">
                <button class="btn btn-success" id="btn-add">
                    Add Todo
                </button>
            </div>
        </div>

        <div>
            <table class="table table-inverse">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Update/Delete</th>
                    </tr>
                </thead>
                <tbody id="todos-list" name="todos-list">
                    @foreach ($todo as $data)
                    <tr id="todo{{$data->id}}">
                        <td>{{$data->id}}</td>
                        <td>{{$data->title}}</td>
                        <td>{{$data->description}}</td>
                        <td>
                            <button class="btn btn-info open-modal" value="{{$data->id}}">Edit
                            </button>
                            <button class="btn btn-danger delete-link" value="{{$data->id}}">Delete
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="modal fade" id="formModal" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="formModalLabel">Create Todo</h4>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-danger" style="display:none"></div>
                            <form id="myForm" name="myForm" class="form-horizontal" novalidate="">
                                @csrf
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" class="form-control {{ $errors->has('title') ? 'error' : '' }}" id="title" name="title"
                                            placeholder="Enter title" value="">
                                            <span class="text-danger">
                                                <strong id="title-error"></strong>
                                            </span>
                                </div>

                                <div class="form-group">
                                    <label>Description</label>
                                        <input type="text" class="form-control" id="description" name="description"
                                            placeholder="Enter Description" value="">
                                            <span class="text-danger">
                                                <strong id="description-error"></strong>
                                            </span>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" id="btn-save" value="add">Save changes
                            </button>
                            <input type="hidden" id="todo_id" name="todo_id" value="0">
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection

