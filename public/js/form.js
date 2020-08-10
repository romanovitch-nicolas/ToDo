class Form {
	constructor() {
		this.task = document.querySelectorAll("tr");
		this.addTaskButton = document.querySelector(".fa-plus");
		this.closeButton = document.querySelector(".fa-times");
		this.taskForm = document.querySelector("#task-form");
		this.background = document.querySelector("#background");

		this.form = document.querySelector("#task-form form");
		this.formTitle = document.querySelector("#task-form h2");
		this.formText = document.querySelector("#task-form input[type='text']");
		this.formDate = document.querySelector("#task-form input[type='date']");
		this.formSubmit = document.querySelector("#task-form input[type='submit']");

		this.checkbox = document.querySelectorAll("table input[type='checkbox']");
		this.importantButton = document.querySelector("#important");
		this.importantActiveButton = document.querySelector("#important_active");
		this.importantCheckbox = document.querySelector("#task-form form p span input[type='checkbox']");
		this.timeButton = document.querySelector("#time");
		this.timeMenu = document.querySelector("#time-menu");
		this.timeCheckbox = document.querySelector("#task-form p#time-menu input[type='checkbox']");

		this.open();
		this.close();
		this.checkboxSubmit();
		this.setImportant();
	}

	open() {
		// Ouverture du formulaire d'ajout
		this.addTaskButton.addEventListener("click", function () {
			// Vide le formulaire
			this.form.setAttribute("action", "index.php?action=addTask");
			this.formTitle.textContent = "Ajouter une tâche";
			this.formText.value = '';
			this.formDate.value = '';
			this.formSubmit.value = "Ajouter";
			if (this.importantActiveButton.className !== "invisible") {
				this.importantCheckbox.checked = false;
				this.importantActiveButton.classList.add("invisible");
				this.importantButton.classList.remove("invisible");
			}
			if(this.timeMenu.className !== "invisible") {
				this.timeCheckbox.checked = false;
				this.timeMenu.classList.add("invisible");
			}

			// Ouvre le formulaire
			this.toggleInvisible();
		}.bind(this));

		// Ouverture du formulaire de modification
		if(this.task !== null) {
			this.task.forEach(function (task) {
				let label = task.querySelector("label");
				let taskId = label.getAttribute("for");
				let taskName = label.innerHTML;
				let taskImportant = label.getAttribute("important");
				let taskEditButton = task.querySelector(".fa-edit");
				let deadline = task.querySelector(".date").innerHTML.replace(/\//g, "-").split('-').reverse().join('-');

				taskEditButton.addEventListener("click", function() {
					// Modifie le formulaire suivant la tâche selectionnée
					this.form.setAttribute("action", "index.php?action=editTask&id=" + taskId);
					this.formTitle.textContent = "Modifier une tâche";
					this.formText.value = taskName;
					this.formDate.value = deadline;
					this.formSubmit.value = "Enregistrer";

					// Vérifie si la tâche est importante
					if (taskImportant == 1) {
						this.importantCheckbox.checked = true;
						this.importantButton.classList.add("invisible");
						this.importantActiveButton.classList.remove("invisible");
					} else {
						this.importantCheckbox.checked = false;
						this.importantActiveButton.classList.add("invisible");
						this.importantButton.classList.remove("invisible");
					}

					// Gestion du menu des dates
					if(this.timeMenu.className !== "invisible") {
						this.timeMenu.classList.add("invisible");
					}

					// Vérifie si la tâche à une date d'échéance
					if (this.formDate.value !== '') {
						this.timeCheckbox.checked = true;
					}
					else {
						this.timeCheckbox.checked = false;
					}

					// Passe l'input "date" en requis si la case prévue est cochée
					if (this.timeCheckbox.checked == true) {
							this.formDate.setAttribute('required', '');
						}
					else {
						this.formDate.removeAttribute('required');
					}
					this.timeCheckbox.addEventListener('click', function() {
						if (this.timeCheckbox.checked == true) {
							this.formDate.setAttribute('required', '');
						}
						else {
							this.formDate.removeAttribute('required');
						}
					}.bind(this));

					// Ouverture du formulaire
					this.toggleInvisible();
				}.bind(this));
			}.bind(this));
		};

		// Ouverture du sous-formulaire de planification
		this.timeButton.addEventListener("click", function () {
			this.timeMenu.classList.toggle("invisible");
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

	checkboxSubmit() {
		// Validation dynamique des checkbox en BDD
		if(this.checkbox !== null) {
			this.checkbox.forEach(function (checkbox) {
				let taskId = checkbox.getAttribute("id");
				checkbox.addEventListener('click', function() {
					let data = new FormData();
					if (checkbox.checked === true) {
						data.append("done", 1);
					}
					else {
						data.append("done", 0);
					}
					data.append("task_id", taskId);
					ajaxPost("include/checkbox.php", data, function() {});
				});
			});
		};
	}

	setImportant() {
		// Icône à la place de la checkbox "Important"
		this.importantButton.addEventListener('click', function() {
			this.importantCheckbox.checked = true;
			this.importantButton.classList.add("invisible");
			this.importantActiveButton.classList.remove("invisible");
		}.bind(this));

		this.importantActiveButton.addEventListener('click', function() {
			this.importantCheckbox.checked = false;
			this.importantActiveButton.classList.add("invisible");
			this.importantButton.classList.remove("invisible");
		}.bind(this));
	}
}

let form = new Form;