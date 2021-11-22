$( document ).ready(function trimFlexColumn ( largerColumn, smallerColumn ) {
	var image_height = document.getElementsByClassName( largerColumn )[0].height;
	var intro_height = document.getElementsByClassName( smallerColumn )[0].height;
	
	if (image_height > intro_height) {
		document.getElementsByClassName( largerColumn )[0].height( smallerColumn );
		console.log('I have changed the height');
	}
});