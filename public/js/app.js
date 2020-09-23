class App {
	constructor() {
		this.date = document.querySelectorAll(".dateformat");

		this.categories = document.querySelectorAll("#dashboard .category");
		this.days = document.querySelectorAll("#week .day");
		this.lists = document.querySelectorAll("#list .list");

		this.dateFormat();
		this.display();
	}

	dateFormat() {
		// Change les dates en format textuel
		if (this.date !== null) {
			this.date.forEach(function (date) {
				let dateSplit = date.textContent.split(' ');
				let day = dateSplit[0];
				let dayNumber = dateSplit[1];
				let month = dateSplit[2];

				switch (day) {
					case '0': day = "Dimanche"; break;
					case '1': day = "Lundi"; break;
					case '2': day = "Mardi"; break;
					case '3': day = "Mercredi"; break;
					case '4': day = "Jeudi"; break;
					case '5': day = "Vendredi"; break;
					case '6': day = "Samedi"; break;
				}

				switch (month) {
					case '0': month = "Janvier"; break;
					case '1': month = "Février"; break;
					case '2': month = "Mars"; break;
					case '3': month = "Avril"; break;
					case '4': month = "Mai"; break;
					case '5': month = "Juin"; break;
					case '6': month = "Jullet"; break;
					case '7': month = "Août"; break;
					case '8': month = "Septembre"; break;
					case '9': month = "Octobre"; break;
					case '10': month = "Novembre"; break;
					case '11': month = "Décembre"; break;
				}

				date.textContent = day + " " + dayNumber + " " + month;
			});
		}
	}

	display() {
		// Affiche et cache les catégories du dashboard au clic
		if (this.categories !== null) {
			this.categories.forEach(function (category) {
				let title = category.querySelector("h2");
				let table = category.querySelector(".table-task");
				let p = category.querySelector("p");
				let button = category.querySelector(".addtask-today");
				let arrowUp = category.querySelector(".fa-caret-up");
				let arrowDown = category.querySelector(".fa-caret-down");

				title.addEventListener('click', function() {
					if(table !== null) {
						table.classList.toggle("invisible");
					}
					if(p !== null) {
						p.classList.toggle("invisible");
					}
					if(button !== null) {
						button.classList.toggle("invisible");
					}
					if(arrowUp !== null) {
						arrowUp.classList.toggle("invisible");
					}
					if(arrowDown !== null) {
						arrowDown.classList.toggle("invisible");
					}
				}.bind(this));
			}.bind(this));
		}

		// Affiche et cache les jours de la semaine au clic
		if (this.days !== null) {
			this.days.forEach(function (day) {
				let title = day.querySelector("h2");
				let table = day.querySelector(".table-task");
				let p = day.querySelector("p");
				let button = day.querySelector(".addtask-day");
				let arrowUp = day.querySelector(".fa-caret-up");
				let arrowDown = day.querySelector(".fa-caret-down");

				title.addEventListener('click', function() {
					if(table !== null) {
						table.classList.toggle("invisible");
					}
					if(p !== null) {
						p.classList.toggle("invisible");
					}
					if(button !== null) {
						button.classList.toggle("invisible");
					}
					if(arrowUp !== null) {
						arrowUp.classList.toggle("invisible");
					}
					if(arrowDown !== null) {
						arrowDown.classList.toggle("invisible");
					}
				}.bind(this));
			}.bind(this));
		}

		// Affiche et cache les listes au clic
		if (this.lists !== null) {
			this.lists.forEach(function (list) {
				let title = list.querySelector("h2");
				let table = list.querySelector(".table-task");
				let p = list.querySelectorAll("p");
				let button = list.querySelector(".addtask-list");
				let arrowUp = list.querySelector(".fa-caret-up");
				let arrowDown = list.querySelector(".fa-caret-down");

				title.addEventListener('click', function() {
					if(table !== null) {
						table.classList.toggle("invisible");
					}
					p.forEach(function (p) {
						if(p !== null) {
							p.classList.toggle("invisible");
						}
					});
					if(button !== null) {
						button.classList.toggle("invisible");
					}
					if(arrowUp !== null) {
						arrowUp.classList.toggle("invisible");
					}
					if(arrowDown !== null) {
						arrowDown.classList.toggle("invisible");
					}
				}.bind(this));
			}.bind(this));
		}
	}
}

let app = new App;