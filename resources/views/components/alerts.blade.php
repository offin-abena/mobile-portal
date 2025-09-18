{{-- Success Message --}}
@if (session('success'))
    <div class="alert alert-success alert-dismissible  show" role="alert" style="padding: 5px;">
        {{ session('success') }}
        {{-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> --}}
    </div>
@endif

{{-- Error Message --}}
@if (session('error'))
    <div class="alert alert-danger alert-dismissible  show" role="alert" style="padding: 5px;">
        {{ session('error') }}
        {{-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> --}}
    </div>
@endif

{{-- Warning Message --}}
@if (session('warning'))
    <div class="alert alert-warning alert-dismissible  show" role="alert" style="padding: 5px;">
         <strong class="text-danger text-medium">{{ session('warning') }}</strong>
        {{-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> --}}
    </div>
@endif

{{-- Validation Errors --}}
@if ($errors->any())
    <div class="alert alert-danger alert-dismissible  show" role="alert" style="padding: 5px;">
        <strong>There were some problems with your input:</strong>
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        {{-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> --}}
    </div>
@endif
