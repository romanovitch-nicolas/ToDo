class Form {
	constructor() {
		this.addTaskButton = document.querySelector(".fa-plus");
		this.task = document.querySelectorAll("tr");
		this.closeButton = document.querySelector(".fa-times");
		this.taskForm = document.querySelector("#task-form");
		this.form = document.querySelector("#task-form form");
		this.formTitle = document.querySelector("#task-form h2");
		this.formText = document.querySelector("#task-form input[type='text']");
		this.formSubmit = document.querySelector("#task-form input[type='submit']");
		this.checkbox = document.querySelectorAll("input[type='checkbox']");
		this.background = document.querySelector("#background");
		this.open();
		this.close();
		this.checkboxSubmit();
	}

	open() {
		// Ouverture du formulaire d'ajout
		this.addTaskButton.addEventListener("click", function () {
			this.form.setAttribute("action", "index.php?action=addTask");
			this.formTitle.textContent = "Ajouter une tâche";
			this.formText.value = '';
			this.formSubmit.value = "Ajouter";
			this.toggleInvisible();
		}.bind(this));

		// Ouverture du formulaire de modification
		if(this.task !== null) {
			this.task.forEach(function (task) {
				let label = task.querySelector("label");
				let taskId = label.getAttribute("for");
				let taskName = label.innerHTML;
				let taskEditButton = task.querySelector(".fa-edit");
				taskEditButton.addEventListener("click", function() {
					this.form.setAttribute("action", "index.php?action=editTask&id=" + taskId);
					this.formTitle.textContent = "Modifier une tâche";
					this.formText.value = taskName;
					this.formSubmit.value = "Enregistrer";
					this.toggleInvisible();
				}.bind(this));
			}.bind(this));
		};
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
}

let form = new Form;