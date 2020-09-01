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
			this.submenu.classList.toggle("invisible");
		}.bind(this));
	}

	openOptions() {
		if(this.options !== null) {
			this.options.forEach(function (option) {
				let optionButton = option.querySelector(".option_button");
				let optionDescription = option.querySelector(".option_content");

				optionButton.addEventListener("click", function() {
					optionDescription.classList.toggle("invisible");
				});
			});
		}
	}
}

let nav = new Nav;