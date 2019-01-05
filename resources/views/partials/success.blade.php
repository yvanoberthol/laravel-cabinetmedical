@if (session()->has('updateSuccess'))
    <div class="col-md-12">
        <div class="alert alert-dismissible alert-success fade show text-center">
            <button type="button" class="close" data-dismiss='alert' aria-label="close">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>
                <span class="fa fa-check"></span> {!! session()->get('updateSuccess') !!}
            </strong>
        </div>
    </div>

@endif

@if (session()->has('deleteSuccess'))
    <div class="col-md-12">
        <div class="alert alert-dismissible alert-success fade show text-center">
            <button type="button" class="close" data-dismiss='alert' aria-label="close">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>
              <span class="fa fa-check"></span> {!! session()->get('deleteSuccess') !!}
            </strong>
        </div>
    </div>

@endif

@if (session()->has('addSuccess'))
    <div class="col-md-12">
        <div class="alert alert-dismissible alert-success fade show text-center">
            <button type="button" class="close" data-dismiss='alert' aria-label="close">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>
                <span class="fa fa-check"></span> {!! session()->get('addSuccess') !!}
            </strong>
        </div>
    </div>

@endif