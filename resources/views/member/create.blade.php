@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Add new member</div>

                    <div class="card-body shadow-wrapper">
                        <form method="POST" action="{{ route('member.store') }}" enctype="multipart/form-data">

                            <div class="form-group">
                                <label>Name:</label>
                                <input type="text" name="member_name" class="form-control"
                                    value="{{ old('member_name') }}">
                                <small class="form-text text-muted">Enter name</small>
                            </div>

                            <div class="form-group">
                                <label>Surname:</label>
                                <input type="text" name="member_surname" class="form-control"
                                    value="{{ old('member_surname') }}">
                                <small class="form-text text-muted">Enter surname</small>
                            </div>

                            <div class="form-group">
                                <label>Live:</label>
                                <input type="text" name="member_live" class="form-control"
                                    value="{{ old('member_live') }}">
                                <small class="form-text text-muted">Enter live</small>
                            </div>

                            <div class="form-group">
                                <label>experience:</label>
                                <input type="text" name="member_experience" class="form-control"
                                    value="{{ old('member_experience') }}">
                                <small class="form-text text-muted">Enter experience</small>
                            </div>

                            <div class="form-group">
                                <label>Registered:</label>
                                <input type="text" name="member_registered" class="form-control"
                                    value="{{ old('member_registered') }}">
                                <small class="form-text text-muted">Enter registered</small>
                            </div>

                            @csrf
                            <div class="form-group">

                                <label>Reservoir:</label>
                                <select class="form-control" name="reservoir_id">
                                    @foreach ($reservoirs as $reservoir)
                                        <option value="{{ $reservoir->id }}">{{ $reservoir->title }}
                                            {{ $reservoir->area }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-dark btn-sm">Add</button>
                            <a href="{{ URL::previous() }}" class="btn btn-dark btn-sm">Back</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#summernote').summernote();
        });
    </script>
@endsection

@section('title')Add new member @endsection
