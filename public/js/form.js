class Form {
	constructor() {
		this.addTaskButton = document.querySelector(".fa-plus");
		this.editTaskButton = document.querySelectorAll(".fa-edit");
		this.closeButton = document.querySelector(".fa-times");
		this.taskForm = document.querySelector("#task-form");
		this.formTitle = document.querySelector("#task-form h2");
		this.formInput = document.querySelector("#task-form input");
		this.background = document.querySelector("#background");
		this.open();
		this.close();
	}

	open() {
		// Ouverture du formulaire d'ajout
		this.addTaskButton.addEventListener("click", function () {
			this.formTitle.textContent = "Ajouter une tâche";
			this.toggleInvisible();
		}.bind(this));
	}

	close() {
		// Fermeture du formulaire
		this.background.addEventListener("click", this.toggleInvisible.bind(this));
		this.closeButton.addEventListener("click", this.toggleInvisible.bind(this));
	}

	toggleInvisible() {
		this.taskForm.classList.toggle("invisible");
		this.background.classList.toggle("invisible");
	}
}

let form = new Form;