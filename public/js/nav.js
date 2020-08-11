class Nav {
	constructor() {
		this.navImportant = document.querySelector("#nav_important");
		this.navToday = document.querySelector("#nav_today");
		this.navWeek = document.querySelector("#nav_week");
		this.navOverdue = document.querySelector("#nav_overdue");
		this.nbImportant = document.querySelector("#nb_important").innerHTML;
		this.nbToday = document.querySelector("#nb_today").innerHTML;
		this.nbWeek = document.querySelector("#nb_week").innerHTML;
		this.nbOverdue = document.querySelector("#nb_overdue").innerHTML;

		this.numberOfTasks();
	}

	numberOfTasks() {
		this.navImportant.innerHTML = this.navImportant.innerHTML + ' (' + this.nbImportant + ')';
		this.navToday.innerHTML = this.navToday.innerHTML + ' (' + this.nbToday + ')';
		this.navWeek.innerHTML = this.navWeek.innerHTML + ' (' + this.nbWeek + ')';
		this.navOverdue.innerHTML = this.navOverdue.innerHTML + ' (' + this.nbOverdue + ')';
	}
}

let nav = new Nav;