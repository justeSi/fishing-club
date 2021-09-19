@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        List of members
                        <details>
                            <summary>Options</summary>
                            {{-- FILTER --}}
                            <form action="{{ route('member.index') }}" method="get">
                                <p class="d-inline">Filter</p>
                                <div class="form-group ">
                                    <select class="form-control w-50" name="reservoir_id">
                                        <option value="0" disabled selected>Select Reservoir</option>
                                        @foreach ($reservoirs as $reservoir)
                                            <option value="{{ $reservoir->id }}" @if ($reservoir_id == $reservoir->id) selected @endif>
                                                {{ $reservoir->title }} </option>
                                        @endforeach
                                    </select>
                                    <small class="form-text ">Select reservoir from the list.</small>
                                </div>
                                <div class="mb-3">
                                    <button type=" submit"
                                    class="btn btn-dark btn-sm" name="filter" value="reservoir">Filter</button>
                                    <a href="{{ route('member.index') }}" class="btn btn-dark btn-sm">Reset</a>
                                </div>
                            </form>

                            <form action="{{ route('member.index') }}" method="get">
                                <p class="d-inline mt-3">Sort by:</p>
                                <div class="form-group ">
                                    <button type="submit" class="btn btn-dark btn-sm" name="sort" value="name">Name</button>
                                    <button type="submit" class="btn btn-dark btn-sm" name="sort"
                                        value="surname">Surname</button>
                                    <button type="submit" class="btn btn-dark btn-sm" name="sort" value="live">City</button>
                                    <button type="submit" class="btn btn-dark btn-sm" name="sort" value="new">Newest</button>
                                </div>
                            </form>
                    </div>
                    </details>
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
                        <div class="mt-3 pagination-dark justify-content-center pagination-md d-flex flex-sm-wrap">
                            {{ $members->onEachSide(0)->links() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('title')List of members @endsection
