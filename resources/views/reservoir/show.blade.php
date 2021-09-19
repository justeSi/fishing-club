@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $reservoir->title }}
                        <small>{{ $reservoir->area }} km<sup>2</sup></small>
                    </div>

                    <div class="card-body d-flex flex-wrap justify-content-between shadow-wrapper pt-3">
                            {{$reservoir->about}}
                            <div class="btn-group mt-5">
                                <form method="GET" action="{{ route('reservoir.pdf', [$reservoir]) }}">
                                    @csrf
                                    <a href="{{ URL::previous() }}" class="btn btn-dark btn-sm">Back</a>
                                    <a href="{{ route('reservoir.edit', [$reservoir]) }}"
                                        class="btn btn-dark btn-sm">VIEW</a>
                                    <a href="{{ route('reservoir.show', [$reservoir]) }}"
                                        class="btn btn-dark btn-sm">EDIT</a>
                                    <button type="submit" class="btn btn-dark btn-sm">PDF</button>
                                </form>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('title'){{ $reservoir->title }} @endsection