class Form {
	constructor() {
		this.task = document.querySelectorAll(".task");
		this.addTaskButton = document.querySelector(".fa-plus");
		this.closeButton = document.querySelector(".fa-times");
		this.taskForm = document.querySelector("#task-form");
		this.background = document.querySelector("#background");

		this.form = document.querySelector("#task-form form");
		this.formTitle = document.querySelector("#task-form h2");
		this.formText = document.querySelector("#task-form input[type='text']");
		this.formDate = document.querySelector("#task-form input[type='date']");
		this.inputScheduleNumber = document.querySelector("#task-form input[type='number']");
		this.inputScheduleDelay = document.querySelector("#schedule_delay");
		this.formSubmit = document.querySelector("#task-form input[type='submit']");

		this.importantButton = document.querySelector("#important");
		this.importantActiveButton = document.querySelector("#important_active");
		this.importantCheckbox = document.querySelector("#task-form form p span input[type='checkbox']");
		this.timeButton = document.querySelector("#time");
		this.timeMenu = document.querySelector("#time-menu");
		this.deadlineCheckbox = document.querySelector("#deadline_checkbox");
		this.reccuringCheckbox = document.querySelector("#reccuring_checkbox");
		this.reccuringLabel = document.querySelector("#reccuring_label");

		this.open();
		this.close();
		this.checkboxSubmit();
		this.setAttribute();
	}

	open() {
		// Ouverture du formulaire d'ajout
		this.addTaskButton.addEventListener("click", function () {
			// Vide le formulaire
			this.form.setAttribute("action", "index.php?action=addTask");
			this.formTitle.textContent = "Ajouter une tâche";
			this.formText.value = '';
			this.formDate.value = '';
			this.inputScheduleNumber.value = '';
			this.inputScheduleDelay.value = 'day';
			this.formSubmit.value = "Ajouter";
			this.deadlineCheckbox.checked = false;
			this.importantCheckbox.checked = false;
			this.reccuringCheckbox.checked = false;
			this.reccuringCheckbox.setAttribute('disabled', 'disabled');
			this.reccuringLabel.style.color = "#808080";
			this.inputScheduleNumber.setAttribute('disabled', 'disabled');
			this.inputScheduleDelay.setAttribute('disabled', 'disabled');
			if (this.importantActiveButton.className !== "invisible") {
				this.importantActiveButton.classList.add("invisible");
				this.importantButton.classList.remove("invisible");
			}
			if(this.timeMenu.className !== "invisible") {	
				this.timeMenu.classList.add("invisible");
			}

			// Ouvre le formulaire
			this.toggleInvisible();
		}.bind(this));

		// Ouverture du formulaire de modification
		if(this.task !== null) {
			this.task.forEach(function (task) {
				// Récupération des valeurs des inputs
				let label = task.querySelector("label");
				let taskId = label.getAttribute("for");
				let taskName = label.innerHTML;
				let taskImportant = label.getAttribute("important");
				let taskEditButton = task.querySelector(".fa-edit");
				let deadline = task.querySelector(".date").innerHTML.replace(/\//g, "-").split('-').reverse().join('-');
				let schedule = task.querySelector(".date").getAttribute("schedule");
				if (schedule !== null) { schedule = schedule.replace('+', '').split(' '); }

				if(taskEditButton !== null) {
					taskEditButton.addEventListener("click", function() {
						// Remplis le formulaire suivant la tâche selectionnée
						this.form.setAttribute("action", "index.php?action=editTask&id=" + taskId);
						this.formTitle.textContent = "Modifier une tâche";
						this.formText.value = taskName;
						if (deadline !== null) { this.formDate.value = deadline } else { this.formDate.value = '' };
						if (schedule !== null) {
							this.inputScheduleNumber.value = schedule[0];
							this.inputScheduleDelay.value = schedule[1]; 
						}
						else {
							this.inputScheduleNumber.value = '';
							this.inputScheduleDelay.value = 'day';
						}
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
							this.deadlineCheckbox.checked = true;
							this.reccuringCheckbox.removeAttribute('disabled');
							this.reccuringLabel.style.color = "#000";
							this.inputScheduleNumber.removeAttribute('disabled');
							this.inputScheduleDelay.removeAttribute('disabled');
						}
						else {
							this.deadlineCheckbox.checked = false;
							this.reccuringCheckbox.setAttribute('disabled', 'disabled');
							this.inputScheduleNumber.setAttribute('disabled', 'disabled');
							this.inputScheduleDelay.setAttribute('disabled', 'disabled');
						}

						// Passe l'input "date" en requis et active les input de récurrence si la checkbox correspondante est cochée
						if (this.deadlineCheckbox.checked == true) {
								this.formDate.setAttribute('required', '');
							}
						else {
							this.formDate.removeAttribute('required');
						}

						// Vérifie si la tâche à une récurrence
						if (this.inputScheduleNumber.value !== '') {
							this.reccuringCheckbox.checked = true;
						}
						else {
							this.reccuringCheckbox.checked = false;
						}

						// Passe les input number et select en requis si la checkbox correspondante est cochée
						if (this.reccuringCheckbox.checked == true) {
								this.inputScheduleNumber.setAttribute('required', '');
								this.inputScheduleDelay.setAttribute('required', '');
							}
						else {
							this.inputScheduleNumber.removeAttribute('required');
							this.inputScheduleDelay.removeAttribute('required');
						}

						// Ouverture du formulaire
						this.toggleInvisible();
					}.bind(this));
				};
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
		// Validation dynamique des tâches en BDD
		if(this.task !== null) {
			this.task.forEach(function (task) {
				let checkbox = task.querySelector("input[type='checkbox']");
				let label = task.querySelector("label");
				let taskId = checkbox.getAttribute("id");

				if (checkbox.checked === true) {
					label.style.color = "#808080";
					label.style.textDecoration = "line-through";
				}
				else {
					label.style.color = "#000";
					label.style.textDecoration = "none";
				}

				checkbox.addEventListener('click', function() {
					let data = new FormData();
					if (checkbox.checked === true) {
						data.append("done", 1);
						label.style.color = "#808080";
						label.style.textDecoration = "line-through";
					}
					else {
						data.append("done", 0);
						label.style.color = "#000";
						label.style.textDecoration = "none";
					}
					data.append("task_id", taskId);
					ajaxPost("include/checkbox.php", data, function() {});
				});
			});
		};
	}

	setAttribute() {
		// Remplacement de la checkbox "Important" par une icône
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

		// Gestion des attributs des input en fonction de si la checkbox correspondante est cochée ou non
		this.deadlineCheckbox.addEventListener('click', function() {
			if (this.deadlineCheckbox.checked == true) {
				this.reccuringCheckbox.removeAttribute('disabled');
				this.reccuringLabel.style.color = "#000";
				this.inputScheduleNumber.removeAttribute('disabled');
				this.inputScheduleDelay.removeAttribute('disabled');
				this.formDate.setAttribute('required', '');
			}
			else {
				this.reccuringCheckbox.setAttribute('disabled', 'disabled');
				this.reccuringLabel.style.color = "#808080";
				this.inputScheduleNumber.setAttribute('disabled', 'disabled');
				this.inputScheduleDelay.setAttribute('disabled', 'disabled');
				this.formDate.removeAttribute('required');
			}
		}.bind(this));

		this.reccuringCheckbox.addEventListener('click', function() {
			if (this.reccuringCheckbox.checked == true) {
				this.inputScheduleNumber.setAttribute('required', '');
				this.inputScheduleDelay.setAttribute('required', '');
			}
			else {
				this.inputScheduleNumber.removeAttribute('required');
				this.inputScheduleDelay.removeAttribute('required');
			}
		}.bind(this));
	}
}

let form = new Form;