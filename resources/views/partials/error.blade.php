@if (isset($errors) and count($errors)>0)
    <div class="col-md-12">
        <div class="text-center alert alert-dismissible alert-danger fade show">
            <button type="button" class="close" data-dismiss='alert' aria-label="close">
                <span aria-hidden="true">&times;</span>
            </button>
                @if (count($errors)> 1)
                    @foreach($errors->all() as $error)
                        <li>
                            <strong>
                                {!! $error !!}
                            </strong>
                        </li>
                    @endforeach
                @else
                    @foreach($errors as $error)
                            <strong>
                                <span class="fa fa-times-circle"></span>  {!! $error !!}
                            </strong>
                    @endforeach
                @endif

        </div>
    </div>
@endif