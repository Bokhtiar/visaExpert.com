@extends('layouts.backend.master')

@section('title', 'Transfer')
@section('content')
    <div class="row">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Transfer</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Transfer</li>
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
                                    <h4 class="card-title mb-0 flex-grow-1">All statement</h4>

                                    <div class="flex-shrink-0">
                                        <!-- <form action="{{ route('admin.statement.index') }}" method="GET">
                                            <div class="row mb-3">
                                                <div class="col-md-4">
                                                    <select name="month" class="form-control">
                                                        <option value="">Select Month</option>
                                                        @for ($m = 1; $m <= 12; $m++)
                                                            <option value="{{ $m }}"
                                                                {{ isset($selectedMonth) && $selectedMonth == $m ? 'selected' : '' }}>
                                                                {{ date('F', mktime(0, 0, 0, $m, 1)) }}
                                                            </option>
                                                        @endfor
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <select name="year" class="form-control">
                                                        <option value="">Select Year</option>
                                                        @for ($y = date('Y'); $y >= date('Y') - 10; $y--)
                                                            <option value="{{ $y }}"
                                                                {{ isset($selectedYear) && $selectedYear == $y ? 'selected' : '' }}>
                                                                {{ $y }}
                                                            </option>
                                                        @endfor
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <button type="submit" class="btn btn-primary">Filter</button>
                                                </div>
                                            </div>
                                        </form> -->

                                        <form action="{{ route('admin.statement.index') }}" method="GET">
    <div class="row mb-3">
        <div class="col-md-3">
            <select name="month" class="form-control">
                <option value="">Select Month</option>
                @for ($m = 1; $m <= 12; $m++)
                    <option value="{{ $m }}"
                        {{ isset($selectedMonth) && $selectedMonth == $m ? 'selected' : '' }}>
                        {{ date('F', mktime(0, 0, 0, $m, 1)) }}
                    </option>
                @endfor
            </select>
        </div>
        <div class="col-md-3">
            <select name="year" class="form-control">
                <option value="">Select Year</option>
                @for ($y = date('Y'); $y >= date('Y') - 10; $y--)
                    <option value="{{ $y }}"
                        {{ isset($selectedYear) && $selectedYear == $y ? 'selected' : '' }}>
                        {{ $y }}
                    </option>
                @endfor
            </select>
        </div>
        <div class="col-md-3">
            <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}" placeholder="Start Date">
        </div>
        <div class="col-md-3">
            <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}" placeholder="End Date">
        </div>
        <div class="col-md-3 mt-2">
            <select name="created_by" class="form-control">
                <option value="">Select User</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ @$createdBy == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3 mt-2">
            <button type="submit" class="btn btn-primary">Filter</button>
        </div>
    </div>
</form>


                                    </div>

                                </div>
                                <div class="">


                                    <div class="table-responsive">
                                        <table class="table table-borderless align-middle mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <th scope="col">SL</th>
                                                    <th scope="col">Date & Time</th>
                                                    <th scope="col">Work details</th>
                                                    <th scope="col">Earning</th>
                                                    <th scope="col">Spending</th>
                                                    <th scope="col">Balance</th>
                                            </thead>
                                            <tbody>

                                                @forelse($transfers as $key=>$transfer)
                                                    <tr>
                                                        <td class="fw-medium">{{ $key + 1 }}</td>
                                                        <td>{{ $transfer->created_at->diffForHumans() }}</td>
                                                        @php
                                                            $user = App\Models\User::find($transfer->created_by);
                                                        @endphp
                                                        @if ($transfer->type == 'expense_create' || $transfer->type == 'expense_update')
                                                            <td>
                                                                {!! $user->name .
                                                                    ' (' .
                                                                    ($user->role ? $user->role->name : '') .
                                                                    ')' .
                                                                    ' spending update ' .
                                                                    ($transfer->expense ? $transfer->expense->description : '') !!}
                                                            </td>
                                                        @elseif ($transfer->type == 'invoice_recive' || $transfer->type == 'invoice_due' || $transfer->type == 'invoice_delete')
                                                            <td>{!! $user->name .
                                                                ' (' .
                                                                ($user->role ? $user->role->name : '') .
                                                                ')' .
                                                                $transfer->type .
                                                                ' ' .
                                                                ($transfer->customer ? $transfer->customer->name : '') .
                                                                '&' .
                                                                $transfer->customer_id !!}</td>
                                                        @elseif (
                                                            $transfer->type == 'balance_transfer' ||
                                                                $transfer->type == 'balance_transfer_updated' ||
                                                                $transfer->type == 'transfer_recieve')
                                                            @if ($transfer->type == 'balance_transfer' || $transfer->type == 'balance_transfer_updated')
                                                                <td>{!! $user->name .
                                                                    ' (' .
                                                                    ($user->role ? $user->role->name : '') .
                                                                    ')' .
                                                                    $transfer->type .
                                                                    ' ' .
                                                                    ($transfer->reciver ? $transfer->reciver->name : '') .
                                                                    '&' .
                                                                    $transfer->recive_id !!}</td>
                                                            @elseif ($transfer->type == 'transfer_recieve' || $transfer->type == 'transfer_rejected')
                                                                <td>
                                                                    {!! ($transfer->reciver ? $transfer->reciver->name : '') .
                                                                        '(' .
                                                                        ($transfer->reciver ? $transfer->reciver->role->name : '') .
                                                                        ')' .
                                                                        ' ' .
                                                                        $transfer->type .
                                                                        ' from ' .
                                                                        ($transfer->transfer ? $transfer->transfer->name : '') .
                                                                        '&' .
                                                                        $transfer->created_by !!}
                                                                </td>
                                                            @endif
                                                        @endif
                                                        <td>
                                                            @if (
                                                                $transfer->type == 'transfer_recieve' ||
                                                                    $transfer->type == 'transfer_rejected' ||
                                                                    $transfer->type == 'invoice_recive' ||
                                                                    $transfer->type == 'invoice_due' ||
                                                                    $transfer->type == 'invoice_delete')
                                                                {{ $transfer->amount }}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if (
                                                                $transfer->type == 'expense_create' ||
                                                                    $transfer->type == 'expense_update' ||
                                                                    $transfer->type == 'balance_transfer' ||
                                                                    $transfer->type == 'balance_transfer_updated')
                                                                {{ $transfer->amount }}
                                                            @endif
                                                        </td>

                                                        <td>{{ $transfer->current_amount }} Tk</td>

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
