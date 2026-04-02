<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title')</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">

    <style>
        .outfit {
            font-family: "Outfit", sans-serif;
            font-optical-sizing: auto;
            font-weight: 700;
            font-style: normal;
        }


        .inter {
            font-family: "Inter", sans-serif;
            font-optical-sizing: auto;
            font-weight: 400;
            font-style: normal;
        }

        :root {
            --red: #FF5B5B;
        }

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
            background:
        }

        main {
            --sidebarMargin: 250px;

            margin-left: var(--sidebarMargin); /* Because of sidebar */
            
            padding: 20px 32px;
            padding-left: 40px;

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

            font-family: "Inter", sans-serif;
            font-optical-sizing: auto;
            font-weight: 400;
            font-style: normal;
        }

        .link:hover {
            text-decoration: 2px underline;
        }

        .link.indent {
            padding-left: 16px;
        }

        /* Sidebar CSS */
        #sidebar-container {
            width: 250px;
            height: 100vh; 
            padding: 20px;

            background-color: var(--red);
            color: #eee;

            border-right: 8px solid var(--red);
            
            position: fixed;
            left: 0;
            top: 0;
            
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        #sidebar-container nav {
            display: flex; flex-direction: column; gap: 10px; margin-bottom: 30px;
        }
    </style>

    @yield('head') <!-- For pages to insert their own script/css imports -->
</head>

<body>
    @include('components.sidebar')

    <main>
        <div class="content">
            @yield('content')
        </div>
    </main>
</body>
</html>
