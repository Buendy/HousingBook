@extends('layouts.app-dash')

@section('content')

    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    @if(session('success'))
                        <div class="alert alert-info">
                            {{session('success')}}
                        </div>
                    @endif
                    <div class="card-header">
                        <h2 class="card-title">{{__('profile.history')}}</h2>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="text-primary">
                                <th>{{__('profile.apartmentowner')}}</th>
                                <th>{{__('profile.apartmentaddress')}}</th>
                                <th>{{__('profile.entry')}}</th>
                                <th>{{__('profile.exit')}}</th>
                                <th class="text-center">Total</th>
                                <th class="text-center">{{__('profile.actions')}}</th>
                                </thead>
                                <tbody>
                                @forelse($apartments as $apartment)
                                    <tr>
                                        <td>{{$apartment->name}}</td>
                                        <td>{{$apartment->address}}€</td>
                                        <td>{{$apartment->pivot->entry}}</td>
                                        <td>{{$apartment->pivot->exit}}</td>
                                        <td class="text-center">{{$apartment->pivot->total}} &euro;</td>


                                        <td class="text-center">
                                            <a href="{{route('apartment.showapartment',$apartment->id)}}"
                                               data-toggle="tooltip" title="{{__('profile.show')}}"
                                               class="btn btn-info btn-icon btn-sm " target="_blank">
                                                <i class="fa fa-user"></i>
                                            </a>

                                            {!! Form::open(['route'=>'invoice.download' , 'method'=>'post', 'class' => 'd-inline-block']) !!}
                                            @csrf
                                            <input type="hidden" name="id" value="{{$apartment->pivot->id}}">
                                            <input type="hidden" name="apartmentId" value="{{$apartment->pivot->id}}">
                                            <button type="submit" class="btn btn-success btn-icon btn-sm"  data-toggle="tooltip" title="{{__('profile.down')}}"><i class="fas fa-download"></i></button>
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @empty
                                    <h3>{{__('profile.apartmentempty')}}</h3>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
