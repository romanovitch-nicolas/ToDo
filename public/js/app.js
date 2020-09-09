class App {
	constructor() {
		this.date = document.querySelectorAll(".dateformat");

		this.dateFormat();
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
}

let app = new App;