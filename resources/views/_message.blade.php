<div class="clear-both"></div>

@if (!empty(session('success')))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif

@if (!empty(session('error')))
    <div class="alert alert-danger" role="alert">
        {{ session('error') }}
    </div>
@endif

@if (!empty(session('payment error')))
    <!-- Ensure this key matches what you set in your controller -->
    <div class="alert alert-danger" role="alert"> <!-- Changed alert-error to alert-danger -->
        {{ session('payment error') }} <!-- This should match the key used in the if statement -->
    </div>
@endif

@if (!empty(session('warning')))
    <div class="alert alert-warning" role="alert">
        {{ session('warning') }}
    </div>
@endif

@if (!empty(session('info')))
    <div class="alert alert-info" role="alert">
        {{ session('info') }} <!-- Corrected from 'into' to 'info' -->
    </div>
@endif

@if (!empty(session('secondary')))
    <div class="alert alert-secondary" role="alert">
        {{ session('secondary') }}
    </div>
@endif

@if (!empty(session('primary')))
    <div class="alert alert-primary" role="alert">
        {{ session('primary') }}
    </div>
@endif

@if (!empty(session('light')))
    <div class="alert alert-light" role="alert">
        {{ session('light') }}
    </div>
@endif
