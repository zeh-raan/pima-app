<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title')</title>
    @yield('head') <!-- For pages to insert their own script/css imports -->

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
    </style>
</head>

<body>
    @include('components.sidebar')

    <main>
        <div class="content">
            @yield('content')
        </div>

        {{--
            <!-- Footer can be omitted -->
            <footer>
                &copy; 2026 PiMA App
            </footer>
        --}}
    </main>
</body>
</html>
