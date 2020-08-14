class Nav {
	constructor() {
		this.navTasks = document.querySelector("#nav_tasks");
		this.navImportant = document.querySelector("#nav_important");
		this.navToday = document.querySelector("#nav_today");
		this.navWeek = document.querySelector("#nav_week");
		this.navOverdue = document.querySelector("#nav_overdue");
		this.navArchived = document.querySelector("#nav_archived");
		this.nbTasks = document.querySelector("#nb_tasks").innerHTML;
		this.nbImportant = document.querySelector("#nb_important").innerHTML;
		this.nbToday = document.querySelector("#nb_today").innerHTML;
		this.nbWeek = document.querySelector("#nb_week").innerHTML;
		this.nbOverdue = document.querySelector("#nb_overdue").innerHTML;
		this.nbArchived = document.querySelector("#nb_archived").innerHTML;

		this.numberOfTasks();
	}

	numberOfTasks() {
		this.navTasks.innerHTML = this.navTasks.innerHTML + ' (' + this.nbTasks + ')';
		this.navImportant.innerHTML = this.navImportant.innerHTML + ' (' + this.nbImportant + ')';
		this.navToday.innerHTML = this.navToday.innerHTML + ' (' + this.nbToday + ')';
		this.navWeek.innerHTML = this.navWeek.innerHTML + ' (' + this.nbWeek + ')';
		this.navOverdue.innerHTML = this.navOverdue.innerHTML + ' (' + this.nbOverdue + ')';
		this.navArchived.innerHTML = this.navArchived.innerHTML + ' (' + this.nbArchived + ')';
	}
}

let nav = new Nav;