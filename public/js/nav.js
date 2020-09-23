class Nav {
	constructor() {
		// Sous-menu de navigation
		this.submenu = document.querySelector("#submenu");
		this.submenuButton = document.querySelector(".fa-cog");

		// Options
		this.options = document.querySelectorAll(".option");

		this.openSubmenu();
		this.openOptions();
	}

	openSubmenu() {
		this.submenuButton.addEventListener("click", function () {
			if(this.submenu.classList.contains("invisible")) {
				this.submenu.classList.remove("invisible");
				this.submenu.animate([
					{ transform: "translateY(-3%)", opacity: 0.4 },
					{ transform: "translateY(0)", opacity: 1 }
					], {
						duration: 100,
						fill: "forwards"
					}
				);
			}
			else {
				setTimeout(function() { this.submenu.classList.add("invisible"); }, 100);
				this.submenu.animate([
					{ transform: "translateY(0)", opacity: 1 },
					{ transform: "translateY(-3%)", opacity: 0.4 }
					], {
						duration: 100,
						fill: "forwards"
					}
				);
			}
		}.bind(this));
				
		window.addEventListener('click', function(e) {
			if(!this.submenu.classList.contains("invisible")) {
			    if (!this.submenu.contains(e.target) && (!this.submenuButton.contains(e.target))) {
				    setTimeout(function() { this.submenu.classList.add("invisible"); }, 100);
					this.submenu.animate([
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

	openOptions() {
		if(this.options !== null) {
			this.options.forEach(function (option) {
				let optionButton = option.querySelector(".option_button");
				let optionDescription = option.querySelector(".option_content");

				optionButton.addEventListener("click", function() {
					if(optionDescription.classList.contains("invisible")) {
						optionDescription.classList.remove("invisible");
						optionDescription.animate([
							{ transform: "translateY(-3%)", opacity: 0.4 },
							{ transform: "translateY(0)", opacity: 1 }
							], {
								duration: 200,
								fill: "forwards"
							}
						);
					}
					else {
						setTimeout(function() { optionDescription.classList.add("invisible"); }, 200);
						optionDescription.animate([
							{ transform: "translateY(0)", opacity: 1 },
							{ transform: "translateY(-3%)", opacity: 0.4 }
							], {
								duration: 200,
								fill: "forwards"
							}
						);
					}
				});
			});
		}
	}
}

let nav = new Nav;