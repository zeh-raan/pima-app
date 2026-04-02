// crud.js
window.CRUD = (() => {
    const apiKeyMeta = document.querySelector('meta[name="api-key"]');
    const apiKey = apiKeyMeta ? apiKeyMeta.content : null;

    //  Check API Key 
    function checkAPIKey() {
        if (!apiKey) {
            alert("Please generate an API key first!");
            window.location.href = '/docs';
            return false;
        }
        return true;
    }

    //  Open form safely 
    function showForm(formId) {
        if (!checkAPIKey()) return;
        const form = document.getElementById(formId);
        if (form) form.style.display = 'block';
    }

    //  Make API request 
    async function request(method, type, id = '', data = {}) {
        if (!checkAPIKey()) return;
        const url = `/api/${type}${id ? '/' + id : ''}`;
        const res = await fetch(url, {
            method,
            headers: {
                'Content-Type': 'application/json',
                'X-API-KEY': apiKey
            },
            body: method !== 'GET' && method !== 'DELETE' ? JSON.stringify(data) : null
        });
        if (!res.ok) throw new Error(`Failed ${method} ${type}`);
        return res.json();
    }

    //  Render item card 
    function render(containerId, item, type = 'task') {
        const container = document.getElementById(containerId);
        if (!container) return;

        if (type === 'task') {
            container.insertAdjacentHTML('beforeend', `
            <div class="task-card" id="${type}-${item.id}">
                <h4 class="outfit ${item.status==='done'?'done':''}">${item.title}</h4>
                <span class="task-due">Due: ${item.due_date || 'N/A'}</span>
                <select onchange="CRUD.updateStatus(${item.id}, this.value, '${type}')">
                    <option value="pending" ${item.status==='pending'?'selected':''}>Pending</option>
                    <option value="done" ${item.status==='done'?'selected':''}>Done</option>
                </select>
                <div class="task-actions">
                    <button onclick="CRUD.edit(${item.id}, '${item.title}', '${item.due_date}', '${item.status}', '${type}')">Edit</button>
                    <button onclick="CRUD.delete(${item.id}, '${type}')">Delete</button>
                </div>
            </div>`);
        }

        // ELSE IF FOR PROJECT HERE *******************************
    }

    //  Add 
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

    //  Update 
    async function update(id, type, data) {
        try {
            const item = await request('PUT', type, id, data);
            if (type === 'task') {
                const card = document.getElementById(`${type}-${id}`);
                if (card) {
                    card.querySelector('h4').textContent = item.title;
                    card.querySelector('.task-due').textContent = `Due: ${item.due_date || 'N/A'}`;
                    card.querySelector('select').value = item.status;
                }
            }
            resetForm(type);
        } catch (e) {
            console.error(e);
            alert('Error updating ' + type);
        }
    }

    //  Update status 
    async function updateStatus(id, status, type) {
        await update(id, type, { status });
    }

    //  Delete 
    async function deleteItem(id, type) {
        if (!confirm(`Are you sure you want to delete this ${type}?`)) return;
        try {
            await request('DELETE', type, id);
            const card = document.getElementById(`${type}-${id}`);
            if (card) card.remove();
        } catch (e) {
            console.error(e);
            alert('Error deleting ' + type);
        }
    }

    //  Open edit form 
    function edit(id, title, dueDate, status, type) {
        const form = document.getElementById('new-task-form'); // Currently only task form
        if (!form) return;

        showForm('new-task-form');

        form.dataset.editId = id;
        form.querySelector('#task-title').value = title;
        form.querySelector('#task-due').value = dueDate;
        form.querySelector('#task-status').value = status;

        const btn = form.querySelector('button');
        btn.textContent = 'Save';
        btn.onclick = () => saveForm('new-task-form', type, form.dataset.projectId);
    }

    //  Save form (create or update) 
    async function saveForm(formId, type, projectId = null) {
        const form = document.getElementById(formId);
        if (!form) return;

        const title = form.querySelector('#task-title').value;
        const dueDate = form.querySelector('#task-due').value;
        const status = form.querySelector('#task-status').value;

        if (form.dataset.editId) {
            await update(form.dataset.editId, type, { title, due_date: dueDate, status });
        } else {
            await add('tasks-list', type, { title, due_date: dueDate, status, project_id: projectId });
        }
    }

    //  Reset form 
    function resetForm(type) {
        const form = document.getElementById('new-task-form');
        if (!form) return;

        form.style.display = 'none';
        form.dataset.editId = '';
        form.querySelector('#task-title').value = '';
        form.querySelector('#task-due').value = '';
        form.querySelector('#task-status').value = 'pending';
        form.querySelector('button').textContent = 'Add Task';
    }

    return { add, update, updateStatus, delete: deleteItem, edit, saveForm, render, showForm };
})();