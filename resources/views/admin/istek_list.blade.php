@extends('admin.layout')

@section('title','Istək list')

@section('content')
  <div class="row">

      <div class="col-md-12 col-sm-12 col-xs-12">

          <div class="panel panel-default">
              <div class="panel-heading">
                  Istək siyahısı
              </div>
              <div class="panel-body">
                  <div class="table-responsive">
                      <table class="table table-striped table-bordered table-hover">
                          <thead>
                              <tr>
                                  <th>Status</th>
                                  <th>title</th>
                                  <th>about</th>
                                  <th>location</th>
                                  <th>name</th>
                                  <th>phone</th>
                                  <th>email</th>
                                  <th>image</th>
                                  <th>org</th>
                                  <th>nov</th>
                              </tr>
                          </thead>
                          <tbody>
                            @foreach (array_chunk($istekler->getCollection()->all(), 4) as $row)


                            @foreach($row as $istek)
                              @if($istek->type_id=='2')
                              <tr>
                                  @if($istek->status=='0')
                                    <td><a class="btn btn-success" href="{{url('/activate/'.$istek->id)}}">Aktivləşdir</a></td>

                                  @else
                                    <td><a class="btn btn-warning" href="{{url('/deactivate/'.$istek->id)}}">Deaktivləşdir</a></td>
                                  @endif
                                  <td>{{$istek->title}}</td>
                                  <td>{{substr($istek->about,0,10)}}</td>
                                  <td>{{substr($istek->location, 0,10)}}</td>
                                  <td>{{$istek->name}}</td>
                                  <td>{{$istek->phone}}</td>
                                  <td>{{$istek->email}}</td>
                                  <td><a href="#" data-toggle="modal" data-target="#{{$istek->id}}"><img style="width:50px; height:50px" src="{{url('image/'.$istek->shekiller[0]->imageName)}}"/></a></td>
                                  <td>{{$istek->org}}</td>
                                  <td>{{$istek->nov}}</td>
                              </tr>
                              <div id="{{$istek->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="m odal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                      <h4 class="modal-title" id="myModalLabel">{{$istek->title}}</h4>
                                    </div>
                                    <div class="modal-body">
                                      {{$istek->about}}
                                    </div>
                                    <div class="modal-footer">
                                       <img class="img-responsive " src="{{url('image/'.$istek->shekiller[0]->imageName)}}"/>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            @endif
                            @endforeach
                            @endforeach
                          </tbody>
                      </table>
                      {{$istekler->links()}}
                  </div>
              </div>
          </div>
      </div>
  </div>
@endsection
