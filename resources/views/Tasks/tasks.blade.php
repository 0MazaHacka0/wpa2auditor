@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-9 offset-1">
                
                <!-- Warning -->
                <div class="alert alert-warning" role="alert">
                    <strong>Warning!</strong> Note that some networks may occur more than one time. This happens because they have different wpa passphrases.
                </div>

                <h2>Tasks</h2>

                <div style="overflow: auto;" class="my-2">


                    <form style="float: left; padding-right: 5px;" action="" class="form-inline" method="POST" onSubmit="Task.showOnlyMyNetworks(this);">
                        <input type="submit" value="Show only my networks" class="btn btn-default" id="buttonShowOnlyMyNetworks">
                    </form>


                    <div style="overflow: auto;">
                        <form style="float: left; padding-right: 5px;" class="form-inline">
                            <input type="button" value="Turn on auto-reload" class="btn btn-success" id="buttonTurnOnAutoRefresh">
                        </form>
                    </div>
                </div>
                <!-- Header end -->

                <!-- Table start -->
                <div id="ajaxTableDiv">
                </div>
                <!-- Table end -->

                <!-- Pagger start-->
                <div id="ajaxPagger"></div>
                <!-- Pagger end -->

                <!-- Send wpa keys form -->
                <form>
                    <input type="button" value="Send WPA keys" name="buttonWpaKeys" class="btn btn-default" onClick="Task.ajaxSendWPAKeys();">
                </form>

            </div>

            <div class="col-lg-2">

                <!-- Right side Bar -->
                @include('Tasks.rightSide')

            </div>
        </div>
    </div>
@stop