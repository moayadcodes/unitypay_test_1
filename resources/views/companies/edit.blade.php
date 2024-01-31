@extends('layouts.app')

@section('title', 'Edit Company')

@section('content')

<div class="card">

    <div class="card-header">Edit Company</div>

    <div class="card-body w-50">
        <form action="{{ route('companies.update', $company) }}" method="post">
            @csrf
            @method('patch')

            <div class="mb-3">
                <label for="name" class="form-label">Company Name</label>
                <input
                    type="text"
                    class="form-control @error('name') is-invalid @enderror"
                    id="name"
                    name="name"
                    value="{{ old('name', $company->name) }}"
                    required
                >
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Save</button>
        </form>
    </div>

</div>

@endsection

