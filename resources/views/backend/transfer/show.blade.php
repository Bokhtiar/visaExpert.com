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
                                <li class="breadcrumb-item active">Transfer Show</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="container">
                    {{-- transfer name --}}
                    <div class="row">
                        <div class="col-sm-12 col-md-2 col-lg-2" style="font-weight: bold">
                            Transfer account name
                        </div>
                        <div class="col-sm-12 col-md-10 col-lg-10">
                            {{ $show->reciver ? $show->reciver->name : "" }}
                        </div>
                    </div>

                    {{-- transfer amount --}}
                    <div class="row">
                        <div class="col-sm-12 col-md-2 col-lg-2" style="font-weight: bold">
                            Transfer amount
                        </div>
                        <div class="col-sm-12 col-md-10 col-lg-10">
                            {{ $show->amount }}
                        </div>
                    </div>

                    {{-- transfer name --}}
                    <div class="row">
                        <div class="col-sm-12 col-md-2 col-lg-2" style="font-weight: bold">
                            Transfer status
                        </div>
                        <div class="col-sm-12 col-md-10 col-lg-10">
                            {{ $show->status }}
                        </div>
                    </div>

                    {{-- remark --}}
                    <div class="row">
                        <div class="col-sm-12 col-md-2 col-lg-2" style="font-weight: bold">
                            Remark
                        </div>
                        <div class="col-sm-12 col-md-10 col-lg-10">
                            {{ $show->remark }}
                        </div>
                    </div>

                    {{-- description --}}
                    <div class="row">
                        <div class="col-sm-12 col-md-2 col-lg-2" style="font-weight: bold">
                            Note
                        </div>
                        <div class="col-sm-12 col-md-10 col-lg-10">
                            {!! $show->description !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
