@include('layouts.header')

    <body class="">

        <div class="container">
            <div class="row">
                <div class="col-12">
                	<div class="card">
					    <div class="card-body">
					    	@yield('content')
					    </div>
					</div>
                </div>
            </div>
        </div>

@include('layouts.footer')