class Form {
	constructor() {
		// Général
		this.task = document.querySelectorAll(".task");
		this.list = document.querySelectorAll(".list");
		this.days = document.querySelectorAll(".day");
		this.background = document.querySelector("#background");

		// Formulaire
		this.addTaskButton = document.querySelector(".fa-plus");
		this.closeButton = document.querySelector(".fa-times");
		this.taskForm = document.querySelector("#task-form");
		this.form = document.querySelector("#task-form form");
		this.formTitle = document.querySelector("#task-form h2");
		this.formText = document.querySelector("#task-form input[type='text']");
		this.formSubmit = document.querySelector("#task-form input[type='submit']");

		// Sous-formulaires
		this.importantButton = document.querySelector("#important");
		this.importantActiveButton = document.querySelector("#important_active");
		this.importantCheckbox = document.querySelector("#task-form form p span input[type='checkbox']");

		this.timeButton = document.querySelector("#time");
		this.timeMenu = document.querySelector("#time-menu");
		this.deadlineCheckbox = document.querySelector("#deadline_checkbox");
		this.reccuringCheckbox = document.querySelector("#reccuring_checkbox");
		this.reccuringLabel = document.querySelector("#reccuring_label");
		this.formDate = document.querySelector("#task-form input[type='date']");
		this.inputScheduleNumber = document.querySelector("#task-form input[type='number']");
		this.inputScheduleDelay = document.querySelector("#schedule_delay");
		
		this.listButton = document.querySelector("#list");
		this.listMenu = document.querySelector("#list-menu");
		this.listCheckbox = document.querySelector("#list_checkbox");
		this.inputList = document.querySelector("#list_select");

		// Formulaire d'ajout de liste
		this.listFormDiv = document.querySelector("#list-form");
		this.listForm = document.querySelector("#list-form form");
		this.listFormTitle = document.querySelector("#list-form h2");
		this.listFormSubmit = document.querySelector("#list-form input[type='submit']");
		this.addListButton = document.querySelector("#add-list");
		this.closeListForm = document.querySelector("#list-form i.fa-times");
		this.inputListName = document.querySelector("#list-form input[type='text']");
		this.inputListDescription = document.querySelector("#list-form textarea");

		// Boutons
		this.addAllTaskButton = document.querySelector(".addtask-all");
		this.addImportantTaskButton = document.querySelector(".addtask-important");
		this.addTodayTaskButton = document.querySelector(".addtask-today");

		// Popup
		this.popup = document.querySelector("#popup");
		this.closePopup = document.querySelector("#popup i.fa-times");
		this.popupText = document.querySelector("#popup p");
		this.popupYes = document.querySelector("#yes");
		this.popupNo = document.querySelector("#no");

		this.open();
		this.close();
		this.checkboxSubmit();
		this.setAttribute();
	}

	open() {
		// Ouverture du formulaire d'ajout de tâche
		this.addTaskButton.addEventListener("click", function () {
			// Vide le formulaire
			this.clear();
			// Ouvre le formulaire
			this.taskForm.classList.remove("invisible");
			this.background.classList.remove("invisible");
		}.bind(this));

		// Ouverture du formulaire de modification de tâche
		if(this.task !== null) {
			this.task.forEach(function (task) {
				// Récupération des valeurs des inputs
				let label = task.querySelector("label");
				let taskId = label.getAttribute("for");
				let taskName = label.innerHTML;
				let taskImportant = label.getAttribute("important");
				let taskEditButton = task.querySelector(".fa-edit");
				let taskDeleteButton = task.querySelector(".delete");
				let deadline = task.querySelector(".date").innerHTML.replace(/\//g, "-").split('-').reverse().join('-');
				let schedule = task.querySelector(".date").getAttribute("schedule");
				if (schedule !== null) { schedule = schedule.replace('+', '').split(' '); }
				let listValue = task.querySelector(".list");
				if (listValue !== null) { listValue = Number(listValue.getAttribute("list")); }
				else { listValue = Number(label.getAttribute("list")); }
				let reccuringTitle = task.getAttribute("title");
				if (reccuringTitle !== null) { 
					reccuringTitle = reccuringTitle.replace("+", "").replace("day", "jour(s)").replace("week", "semaine(s)").replace("month", "mois").replace("year", "an(s)");
					task.setAttribute("title", reccuringTitle);
				}

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

						// Gestion des sous-menus
						if(this.timeMenu.className !== "invisible") {
							this.timeMenu.classList.add("invisible");
						}

						if(this.listMenu.className !== "invisible") {
							this.listMenu.classList.add("invisible");
						}

						// Vérifie si la tâche à une date d'échéance
						if (this.formDate.value !== '') {
							this.deadlineCheckbox.checked = true;
							this.reccuringCheckbox.removeAttribute('disabled');
							this.reccuringLabel.style.color = "#000";
							this.formDate.removeAttribute('disabled');
						}
						else {
							this.deadlineCheckbox.checked = false;
							this.reccuringCheckbox.setAttribute('disabled', 'disabled');
							this.formDate.setAttribute('disabled', 'disabled');
						}

						// Vérifie si la tâche à une récurrence
						if (this.inputScheduleNumber.value !== '') {
							this.reccuringCheckbox.checked = true;
							this.inputScheduleNumber.removeAttribute('disabled');
							this.inputScheduleDelay.removeAttribute('disabled');
						}
						else {
							this.reccuringCheckbox.checked = false;
							this.inputScheduleNumber.setAttribute('disabled', 'disabled');
							this.inputScheduleDelay.setAttribute('disabled', 'disabled');
						}

						// Passe certains input en requis si la checkbox correspondante est cochée
						if (this.deadlineCheckbox.checked == true) {
							this.formDate.setAttribute('required', '');
						}
						else {
							this.formDate.removeAttribute('required');
						}

						if (this.reccuringCheckbox.checked == true) {
							this.inputScheduleNumber.setAttribute('required', '');
							this.inputScheduleDelay.setAttribute('required', '');
						}
						else {
							this.inputScheduleNumber.removeAttribute('required');
							this.inputScheduleDelay.removeAttribute('required');
						}

						if (this.listCheckbox.checked == true) {
							this.inputList.setAttribute('required', '');
						}
						else {
							this.inputList.removeAttribute('required');
						}

						// Vérifie si la tâche appartient à une liste
						if (listValue !== 0) {
							this.listCheckbox.checked = true;
							this.inputList.removeAttribute('disabled');
							this.inputList.value = listValue;
						}
						else {
							this.listCheckbox.checked = false;
							this.inputList.setAttribute('disabled', 'disabled');
							this.inputList.value = "";
						}

						// Ouverture du formulaire des tâches
						this.taskForm.classList.remove("invisible");
						this.background.classList.remove("invisible");
					}.bind(this));
				};

				if(taskDeleteButton !== null) {
					taskDeleteButton.addEventListener("click", function() {
						// Affichage de la popup de confirmation de suppression si la tâche a une récurrence
						this.popup.classList.remove("invisible");
						this.popupText.textContent = "Voulez-vous aussi supprimer les répétitions prévues pour cette tâche ?";
						this.popupYes.setAttribute("href", "index.php?action=deleteTask&id=" + taskId + "&reccuring=true");
						this.popupNo.setAttribute("href", "index.php?action=deleteTask&id=" + taskId);
						this.background.classList.remove("invisible");
					}.bind(this));
				}
			}.bind(this));
		};

		// Ouverture du sous-formulaire de planification
		this.timeButton.addEventListener("click", function () {
			this.timeMenu.classList.toggle("invisible");
			if(this.listMenu.className !== "invisible") {
				this.listMenu.classList.add("invisible");
			}
		}.bind(this));

		// Ouverture du sous-formulaire de liste
		this.listButton.addEventListener("click", function () {
			this.listMenu.classList.toggle("invisible");
			if(this.timeMenu.className !== "invisible") {
				this.timeMenu.classList.add("invisible");
			}
		}.bind(this));

		// Différentes ouvertures du menu d'ajout de tâche
		if (this.addAllTaskButton !== null) {
			this.addAllTaskButton.addEventListener("click", function () {
				this.clear();

				this.taskForm.classList.remove("invisible");
				this.background.classList.remove("invisible");
			}.bind(this));
		}

		if (this.addImportantTaskButton !== null) {
			this.addImportantTaskButton.addEventListener("click", function () {
				this.clear();
				this.importantCheckbox.checked = true;
				this.importantButton.classList.add("invisible");
				this.importantActiveButton.classList.remove("invisible");

				this.taskForm.classList.remove("invisible");
				this.background.classList.remove("invisible");
			}.bind(this));
		}

		if (this.addTodayTaskButton !== null) {
			this.addTodayTaskButton.addEventListener("click", function () {
				let deadline = new Date();
				let year = deadline.getFullYear();
				let month = deadline.getMonth() + 1;
				let day = deadline.getDate();
				if (month < 10) { month = "0" + month; }
				if (day < 10) { day = "0" + day; }
				deadline = year + "-" + month + "-" + day;

				this.clear();
				this.deadlineCheckbox.checked = true;
				this.formDate.value = deadline;
				this.reccuringCheckbox.removeAttribute('disabled');
				this.reccuringLabel.style.color = "#000";
				this.inputScheduleNumber.removeAttribute('disabled');
				this.inputScheduleDelay.removeAttribute('disabled');
				this.timeMenu.classList.remove("invisible");

				this.taskForm.classList.remove("invisible");
				this.background.classList.remove("invisible");
			}.bind(this));
		}

		if (this.days !== null) {
			this.days.forEach(function (day) {
				let deadline = day.getAttribute("date");
				let addDayTaskButton = day.querySelector(".addtask-day");
				addDayTaskButton.addEventListener("click", function () {
					this.clear();
					this.deadlineCheckbox.checked = true;
					this.formDate.value = deadline;
					this.formDate.removeAttribute('disabled');
					this.reccuringCheckbox.removeAttribute('disabled');
					this.reccuringLabel.style.color = "#000";
					this.timeMenu.classList.remove("invisible");

					this.taskForm.classList.remove("invisible");
					this.background.classList.remove("invisible");
				}.bind(this));
			}.bind(this));
		}

		// Ouverture du formulaire d'ajout de liste
		if (this.addListButton !== null) {
			this.addListButton.addEventListener("click", function() {
				// Vide le formulaire
				this.listFormTitle.textContent = "Créer une liste";
				this.inputListName.value = "";
				this.inputListDescription.value = "";
				this.listFormSubmit.value = "Créer";

				this.listFormDiv.classList.remove("invisible");
				this.background.classList.remove("invisible");
			}.bind(this));
		}

		// Ouverture du formulaire de modification de liste
		if(this.list !== null) {
			this.list.forEach(function (list) {
				// Récupération des valeurs des inputs
				let listId = list.getAttribute("list");
				let listName = list.querySelector(".list-name").textContent;
				let listDescription = list.querySelector(".list-description");
				if (listDescription !== null) { listDescription = listDescription.textContent };
				let listEditButton = list.querySelector("span.edit");
				let listDeleteButton = list.querySelector("span.delete");
				let listAddTaskButtons = list.querySelectorAll(".addtask-list");
				let taskExist = list.querySelector("tr.task");

				// Ouverture du formulaire d'ajout de tâche depuis la page des listes
				if(listAddTaskButtons !== null) {
					listAddTaskButtons.forEach(function (listAddTaskButton) {
						listAddTaskButton.addEventListener("click", function () {
							// Vide le formulaire et pré-remplis le sous-formulaire de liste
							this.clear();
							this.listCheckbox.checked = true;
							this.inputList.value = listId;
							this.inputList.setAttribute('required', '');
							this.inputList.removeAttribute('disabled');
							this.listMenu.classList.remove("invisible");

							// Ouvre le formulaire
							this.taskForm.classList.remove("invisible");
							this.background.classList.remove("invisible");
						}.bind(this));
					}.bind(this));
				}

				if(listEditButton !== null) {
					listEditButton.addEventListener("click", function() {
						// Remplis le formulaire suivant la tâche selectionnée
						this.listForm.setAttribute("action", "index.php?action=editList&id=" + listId);
						this.listFormTitle.textContent = "Modifier une liste";
						this.inputListName.value = listName;
						this.inputListDescription.value = listDescription;
						this.listFormSubmit.value = "Enregistrer";

						this.listFormDiv.classList.remove("invisible");
						this.background.classList.remove("invisible");
					}.bind(this));
				}

				if(listDeleteButton !== null) {
					listDeleteButton.addEventListener("click", function() {
						if(taskExist !== null) {
							// Affichage d'une pop-up de confirmation de suppression d'une liste
							this.popup.classList.remove("invisible");
							this.popupText.textContent = "Voulez-vous aussi supprimer les tâches de cette liste ?";
							this.popupYes.setAttribute("href", "index.php?action=deleteList&id=" + listId + "&tasks=true");
							this.popupNo.setAttribute("href", "index.php?action=deleteList&id=" + listId);
							this.background.classList.remove("invisible");
						}
						else {
							document.location.href = "index.php?action=deleteList&id=" + listId; 
						}
					}.bind(this));
				}
			}.bind(this));
		}

		// Fermeture du formulaire de liste
		if (this.closeListForm !== null) {
			this.closeListForm.addEventListener("click", function() {
				this.listFormDiv.classList.add("invisible");
				this.background.classList.add("invisible");
			}.bind(this));
		}
	}

	close() {
		// Fermeture des formulaire par le background
		this.background.addEventListener("click", function () {
			this.background.classList.add("invisible");
			if (this.taskForm.className !== "invisible") {
				this.taskForm.classList.add("invisible");
			}
			if (this.listFormDiv !== null) {
				if (this.listFormDiv.className !== "invisible") {
					this.listFormDiv.classList.add("invisible");
				}
			}
			if (this.popup.className !== "invisible") {
				this.popup.classList.add("invisible");
			}
		}.bind(this));
		// Fermeture des formulaires par la croix
		this.closeButton.addEventListener("click", function () {
			this.taskForm.classList.add("invisible");
			this.background.classList.add("invisible");
		}.bind(this));
		if(this.closeListForm !== null) {
			this.closeListForm.addEventListener("click", function () {
				this.listFormDiv.classList.add("invisible");
				this.background.classList.add("invisible");
			}.bind(this));
		}
		this.closePopup.addEventListener("click", function () {
			this.popup.classList.add("invisible");
			this.background.classList.add("invisible");
		}.bind(this));
	}

	clear() {
	// Vide le formulaire d'ajout de tâche
		this.form.setAttribute("action", "index.php?action=addTask");
		this.formTitle.textContent = "Ajouter une tâche";
		this.formText.value = '';
		this.formDate.value = '';
		this.formDate.setAttribute('disabled', 'disabled');
		this.formDate.removeAttribute('required');
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
		this.inputScheduleNumber.removeAttribute('required');
		this.inputScheduleDelay.removeAttribute('required');
		this.listCheckbox.checked = false;
		this.inputList.value = '';
		this.inputList.setAttribute('disabled', 'disabled');
		this.inputList.removeAttribute('required');
		if (this.importantActiveButton.className !== "invisible") {
			this.importantActiveButton.classList.add("invisible");
			this.importantButton.classList.remove("invisible");
		}
		if(this.timeMenu.className !== "invisible") {	
			this.timeMenu.classList.add("invisible");
		}
		if(this.listMenu.className !== "invisible") {	
			this.listMenu.classList.add("invisible");
		}
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
				this.formDate.setAttribute('required', '');
				this.formDate.removeAttribute('disabled');
			}
			else {
				this.reccuringCheckbox.setAttribute('disabled', 'disabled');
				this.reccuringLabel.style.color = "#808080";
				this.formDate.removeAttribute('required');
				this.formDate.setAttribute('disabled', 'disabled');
			}
		}.bind(this));

		this.reccuringCheckbox.addEventListener('click', function() {
			if (this.reccuringCheckbox.checked == true) {
				this.inputScheduleNumber.removeAttribute('disabled');
				this.inputScheduleDelay.removeAttribute('disabled');
				this.inputScheduleNumber.setAttribute('required', '');
				this.inputScheduleDelay.setAttribute('required', '');
			}
			else {
				this.inputScheduleNumber.removeAttribute('required');
				this.inputScheduleDelay.removeAttribute('required');
				this.inputScheduleNumber.setAttribute('disabled', 'disabled');
				this.inputScheduleDelay.setAttribute('disabled', 'disabled');
			}
		}.bind(this));

		this.listCheckbox.addEventListener('click', function() {
			if (this.listCheckbox.checked == true) {
				this.inputList.removeAttribute('disabled');
				this.inputList.setAttribute('required', '');
			}
			else {
				this.inputList.setAttribute('disabled', 'disabled');
				this.inputList.removeAttribute('required');
			}
		}.bind(this));
	}
}

let form = new Form;