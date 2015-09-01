@extends('layouts.index')

@section('container')
<div class="wrapper">
    <header class="main-header">
    <nav class="navbar navbar-static-top" role="navigation">
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
      </a>
      </nav>
    </header>
    <aside class="main-sidebar">
        <section class="sidebar">
            <div class="user-panel">
                <div class="pull-left image">
                  <img src="{{ URL::asset('img/profile.jpg') }}" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                  <p>{{ Auth::user()->name }}</p>
                </div>
            </div>
            <ul class="sidebar-menu">
              <li class="header">Main List</li>
              </li>
              <li>
                <a href="{{ URL::to('events/add') }}">
                  <i class="fa fa-th"></i> <span>Add Event</span>
                </a>
              </li>
              <li>
                <a href="../widgets.html">
                    <i class="fa fa-th"></i> <span>Widgets</span>
                </a>
                </li>
                <li>
                <a href="{{ URL::to('signout') }}">
                    <i class="fa fa-th"></i> <span>Sign Out</span>
                </a>
                </li>
            </ul>
        </section>
    </aside>

    <div class="content-wrapper">
            <section class="content">
              <div class="row">
                  <div class="col-md-6">
                    <div class="box">
                        <div class="box-header">
                          <h3 class="box-title">Event Lists</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body no-padding">
                          <table class="table table-striped">
                            <tr>
                              <th style="width: 10px">#</th>
                              <th>Event Name</th>
                              <th style="width: 100px">Event Date</th>
                              <th style="width: 100px">Event Details</th>
                              <th style="width: 100px"></th>
                              <th style="width: 100px"></th>
                            </tr>
                            {{-- */ $i = 1 /*--}}
                            @foreach($data as $data)
                                <tr>
                                  <td>{{ $i }}</td>
                                  <td>{{ $data->event_name }}</td>
                                  <td>
                                    {{ $data->event_date }}
                                  </td>
                                  <td>{{ $data->event_detail }}</td>
                                  <td>
                                    <div class="pull-left">
                                        <a href="{{ URL::to('events/'.$data->event_id) }}" class="btn btn-primary btn-flat">Update</a>
                                    </div>
                                   </td>
                                   <td>
                                    <div class="pull-right">
                                        <a href="{{ URL::to('events/delete/'.$data->event_id) }}" class="btn btn-danger btn-flat">Delete</a>
                                    </div>
                                    </td>
                                </tr>
                                {{-- */ $i++ /*--}}
                            @endforeach
                          </table>
                        </div><!-- /.box-body -->
                      </div>
                  </div>
              </div>
          </section>
          </div>
</div>
@stop