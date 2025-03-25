@if (Session::has('error'))

  
    {{-- <div class="alert">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-ban"></i> Error!</h5> 

    </div> --}}

    <div class="alertMessage">
        <span class="closeBtn" onclick="this.parentElement.style.display='none';">×</span>
        <strong> Error!</strong> {{ Session::get('error') }}
    </div>
@endif


@if (Session::has('success'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-check"></i> Success!</h5> {{ Session::get('success') }}

    </div>
@endif
