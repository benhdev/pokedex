var elInputSearch = document.getElementById('search');
elInputSearch.addEventListener("keydown", function(event) {
	if(event.keyCode !== 13) {
		return;
	}

	$inputSearch = $(elInputSearch);
	window.location.pathname = "/search/" + $inputSearch.val();
});