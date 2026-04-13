window.CRUD = (() => {

    const apiKeyMeta = document.querySelector('meta[name="api-key"]');
    const apiKey = apiKeyMeta ? apiKeyMeta.content : null;

    // Normalize API type
    function normalizeType(type) {
        if (type === 'project') return 'projects';
        if (type === 'task') return 'tasks';
        return type;
    }

    // Check API key
    function checkAPIKey() {
        if (!apiKey) {
            alert("Please generate an API key first!");
            window.location.href = '/docs';
            return false;
        }
        return true;
    }

    // Show form
    function showForm(formId) {
        if (!checkAPIKey()) return;

        const form = document.getElementById(formId);
        if (form) form.style.display = 'block';
    }

    // API request
    async function request(method, type, id = '', data = {}) {
        if (!checkAPIKey()) return;

        type = normalizeType(type);

        const url = `/api/${type}${id ? '/' + id : ''}`;

        const res = await fetch(url, {
            method,
            headers: {
                'Content-Type': 'application/json',
                'X-API-KEY': apiKey
            },
            body: method !== 'GET' && method !== 'DELETE'
                ? JSON.stringify(data)
                : null
        });

        if (!res.ok) throw new Error(`Failed ${method} ${type}`);
        return res.json();
    }

    // Render cards
    function render(containerId, item, type) {
        const container = document.getElementById(containerId);
        if (!container) return;

        // TASKS
        if (type === 'task') {
            container.insertAdjacentHTML('beforeend', `
                <div class="task-card" id="task-${item.id}">
                    <h4 class="${item.status === 'done' ? 'done' : ''}">
                        ${item.title}
                    </h4>

                    <span>Due: ${item.due_date || 'N/A'}</span>

                    <select onchange="CRUD.updateStatus(${item.id}, this.value, 'task')">
                        <option value="pending" ${item.status === 'pending' ? 'selected' : ''}>Pending</option>
                        <option value="done" ${item.status === 'done' ? 'selected' : ''}>Done</option>
                    </select>

                    <div class="task-actions">
                        <button onclick="CRUD.edit(${item.id}, '${item.title}', '${item.due_date}', '${item.status}', 'task')">
                            Edit
                        </button>

                        <button onclick="CRUD.delete(${item.id}, 'task')">
                            Delete
                        </button>
                    </div>
                </div>
            `);
        }

        // PROJECTS
        else if (type === 'project') {
            container.insertAdjacentHTML('beforeend', `
                <a class="project-card" id="project-${item.id}" href="/projects/${item.id}">

                    <h3>${item.title}</h3>
                    <p>${item.description || 'No description'}</p>

                    <br />
                    <p style="text-align:center;font-size:32px;">→</p>

                    <div class="task-actions">
                        <button onclick="event.preventDefault(); CRUD.edit(${item.id}, '${item.title}', '${item.description}', '', 'project')">
                            Edit
                        </button>

                        <button onclick="event.preventDefault(); CRUD.delete(${item.id}, 'project')">
                            Delete
                        </button>
                    </div>

                </a>
            `);
        }
    }

    // ADD
    async function add(containerId, type, data) {
        try {
            const item = await request('POST', type, '', data);
            render(containerId, item, type);
            resetForm(type);
        } catch (e) {
            console.error(e);
            alert('Error creating ' + type);
        }
    }

    // UPDATE
    async function update(id, type, data) {
        try {
            const item = await request('PUT', type, id, data);

            if (type === 'task') {
                const card = document.getElementById(`task-${id}`);
                if (card) {
                    card.querySelector('h4').textContent = item.title;
                    card.querySelector('span').textContent = `Due: ${item.due_date || 'N/A'}`;
                }
            }

            else if (type === 'project') {
                const card = document.getElementById(`project-${id}`);
                if (card) {
                    card.querySelector('h3').textContent = item.title;
                    card.querySelector('p').textContent = item.description || 'No description';
                }
            }

            resetForm(type);

        } catch (e) {
            console.error(e);
            alert('Error updating ' + type);
        }
    }

    // STATUS FOR TASKS ONLY
    async function updateStatus(id, status, type) {
        await update(id, type, { status });
    }

    // DELETE
    async function deleteItem(id, type) {
        if (!confirm(`Delete this ${type}?`)) return;

        try {
            await request('DELETE', type, id);

            const prefix = type === 'project' ? 'project' : 'task';
            const card = document.getElementById(`${prefix}-${id}`);

            if (card) card.remove();

        } catch (e) {
            console.error(e);
            alert('Error deleting ' + type);
        }
    }

    // EDIT
    function edit(id, title, extra1, extra2, type) {

        if (type === 'task') {
            const form = document.getElementById('new-task-form');
            if (!form) return;

            showForm('new-task-form');

            form.dataset.editId = id;
            form.querySelector('#task-title').value = title;
            form.querySelector('#task-due').value = extra1;
            form.querySelector('#task-status').value = extra2;

            const btn = form.querySelector('button');
            btn.textContent = 'Save Task';
            btn.onclick = () => saveForm('new-task-form', 'task');
        }

        else if (type === 'project') {
            const form = document.getElementById('new-project-form');
            if (!form) return;

            showForm('new-project-form');

            form.dataset.editId = id;
            form.querySelector('#project-title').value = title;
            form.querySelector('#project-description').value = extra1;

            const btn = form.querySelector('button');
            btn.textContent = 'Save Project';
            btn.onclick = () => saveForm('new-project-form', 'project');
        }
    }

    // SAVE FORM
    async function saveForm(formId, type, projectId = null) {
        const form = document.getElementById(formId);
        if (!form) return;

        let data = {};

        if (type === 'task') {
            data = {
                title: form.querySelector('#task-title').value,
                due_date: form.querySelector('#task-due').value,
                status: form.querySelector('#task-status').value,
                project_id: projectId
            };
        }

        else if (type === 'project') {
            data = {
                title: form.querySelector('#project-title').value,
                description: form.querySelector('#project-description').value
            };
        }

        if (form.dataset.editId) {
            await update(form.dataset.editId, type, data);
        } else {
            const container = type === 'task' ? 'tasks-list' : 'projects-list';
            await add(container, type, data);
        }
    }

    // RESET FORM
    function resetForm(type) {

        if (type === 'task') {
            const form = document.getElementById('new-task-form');
            if (!form) return;

            form.style.display = 'none';
            form.dataset.editId = '';
        }

        else if (type === 'project') {
            const form = document.getElementById('new-project-form');
            if (!form) return;

            form.style.display = 'none';
            form.dataset.editId = '';
        }
    }

    return {
        add,
        update,
        updateStatus,
        delete: deleteItem,
        edit,
        saveForm,
        render,
        showForm
    };

})();