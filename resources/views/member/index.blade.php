@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">List of members</div>

                    <div class="card-body shadow-wrapper ">
                        @foreach ($members as $member)

                            <div class="border-bottom d-flex justify-content-between p-2">
                                <div>
                                    <p> {{ $member->name }} {{ $member->surname }}</p>
                                    <p>{{ $member->getReservoir->title }}</p> 
                                </div>


                                <form method="POST" action="{{ route('member.destroy', [$member]) }}">
                                    <div class="btn-group d-flex">
                                        @csrf
                                        <a href="{{ route('member.edit', [$member]) }}"
                                            class="btn btn-dark btn-sm m-1">EDIT</a>
                                        <button type="submit" class="btn btn-dark btn-sm m-1">DELETE</button>
                                    </div>
                                    </form>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('title')List of members @endsection
