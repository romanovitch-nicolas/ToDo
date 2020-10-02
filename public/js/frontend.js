class Frontend {
	constructor() {
		this.header = document.querySelector("header");
		this.nav = document.querySelector("header nav");
		this.icon = document.querySelector("header i.fa-bars");

		this.headerColor(this.header);
		this.mobileNav(this.nav);
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

	mobileNav(nav) {
		if(this.icon !== null) {
			this.icon.addEventListener("click", function() {
				if(nav.style.display !== "block") {
					nav.style.display = "block";
					nav.animate([
					{ transform: "translateY(-3%)", opacity: 0.4 },
					{ transform: "translateY(0)", opacity: 1 }
					], {
						duration: 100,
						fill: "forwards"
					});
				}
				else {
					setTimeout(function() { nav.style.display = "none"; }, 100);
					nav.animate([
						{ transform: "translateY(0)", opacity: 1 },
						{ transform: "translateY(-3%)", opacity: 0.4 }
						], {
							duration: 100,
							fill: "forwards"
						}
					);
				}
			});

			window.addEventListener('click', function(e) {
				if(nav.style.display == "block") {
				    if (!this.icon.contains(e.target)) {
					    setTimeout(function() { nav.style.display = "none"; }, 100);
						nav.animate([
							{ transform: "translateY(0)", opacity: 1 },
							{ transform: "translateY(-3%)", opacity: 0.4 }
							], {
								duration: 100,
								fill: "forwards"
							}
						);
					}
				}
			}.bind(this));
		}
	}
}

let frontend = new Frontend;