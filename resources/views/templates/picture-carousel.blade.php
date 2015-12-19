{{-- 
	Template for picture carousel (bootstrap).

	Has inline-styling so that the carousel appears correctly (does not 
	disappear into top of the window for example).

	Uses common practices presented at:
	http://getbootstrap.com/
	http://laravel.com/docs/5.1/blade
--}}
<div style="margin-top: 2em; width: 85%; height: 1em;">
	<h4>Here are some of our most liked pictures</h4>
	<hr>
	<div id="sample_pictures_carousel" class="carousel slide" data-ride="carousel">
		<ol class="carousel-indicators">
			<!-- Data slides are not currently visible for unknown reasons. -->
			<li data-target="#sample_pictures_carousel" data-slide-to="0" class="active"></li>
			<li data-target="#sample_pictures_carousel" data-slide-to="1"></li>
		</ol>
		<div class="carousel-inner">
			{{-- Give carousel paths to pictures that can be loaded trough GET-requests. --}}
			@foreach($picture as $storedPicture)
				<div class="item active" style="height: 5em; widht: 5em;">
					<img src="{{ $storedPicture->path }}" alt="{{ $storedPicture->header }}">
				</div>
			@endforeach
		</div>
		{{-- Carousel controls. --}}
		<a class="left carousel-control" href="#sample_pictures_carousel" data-slide="prev">
			<span class="icon-prev" aria-hidden="true"></span>
			<span class="sr-only">previous picture</span>
		</a>
		<a class="right carousel-control" href="#sample_pictures_carousel" data-slide="next">
			<span class="icon-next" aria-hidden="true"></span>
			<span class="sr-only">next picture</span>
		</a>
	</div>
</div>