@extends('layouts.layout')

@section('title', 'Send Email')

@section('content')
    <div class="row justify-content-md-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('notification.send-email') }}
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('failed'))
                        <div class="alert alert-danger">
                           {{ session('failed') }}
                        </div>
                    @endif

                    <form action="{{ route('notification.send.email') }}" method="POST">
                        @csrf
                        <div class="form-group ">
                            <label for="user">@lang('notification.users')</label>
                            <select name="user" class="form-control" id="user">
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="email_type">@lang('notification.email-types')</label>
                            <select name="email_type" class="form-control" id="email_type">
                                @foreach($emailTypes as $key => $type)
                                    <option value="{{ $key }}">{{ $type }}</option>
                                @endforeach
                            </select>
                        </div>

                        @if($errors->any())
                            <div class="small mb-2">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li class="text-danger">{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <button type="submit" class="btn btn-info">@lang('notification.send')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
