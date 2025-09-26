{{-- Success Message --}}
<div id="alertSuccess" class="alert alert-success alert-dismissible  {{session('success')? 'show':'' }}" role="alert" style="padding: 5px;{{  session('success')?'':'display:none' }}">
        {{ session('success') }}
        {{-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> --}}
</div>

{{-- Error Message --}}
<div id="alertError" class="alert alert-danger alert-dismissible {{ session('error') ?'show':'' }}" role="alert" style="padding: 5px;{{  session('error')?'':'display:none' }}">
        {{ session('error') }}
        {{-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> --}}
</div>

{{-- Warning Message --}}
<div id="alertWarning" class="alert alert-warning alert-dismissible  {{ session('warning')? 'show':'' }}" role="alert" style="padding: 5px;{{  session('warning')?'':'display:none' }}">
         <strong class="text-danger text-medium">{{ session('warning') }}</strong>
        {{-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> --}}
</div>

{{-- Validation Errors --}}
<div id="alertMessage" class="alert alert-danger alert-dismissible {{ $errors->any()? 'show':'' }}" role="alert" style="padding: 5px;{{  $errors->any()?'':'display:none' }}">
        <strong>There were some problems with your input:</strong>
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        {{-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> --}}
</div>
