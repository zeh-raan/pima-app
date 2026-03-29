<div style="width: 250px; height: 100vh; background: #111; color: white; padding: 20px; position: fixed; left: 0; top: 0; display: flex; flex-direction: column; justify-content: space-between;">
    <div>

        <!-- Title -->
        <h2 style="margin-bottom: 30px;">PIMA App</h2>

        <!-- Navigation -->
        <nav style="display: flex; flex-direction: column; gap: 10px; margin-bottom: 30px;">
            <a href="/" class="link">Home</a>
            <a href="/docs#" class="link">Docs</a>
            <a href="/docs#get-started" class="link indent">Get started</a>
            <a href="/docs#projects-endpoint" class="link indent">Project endpoints</a>
            <a href="/docs#tasks-endpoint" class="link indent">Task endpoints</a>
            <a href="/docs#advanced-query" class="link indent">Advanced querying</a>
        </nav>
    </div>

    <div>
        <!-- User Info -->
        <div style="margin-top: 20px;">
            <p style="font-size: 12px; color: #aaa;">Currently logged in as:</p>
            <p style="font-weight: bold;">
                {{ auth()->user()->email }}
            </p>
        </div>

        <!-- Logout -->
        <form method="POST" action="/logout" style="margin-top: 20px;">
            @csrf
            <button type="submit"
                style="
                    background: #ff4d4d;
                    border: none;
                    padding: 10px;
                    width: 100%;
                    color: white;
                    cursor: pointer;
                    border-radius: 5px;
                ">
                Logout
            </button>
        </form>
    </div>
</div>