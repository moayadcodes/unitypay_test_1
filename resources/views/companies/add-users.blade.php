@extends('layouts.app')

@section('title', 'Add Users to Company')

@section('content')

@if ($errors->any())
    <div class="alert alert-danger alert-dismissible" role="alert">
        There was an error processing your form, please try again.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="card">

    <div class="card-header">Add Users to {{ $company->name }}</div>

    <div class="card-body w-50">
        <form action="{{ route('companies.add_users', $company) }}" method="post">
            @csrf

            <div class="mb-3">
                @foreach ($users as $user)
                    <div class="form-check">
                        <input
                            class="form-check-input"
                            type="checkbox"
                            name="users[][id]"
                            id="user-{{ $user->id }}-checkbox"
                            value="{{ $user->id }}"
                            {{ $user->isPartOfCompany($company) ? 'checked' : '' }}
                        >
                        <label class="form-check-label" for="user-{{ $user->id }}-checkbox">
                            {{ $user->name }}
                        </label>
                    </div>
                @endforeach
            </div>

            <button type="submit" class="btn btn-success">Add Users to Company</button>
        </form>
    </div>

</div>

@endsection

