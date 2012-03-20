<!--

//VIRTUEMART STUFF
	feature_block = document.getElementById('ja-feature');
	if (feature_block) {
		anchors_feature = feature_block.getElementsByTagName('a');
		for (i = 0; i<anchors_feature.length; ++i) {
			if (anchors_feature[i].title.indexOf("Add to Cart") != -1) {
				anchors_feature[i].className = "addtocart";
			}
		}
	}
	
	carts = document.getElementsByName('addtocart');
	if (carts.length) {
		for (i = 0; i<carts.length; ++i) {
			carti = carts[i];
			anchors_cart = carti.getElementsByTagName('input');
			for (j = 0; j<anchors_cart.length; ++j) {
				if (anchors_cart[j].title.indexOf("Add to Cart") != -1) {
					anchors_cart[j].className = "addtocart";
				}
			}
		}
	}
  	
//-->
