<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title')</title>

    <style>
        * {
            margin: 0px;
            padding: 0px;
            box-sizing: border-box;
        }

        html, body {
            scroll-behavior: smooth;
        }

        body {
            width: 100vw;
            height: 100vh;
        }

        main {
            --sidebarMargin: 250px;

            margin-left: var(--sidebarMargin); /* Because of sidebar */
            padding: 20px 32px;
            width: calc(100vw - var(--sidebarMargin));
            min-height: 100vh;

            display: flex;
            flex-direction: column;
        }

        footer {
            padding: 15px;
            text-align: center;
            color: #777;
            font-size: 14px;
            border-top: 1px solid #ddd;
            background: white;
        }

        .link {
            color: #fff;
            text-decoration:none;
        }

        .link:hover {
            text-decoration:underline;
        }

        .link.indent {
            padding-left: 16px;
        }

        /* TODO: Move this to its own CSS file */
        /* For docs */
        .codebox-wrapper {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .codebox, .codeblock {
            padding: 8px 12px;
            background: #eee;
            border-radius: 8px;
            display: inline-block;
            font-family: monospace;
        }

        .codeblock {
            width: 95%;
            padding: 16px 20px;
            margin-top: 8px;
        }

        .copy-btn {
            padding: 10px 12px;
            background: #00f;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        .api-key-btn {
            padding: 8px 12px;
            background-color: #00f;
            color: #fff;

            border: none;
            outline: none;
            border-radius: 6px;
            cursor: pointer;
        }

        .docs-container {
            display: flex;
            flex-direction: column;
            gap: 32px;
        }

        .endpoints-list {
            margin-left: 20px;
        }

        .endpoints-list li {
            margin-bottom: 32px;
            padding-left: 8px;
        }
    </style>
</head>

<body>
    @include('components.sidebar')

    <main>
        <div class="content">
            @yield('content')
        </div>

        <!-- Footer can be omitted -->
        <footer>
            &copy; 2026 PiMA App
        </footer>
    </main>
</body>
</html>
