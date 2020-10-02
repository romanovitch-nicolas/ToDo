class Nav {
	constructor() {
		// Menu de navigation
		this.menu = document.querySelector("header");

		// Sous-menu de navigation
		this.submenu = document.querySelector("#submenu");
		this.submenuButton = document.querySelector(".fa-cog");

		// Menu secondaire
		this.leftmenu = document.querySelector("#left-nav");
		this.leftmenuButton = document.querySelector("#left-nav-btn");
		this.leftmenuArrowRight = document.querySelector(".fa-chevron-right");
		this.leftmenuArrowLeft = document.querySelector(".fa-chevron-left");

		// Recherche
		this.searchForm = document.querySelector("#search_form");
		this.searchIcon = document.querySelector("#top-nav ul .fa-search");
		this.searchInput = document.querySelector("header input[type='search']");

		// Options
		this.options = document.querySelectorAll(".option");

		// Background
		this.background = document.querySelector("#background");

		this.openSubmenu();
		this.openLeftmenu();
		this.openSearch();
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

	openLeftmenu() {
		this.leftmenuButton.addEventListener("click", function () {
			let leftmenuWidth;
			if(window.matchMedia("(max-width: 475px)").matches) { leftmenuWidth = "251px"; }
			else { leftmenuWidth = "301px"; }

			if(this.leftmenu.style.display !== "block") {
				setTimeout(function() { 
					this.leftmenuArrowRight.style.display = "none";
					this.leftmenuArrowLeft.style.display = "block";
				}.bind(this), 200);
				this.leftmenu.style.display = "block";
				this.menu.style.zIndex = 1002;
				this.leftmenuButton.style.zIndex = 1002;
				this.background.classList.remove("invisible");
				this.leftmenuButton.animate([
					{ transform: "translateX(0)" },
					{ transform: "translateX(" + leftmenuWidth + ")" }
					], {
						duration: 200,
						fill: "forwards"
					}
				);
				this.leftmenu.animate([
					{ transform: "translateX(-100%)" },
					{ transform: "translateX(0)" }
					], {
						duration: 200,
						fill: "forwards"
					}
				);
			}
			else {
				setTimeout(function() { 
					this.leftmenu.style.display = "none";
					this.menu.style.zIndex = 1000;
					this.leftmenuButton.style.zIndex = 1000;
					this.leftmenuArrowRight.style.display = "block";
					this.leftmenuArrowLeft.style.display = "none";
				}.bind(this), 200);
				this.background.classList.add("invisible");

				this.leftmenuButton.animate([
					{ transform: "translateX(" + leftmenuWidth + ")" },
					{ transform: "translateX(0)" }
					], {
						duration: 200,
						fill: "forwards"
					}
				);
				this.leftmenu.animate([
					{ transform: "translateX(0)" },
					{ transform: "translateX(-100%)" }
					], {
						duration: 200,
						fill: "forwards"
					}
				);
			}
		}.bind(this));

		this.background.addEventListener("click", function () {
			let leftmenuWidth;
			if(window.matchMedia("(max-width: 475px)").matches) { leftmenuWidth = "251px"; }
			else { leftmenuWidth = "301px"; }
			
			if(this.leftmenu.style.display == "block" && window.matchMedia("(max-width: 1023px)").matches) {
				setTimeout(function() { 
					this.leftmenu.style.display = "none";
					this.menu.style.zIndex = 1000;
					this.leftmenuArrowRight.style.display = "block";
					this.leftmenuArrowLeft.style.display = "none";
				}.bind(this), 200);
				this.background.classList.add("invisible");
				this.leftmenuButton.animate([
					{ transform: "translateX(" + leftmenuWidth + ")" },
					{ transform: "translateX(0)" }
					], {
						duration: 200,
						fill: "forwards"
					}
				);
				this.leftmenu.animate([
					{ transform: "translateX(0)" },
					{ transform: "translateX(-100%)" }
					], {
						duration: 200,
						fill: "forwards"
					}
				);
			}
		}.bind(this));

		window.addEventListener("resize", function() {
			if (window.matchMedia("(max-width: 1023px)").matches) {
				if(this.leftmenu.style.display == "block" && this.background.classList.contains("invisible")) {
					this.background.classList.remove("invisible");
				};
			}
			if (window.matchMedia("(min-width: 1024px)").matches) {
				if(!this.background.classList.contains("invisible")) {
					this.background.classList.add("invisible");
				};
				if(this.leftmenu.style.display == "none") {
					this.leftmenu.animate([
						{ transform: "translateX(-100%)" },
						{ transform: "translateX(0)" }
						], {
							duration: 0,
							fill: "forwards"
						}
					);
				}
			}
		}.bind(this));
	}

	openSearch() {
		if(this.searchIcon !== null) {
			this.searchIcon.addEventListener("click", function () {
				console.log("ok");
				if(this.searchForm.style.display == "block") {
					setTimeout(function() { this.searchForm.style.display = "none"; }.bind(this), 100);
					this.searchForm.animate([
						{ transform: "translateY(0)", opacity: 1 },
						{ transform: "translateY(-3%)", opacity: 0.4 }
						], {
							duration: 100,
							fill: "forwards"
						}
					);
				}
				else
				{
					this.searchForm.style.display = "block";
					this.searchForm.animate([
						{ transform: "translateY(-3%)", opacity: 0.4 },
						{ transform: "translateY(0)", opacity: 1 }
						], {
							duration: 100,
							fill: "forwards"
						}
					);
					this.searchInput.focus();
				}
			}.bind(this));

			window.addEventListener('click', function(e) {
				if(this.searchForm.style.display == "block") {
				    if (!this.searchForm.contains(e.target) && (!this.searchIcon.contains(e.target))) {
					    setTimeout(function() { this.searchForm.style.display = "none"; }.bind(this), 100);
						this.searchForm.animate([
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