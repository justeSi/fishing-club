@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $reservoir->title }}
                        <small>{{ $reservoir->area }} km<sup>2</sup></small>
                    </div>

                    <div class="card-body justify-content-between shadow-wrapper pt-3">
                        {!! $reservoir->about !!}
                        <h3>Member list:</h3>
                        <div>
                            @foreach ($members as $member)
                                @if ($member->reservoir_id == $reservoir->id)
                                    <details>
                                        <summary>
                                            <h5 class="d-inline">{{ $member->name }} {{ $member->surname }}</h5>
                                        </summary>
                                        <p class="mt-3">From: {{ $member->live }}</p>
                                        <p> Experience: {{ $member->experience }} years</p>
                                        <p>Registered in club: {{ $member->registered }} years</p>
                                    </details>
                                @endif

                            @endforeach
                        </div>
                        <div class="btn-group mt-5">
                            <form method="GET" action="{{ route('reservoir.pdf', [$reservoir]) }}">
                                @csrf
                                <a href="{{ URL::previous() }}" class="btn btn-dark btn-sm">Back</a>
                                <a href="{{ route('reservoir.edit', [$reservoir]) }}"
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
