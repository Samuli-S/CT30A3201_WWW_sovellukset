{{-- 
	Template use picture category dropdown.

	Takes in variables specifying button id and every list item ID
	(enables ID based events on sites that use this).

	Uses common practices defined at:
	http://getbootstrap.com/
	http://laravel.com/docs/5.1/blade
--}}

<div class="dropdown">
	<button id="{{ $dropdownBtnID }}" type="button" data-toggle="dropdown" class="btn btn-default dropdown-toggle" aria-haspopup="true" aria-expanded="true">
		<span id="{{ $dropdownTextID }}">Pic Categories</span>&nbsp;
		<span class="glyphicon glyphicon-chevron-down"></span>
	</button>
	@if($showRequiredSymbol)
		<span class="glyphicon glyphicon-asterisk"></span>
	@endif
	<ul class="dropdown-menu" aria-labelledby="{{ $dropdownBtnID }}">
		<li><a id="{{ $firstCategoryID }}" href="#">Funny</a></li>
		<li><a id="{{ $secondCategoryID }}" href="#">Nature</a></li>
		<li><a id="{{ $thirdCategoryID }}" href="#">Misc</a></li>
	</ul>
</div>