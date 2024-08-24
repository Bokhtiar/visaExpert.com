@extends('layouts.backend.master')

@section('title', 'Show Documents')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Submitted Documents</h4>
                    <div class="flex-shrink-0">
                        <div>
                            <a href="{{ route('admin.visa-forms.index') }}" class="btn btn-secondary">
                                <i class="ri-arrow-left-line align-bottom me-1"></i>
                                Back to list
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless align-middle table-nowrap mb-0">
                            <thead>
                            <tr>
                                <th scope="col">SL</th>
                                <th scope="col">Document Name</th>
                                <th scope="col">Submitted Files</th>
                                <th scope="col">Document Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($documents as $key => $document)
                                <tr>
                                    <td class="fw-medium text-center">{{ $key + 1 }}</td>
                                    <td>{{ $document->title }}</td>
                                    @if($document->document_type != 'pdf')
                                        <td>
                                            <figure class="figure">
                                                <img
                                                    src="{{ asset('uploads/visa-forms/documents/' . $document->documents) }}"
                                                    class="figure-img img-fluid rounded" alt="..."
                                                    width="200"
                                                    height="200">
                                            </figure>
                                        </td>
                                    @else
                                        <td>
                                            <a href="{{ asset('uploads/visa-forms/documents/' .$document->documents) }}"
                                               target="_blank">
                                                View PDF
                                            </a>
                                        </td>
                                    @endif
                                    <td>{{ $document->status ? $document->status : '-' }}</td>
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
@endsection
