<!DOCTYPE html>
<html>
<head>
    <title>Health Tools</title>
    <style>
        :root {
            --primary: #1a365d;    /* Azul escuro principal */
            --secondary: #2c5282;  /* Azul médio */
            --accent: #f6ad55;     /* Laranja para destaque */
            --light: #f7fafc;      /* Branco suave */
            --dark: #1a202c;       /* Preto azulado */
        }

        body {
            font-family: 'Segoe UI', system-ui, sans-serif;
            margin: 0;
            padding: 0 20px;
            min-height: 100vh;
            background-color: var(--light);
            color: var(--dark);
            line-height: 1.5;
        }

        nav {
            background: var(--primary);
            padding: 1rem;
            margin: 0 -20px;
            text-align: center;
        }

        nav a {
            color: white;
            text-decoration: none;
            margin: 0 1rem;
            padding: 0.5rem;
            display: inline-block;
            transition: color 0.3s ease;
        }

        nav a:hover {
            color: var(--accent);
        }

        .container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 2rem;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: var(--primary);
            margin-bottom: 2rem;
            text-align: center;
            font-size: 2rem;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            align-items: center;
        }

        .input-group {
            margin-bottom: 1rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--primary);
            font-weight: 500;
        }

        input, button {
            width: 100%;
            max-width: 300px;
            padding: 0.75rem;
            border: 1px solid #cbd5e0;
            border-radius: 6px;
            font-size: 1rem;
        }

        input:focus {
            outline: none;
            border-color: var(--secondary);
            box-shadow: 0 0 0 2px rgba(44, 82, 130, 0.2);
        }

        button {
            background: var(--primary);
            color: white;
            border: none;
            cursor: pointer;
            font-weight: 600;
            transition: background 0.3s ease;
        }

        button:hover {
            background: var(--secondary);
        }

        .result {
            margin-top: 2rem;
            padding: 1.5rem;
            background: #f8fafc;
            border-radius: 6px;
            border-left: 4px solid var(--accent);
        }

        .tool-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-top: 2rem;
        }

        .tool-card {
            padding: 1.5rem;
            background: white;
            border-radius: 8px;
            text-align: center;
            transition: transform 0.2s ease;
            border: 1px solid #e2e8f0;
        }

        .tool-card:hover {
            transform: translateY(-3px);
        }

        .tool-card a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
        }

        @media (max-width: 640px) {
            body {
                padding: 10px;
            }
            
            .container {
                padding: 1rem;
                margin: 1rem auto;
            }
            
            nav a {
                margin: 0 0.5rem;
                font-size: 0.9rem;
            }
            
            h1 {
                font-size: 1.5rem;
            }
            
            .tool-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <nav>
        <a href="/">Home</a> |
        <a href="/imc">IMC</a> |
        <a href="/sleep">Sono</a> |
        <a href="/travel">Viagem</a>
    </nav>

    @yield('content')
</body>
</html>