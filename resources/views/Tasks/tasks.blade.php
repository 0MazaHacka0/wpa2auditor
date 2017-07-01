@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <div class="col-lg-9 offset-1">
            <div class="alert alert-warning" role="alert">
                <strong>Warning!</strong> Note that some networks may occur more than one time. This happens because
                they have different wpa passphrases.
            </div>

            <h2>Tasks</h2>

            <div style="overflow: auto;" class="my-2">

                <form style="float: left; padding-right: 5px;" action="" class="form-inline" method="POST"
                      onSubmit="Task.showOnlyMyNetworks(this);">
                    <input type="submit" value="Show only my networks" class="btn btn-default"
                           id="buttonShowOnlyMyNetworks">
                </form>

                <div style="overflow: auto;">
                    <form style="float: left; padding-right: 5px;" class="form-inline">
                        <input type="button" value="Turn on auto-reload" class="btn btn-success"
                               id="buttonTurnOnAutoRefresh">
                    </form>
                </div>
            </div>
        </div>

        <!-- Right side Bar -->
        <div class="col-lg-2">
            @include('Tasks.right_side_bar')
        </div>
    </div>
@stop