<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.backend.data.styles')
</head>

<body>
    <div class="container-fluid mt-2">
        @yield('content')
    </div>
    @include('layouts.backend.data.scripts')
</body>

</html>
