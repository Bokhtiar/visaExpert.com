@extends('layouts.backend.master')

@section('title', 'Daily Office Expense')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Daily Office Expense</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                        <li class="breadcrumb-item active">Daily Office Expense</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">All Expenses</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive table-card mb-1">
                        <table class="table table-borderless table-nowrap align-middle">
                            <thead class="text-muted table-light">
                                <tr class="text-uppercase">
                                    <th scope="col">SL</th>
                                    <th scope="col">Expense Details</th>
                                    <th scope="col">Amount (Tk)</th>
                                    <th scope="col">Date and Time</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @forelse($expenses as $key=>$expense)
                                    <tr>
                                        <td class="fw-medium">
                                            {{ $key + $expenses->firstItem() }}
                                        </td>
                                        <td>
                                            {!! $expense->description !!}
                                        </td>
                                        <td>
                                            {{ $expense->amount }}
                                        </td>
                                        <td>
                                            {{ $expense->created_at->format('d M Y - g:i a') }}
                                        </td>
                                        <td>
                                            <div class="hstack gap-3 fs-15">
                                                @hasPermission('Edit Expense')
                                                @can(\App\Permissions::EDIT_DAILY_OFFICE_EXPENSE)
                                                    <a href="{{ route('admin.daily-office-expenses.edit', $expense->id) }}"
                                                        class="btn btn-primary waves-effect waves-light">
                                                        <i class="ri-pencil-line align-bottom me-1"></i>
                                                        Edit
                                                    </a>
                                                @endcan
                                                @endhasPermission
                                                @hasPermission('Delete Expense')
                                                @can(\App\Permissions::DELETE_DAILY_OFFICE_EXPENSE)
                                                    <button type="button" class="btn btn-danger waves-effect waves-light"
                                                        onclick="deleteData({{ $expense->id }})">
                                                        <i class="ri-delete-bin-5-line align-bottom me-1"></i>
                                                        Delete
                                                    </button>
                                                    <form id="delete-form-{{ $expense->id }}"
                                                        action="{{ route('admin.daily-office-expenses.destroy', $expense->id) }}"
                                                        method="POST" style="display: none;">
                                                        @csrf()
                                                        @method('DELETE')
                                                    </form>
                                                @endcan
                                                @endhasPermission
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
                {{ $expenses->links('pagination.default') }}
            </div>
        </div>
        <div class="col-lg-4">
            @can(\App\Permissions::CREATE_DAILY_OFFICE_EXPENSE, \App\Permissions::EDIT_DAILY_OFFICE_EXPENSE)
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">{{ isset($dailyOfficeExpense) ? 'Edit' : 'Add' }} an
                            expense</h4>
                    </div>
                    <div class="card-body">
                        <form
                            action="{{ isset($dailyOfficeExpense) ? route('admin.daily-office-expenses.update', $dailyOfficeExpense->id) : route('admin.daily-office-expenses.store') }}"
                            method="POST">
                            @csrf
                            @if (isset($dailyOfficeExpense))
                                @method('PUT')
                            @endif
                            <div class="my-2">
                                <label for="description" class="form-label">Expense Details</label>
                                <textarea name="description" class="ckeditor-classic" id="description">{{ $dailyOfficeExpense->description ?? old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="amount" class="form-label">Amount (Tk)</label>
                                <input type="number" id="amount"
                                    class="form-control mb-3 @error('amount') is-invalid @enderror" name="amount"
                                    value="{{ $dailyOfficeExpense->amount ?? old('amount') }}">

                                @error('amount')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                            <div class="mt-3">

                                @isset($dailyOfficeExpense)
                                    @hasPermission('Edit Expense')
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-plus-circle"></i>
                                            <span>Update</span>
                                        </button>
                                    @endhasPermission
                                @else
                                    @hasPermission('Create Expense')
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-plus-circle"></i>
                                            <span>Add</span>
                                        </button>
                                    @endhasPermission
                                @endisset
                            </div>
                        </form>
                    </div>
                </div>
            @endcan
        </div>
    </div>
@endsection

@push('js')
    <!-- ckeditor -->
    <script src="{{ asset('backend/assets/libs/%40ckeditor/ckeditor5-build-classic/build/ckeditor.js') }}"></script>

    <!-- init js -->
    <script src="{{ asset('backend/assets/js/pages/form-editor.init.js') }}"></script>
@endpush
