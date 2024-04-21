@extends('layouts.backend.master')

@section('title', 'Road')
@section('content')
    <div class="row">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Road</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Road</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">All Road</h4>
                                    
                                    <div class="flex-shrink-0">
                                        <div>
                                            <a href="{{ route('admin.road.create') }}"
                                               class="btn btn-clr-red rounded-pill">
                                                Create road
                                            </a>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-borderless align-middle mb-0">
                                            <thead class="table-light">
                                            <tr>
                                                <th scope="col">SL</th>
                                                <th scope="col">Road</th>
                                                <th scope="col">Actions</th>
                                            </thead>
                                            <tbody>
                                                
                                            @forelse($roads as $key=>$road)
                                          
                                                <tr>
                                                    <td class="fw-medium">{{ $key + 1 }}</td>
                                                    <td>{{ $road->name }}</td>
                                                  
                                                    <td>
                                                        <div class="hstack gap-3 fs-15">
                                                                <a href="{{ route('admin.road.edit', $road->id) }}"
                                                                   class="btn btn-primary waves-effect waves-light">
                                                                    <i class="ri-pencil-line align-bottom me-1"></i>
                                                                    Edit
                                                                </a>
                                                            
                                                            
                                                                <button type="button"
                                                                        class="btn btn-danger waves-effect waves-light"
                                                                        onclick="deleteData({{ $road->id }})">
                                                                    <i class="ri-delete-bin-5-line align-bottom me-1"></i>
                                                                    Delete
                                                                </button>
                                                                <form id="delete-form-{{ $road->id }}"
                                                                      action="{{ route('admin.road.destroy',$road->id) }}"
                                                                      method="POST"
                                                                      style="display: none;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                </form>
                                                                
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td>No record Found.</td>
                                                </tr>
                                            @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
