var teaseImages = document.querySelectorAll('template.tease');

function showImage(tease) {
  if (tease) {
    var parent = tease.parentNode;
    var image = tease.innerHTML;
    parent.removeChild(tease);
    parent.innerHTML += image;
  }
}

window.onload = function() {
	if ('content' in document.createElement('template')) {
		for (var i = 8; i < teaseImages.length; i++) {
      showImage(teaseImages[i]);
		}
	}
};

if ('content' in document.createElement('template')) {
  for (var i = 0; i < 8; i++) {
    showImage(teaseImages[i]);
  }
}