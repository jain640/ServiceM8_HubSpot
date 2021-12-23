@extends('servicem8hubspot::app')
@section('content')
    @php
        //print_r($syncdetail);
    @endphp
    <h3>ServiceM8 and Hubspot Integration  : </h3>
    <br/>
    <br/>
    <a href="{{ route('syncezy.sync',['id'=> $syncdetail->id])}}" class="btn btn-primary" style="float: right;"> Sync </a>
    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#home">ServiceM8</a></li>
        <li><a data-toggle="tab" href="#menu1">HubSpot</a></li>
    </ul>

    <div class="tab-content">
        <div id="home" class="tab-pane fade in active">
        <h3>ServiceM8</h3>
        {!! Form::model($syncdetail, ['route' => ['syncezy.update_servicem8', $syncdetail->id], 'method' => 'POST']) !!}
        {!! Form::hidden('first_party_id',null,['class' => 'form-control', 'placeholder'=> 'User Name']) !!}

            <div class="form-group">
                {!! Form::text('username',null,['class' => 'form-control', 'placeholder'=> 'User Name']) !!}
            </div>
            <div class="form-group">
                {!! Form::text('password',null,['class' => 'form-control', 'placeholder'=>'Password']) !!}
            </div>
            <div class="form-group">
                {!! Form::submit('Update', ['class' => 'btn btn-primary form-control']) !!}
            </div>
        {!! Form::close() !!}
        </div>
        <div id="menu1" class="tab-pane fade">
        <h3>HubSpot</h3>
        {!! Form::model($syncdetail, ['route' => ['syncezy.update_hubspot', $syncdetail->id], 'method' => 'POST']) !!}
        {!! Form::hidden('second_party_id',null,['class' => 'form-control']) !!}

            <div class="form-group">
                {!! Form::text('api_key',null,['class' => 'form-control', 'placeholder'=> 'API Key']) !!}
            </div>
            <div class="form-group">
                {!! Form::submit('Update', ['class' => 'btn btn-primary form-control']) !!}
            </div>
        {!! Form::close() !!}
        </div>
    </div>

@endsection

