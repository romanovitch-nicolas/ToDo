class Frontend {
	constructor() {
		this.header = document.querySelector("header");

		this.headerColor(this.header);
	}

	headerColor(header) {
		let scroll;
		if (window.scrollY == 0) {
			scroll = false;
			header.style.backgroundColor = "transparent";
		}
		else {
			scroll = true,
			header.style.backgroundColor = "#F8F9FA";
		}

		window.onscroll = function() {
			if (scroll == false) {
				scroll = true;
				header.animate([
					{ backgroundColor: "transparent" },
					{ backgroundColor: "#F8F9FA" }
				], {
						duration: 200,
						iterations: 1,
						fill: "forwards"
				});
			}
			if (window.scrollY == 0) {
				scroll = false;
				header.animate([
					{ backgroundColor: "#F8F9FA" },
					{ backgroundColor: "transparent" }
				], {
						duration: 200,
						iterations: 1,
						fill: "forwards"
				});
			}
		};
	}
}

let frontend = new Frontend;