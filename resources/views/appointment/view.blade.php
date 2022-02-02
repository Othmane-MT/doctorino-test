@extends('layouts.master')

@section('title')
{{ __('sentence.Appointment') }}
@endsection

    <div class="Appointment-view" >
        <h1>
            Name : <strong>
                {{ $patient->name }}
            </strong>
        </h1>
    </div>

@section('content')