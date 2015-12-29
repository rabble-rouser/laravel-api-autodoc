@extends('api-autodoc::layouts.docs')

@section('content')

    <div id="accordion" class="panel-group" xmlns="http://www.w3.org/1999/html">
        @foreach($documentableActions as $key => $category)
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $key }}">
                        <h4>{{ $key }}</h4>
                    </a>
                </div>

                <div id="collapse{{ $key }}" class="panel-collapse collapse">
                    <div class="panel-body">

                        @foreach($category as $action)
                            <div class="action-section">
                                <h4 class="file_name dev-info">{{ $action['action']['uses'] }}</h4>

                                <span class="action-section--label clearfix">route: </span>
                                <div class="clearfix">
                                    <span class="sub-header col-sm-11">{{ $action['uri'] }}</span>
                                    <span class="method col-sm-1">{{ $action['method'] }}</span>
                                </div>
                                <hr class="small" />

                                <form data-target="response-{{ $action['unique_id'] }}" class="test-response-form" action="{{ url($action['uri']) }}" data-unique_id="{{ $action['unique_id'] }}">
                                    @if(count($action['parameters']) > 0)
                                        <span class="test-response-form--label clearfix">parameters: </span>

                                        <div class="test-response-form--parameters">
                                            @foreach( $action['parameters'] as $parameter)
                                                {{ $parameter }}<br />
                                                <input type="text" name="{{ $parameter }}" class="test-parameter-{{ $action['unique_id'] }}">
                                                <br />
                                            @endforeach
                                        </div> <!-- test-response-form--parameters -->

                                        <hr class="small" />
                                    @endif
                                    <input type="submit" value="Test" class="btn btn-sm btn-primary btn-test">
                                    <a href="#" class="btn btn-sm btn-default hide-results" data-target="response-{{ $action['unique_id'] }}">Hide Results</a>
                                </form>

                                <div id="response-{{ $action['unique_id'] }}" class="api-response-area">

                                    <span class="test-url" >
                                        <span class="test-url--label">test url:</span>
                                        <span id="test-url-{{ $action['unique_id'] }}" data-test_url="{{ app('url')->to($action['uri']) }}">
                                            {{ app('url')->to($action['uri']) }}
                                        </span>
                                    </span>

                                    <pre class="api-response-area-content"></pre>
                                </div>
                            </div> <!-- action-section -->
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </div> <!-- accordian -->

@endsection