class Cookies {
	constructor() {
		this.divCookies = document.querySelector("#cookies");
		this.acceptCookies = document.querySelector("#accept_cookies");
		this.refuseCookies = document.querySelector("#refuse_cookies");

		this.initCookies();
	}

	initCookies() {
		this.acceptCookies.addEventListener("click", function() {
			document.cookie = 'cookies=accept; path=/; max-age=31536000';
			this.divCookies.classList.add("invisible");
		}.bind(this));

		this.refuseCookies.addEventListener("click", function() {
			document.cookie = 'cookies=refuse; path=/; max-age=86400';
			this.divCookies.classList.add("invisible");
		}.bind(this));
	}
}

let cookies = new Cookies;