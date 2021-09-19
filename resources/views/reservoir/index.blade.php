@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">List of reservoirs</div>

                    <div class="card-body  shadow-wrapper">
                        @foreach ($reservoirs as $reservoir)
                            <div class="d-flex justify-content-between p-2 border-bottom"> {{ $reservoir->title }}
                                <small>{{ $reservoir->area }} km<sup>2</sup></small>
                                <div class="btn-group">
                                    <form method="POST" action="{{ route('reservoir.destroy', [$reservoir]) }}">
                                        @csrf
                                        <a href="{{ route('reservoir.show', [$reservoir]) }}"
                                            class="btn btn-dark btn-sm">VIEW</a>
                                        <a href="{{ route('reservoir.edit', [$reservoir]) }}"
                                            class="btn btn-dark btn-sm">EDIT</a>
                                        <button type="submit" class="btn btn-dark btn-sm">DELETE</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('title')List of reservoirs @endsection
