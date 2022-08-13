@include('pengrajin.layouts.partials.head')
<body class="">
	@include('pengrajin.layouts.partials.topbar')
	@include('pengrajin.layouts.partials.sidebar')
	<div class="main-content">
		@include('pengrajin.layouts.partials.navbar')
		@include('pengrajin.layouts.partials.header')
		<div class="container-fluid mt--7">
			@yield('content')
			<div class="container mt-5 pb-5">
        		<div class="copyright text-center my-auto">
          			<span><br>
          				swp.sambungroso.magetan©2022 | This application is made with <i class="fa fa-heart"></i> by <a target="_blank" href="https://www.instagram.com/swp.sambungroso.magetan/?hl=id">Batik Ciprat Langitan</a>
        			</span><br><br><br>
        		</div>
      		</div>
		</div>
	</div>
	@include('pengrajin.layouts.partials.footer')
</body>

</html>