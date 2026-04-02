<div id="sidebar-container">
    <div>
        <!-- Title -->
        <h2 class="outfit" style="color:black; margin-bottom: 30px;">EZ-Tasking</h2>

        <!-- Navigation -->
        <nav>
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
            <p class="inter" style="width: 100%; font-weight: bold; text-align: center;">
                {{ auth()->user()->email }}
            </p>
        </div>

        <!-- Logout -->
        <form method="POST" action="/logout" style="margin-top: 20px;">
            @csrf
            <button type="submit" class="outfit"
                style="
                    background: #eee;
                    border: none;
                    padding: 10px;
                    width: 100%;
                    color: var(--red);
                    cursor: pointer;
                    border-radius: 5px;
                ">
                Logout
            </button>
        </form>
    </div>
</div>