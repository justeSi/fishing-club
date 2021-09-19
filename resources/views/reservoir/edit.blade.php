@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Update reservoir</div>

                    <div class="card-body shadow-wrapper">
                        <form method="POST" action="{{ route('reservoir.update', $reservoir)  }}" enctype="multipart/form-data">

                            <div class="form-group">
                                <label>Title:</label>
                                <input type="text" name="reservoir_title" class="form-control"
                                    value="{{ old('reservoir_title', $reservoir->title) }}">
                                <small class="form-text text-muted">Enter title</small>
                            </div>

                            <div class="form-group">
                                <label>Area:</label>
                                <input type="text" name="reservoir_area" class="form-control"
                                    value="{{ old('reservoir_area', $reservoir->area) }}">
                                <small class="form-text text-muted">Enter area</small>
                            </div>

                            <div class="form-group">
                                <label>About:</label>
                                <textarea class="form-control" name="reservoir_about"
                                    id="summernote">{{ old('reservoir_about', $reservoir->about) }}</textarea>
                            </div>

                            @csrf
                            <button type="submit" class="btn btn-dark btn-sm">Update</button>
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

@section('title')Update reservoir @endsection
