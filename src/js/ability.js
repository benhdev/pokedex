function animatePokemonCard(parent, start, end) {
	$({deg: start}).animate({deg: end}, {
        duration: 750,
        step: function(now) {
            // in the step-callback (that is fired each step of the animation),
            // you can use the `now` paramter which contains the current
            // animation-position (`0` up to `angle`)
            parent.css({
                transform: 'rotate3d(0, 1, 0, ' + now + 'deg)'
            });
        }
    });
}

$(".pokemon-abilities").click(function() {
	console.log('click ability');
	var $parent = $(this).closest(".pokemon-card-inner");

	animatePokemonCard($parent, 0, 90);
	setTimeout(animatePokemonCard, 750, $parent, 90, 0);

	

	$(this).closest(".pokemon-card-info:not(.pokemon-card-abilities)").fadeOut(750);
	$parent.find(".pokemon-card-abilities").delay(750).fadeIn(750);

	// $parent.css("animation", "none");
});

$(".pokemon-info").click(function() {
	console.log('click info');
	var $parent = $(this).closest(".pokemon-card-inner");
	animatePokemonCard($parent, 0, 90);
	setTimeout(animatePokemonCard, 750, $parent, 90, 0);

	$(this).closest(".pokemon-card-abilities").fadeOut(750);
	$parent.find(".pokemon-card-info:not(.pokemon-card-abilities)").delay(750).fadeIn(750);
});