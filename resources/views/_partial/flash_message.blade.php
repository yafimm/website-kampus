@if(Session::has('flash_message'))
    <div class="alert {{ Session::get('alert-class') }} alert-dismissible show" role="alert">
      {!! Session::get('flash_message') !!}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
@endif
