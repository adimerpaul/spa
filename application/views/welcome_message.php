<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Ingreso | Esencia Spa Médico</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="<?=base_url()?>assets/images/icon/favicon-esencia.ico">
    <link rel="icon" type="image/png" sizes="32x32" href="<?=base_url()?>assets/images/icon/favicon-esencia-32.png">
    <link rel="apple-touch-icon" href="<?=base_url()?>assets/images/icon/apple-touch-icon.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?=base_url()?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/css/themify-icons.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/css/toastr.min.css">
    <style>
        :root {
            --slate: #5e768a;
            --slate-dark: #4a5f71;
            --sage: #89bcab;
            --sage-light: #cedad6;
            --text: #3d4b57;
            --muted: #8a97a3;
            --border: #dde4e8;
        }

        * { box-sizing: border-box; }

        html, body { height: 100%; }

        body {
            margin: 0;
            font-family: 'Montserrat', sans-serif;
            color: var(--text);
            background: linear-gradient(135deg, var(--slate) 0%, #7399a0 50%, var(--sage) 100%);
            background-attachment: fixed;
        }

        .login-wrap {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 32px 16px;
            position: relative;
            overflow: hidden;
        }

        /* Formas suaves de fondo */
        .login-wrap::before,
        .login-wrap::after {
            content: "";
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, .08);
            pointer-events: none;
        }
        .login-wrap::before { width: 520px; height: 520px; top: -180px; left: -160px; }
        .login-wrap::after  { width: 420px; height: 420px; bottom: -160px; right: -120px; }

        .login-card {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 920px;
            display: flex;
            background: #fff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 25px 60px rgba(40, 60, 75, .25);
        }

        /* Panel izquierdo con degradado */
        .login-side {
            flex: 1 1 45%;
            padding: 48px 40px;
            color: #fff;
            background: linear-gradient(160deg, var(--slate) 0%, var(--sage) 100%);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
        }
        .login-side::after {
            content: "";
            position: absolute;
            width: 260px; height: 260px;
            right: -90px; bottom: -90px;
            border: 2px solid rgba(255, 255, 255, .18);
            border-radius: 50%;
        }
        .login-side h2 {
            font-size: 28px;
            font-weight: 600;
            line-height: 1.3;
            color: #fff;
            margin: 0 0 16px;
        }
        .login-side p {
            font-size: 14px;
            line-height: 1.7;
            color: rgba(255, 255, 255, .85);
            margin: 0;
        }
        .login-side .tag {
            font-size: 12px;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: rgba(255, 255, 255, .75);
        }

        /* Formulario */
        .login-main {
            flex: 1 1 55%;
            padding: 48px 56px;
        }
        .login-logo {
            display: block;
            width: 190px;
            max-width: 70%;
            margin: 0 auto 28px;
        }
        .login-main h1 {
            font-size: 20px;
            font-weight: 600;
            color: var(--slate-dark);
            text-align: center;
            margin: 0 0 6px;
        }
        .login-main .subtitle {
            font-size: 13px;
            color: var(--muted);
            text-align: center;
            margin: 0 0 32px;
        }

        .field { margin-bottom: 20px; }
        .field label {
            display: block;
            font-size: 12px;
            font-weight: 600;
            color: var(--slate);
            margin-bottom: 8px;
            letter-spacing: .3px;
        }
        .input-icon { position: relative; }
        .input-icon i {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--muted);
            font-size: 15px;
            transition: color .2s;
        }
        .input-icon input {
            width: 100%;
            height: 48px;
            padding: 0 44px 0 46px;
            font-family: inherit;
            font-size: 14px;
            color: var(--text);
            background: #f7f9fa;
            border: 1px solid var(--border);
            border-radius: 10px;
            outline: none;
            transition: border-color .2s, box-shadow .2s, background .2s;
        }
        .input-icon input:focus {
            background: #fff;
            border-color: var(--sage);
            box-shadow: 0 0 0 4px rgba(137, 188, 171, .2);
        }
        .input-icon input:focus + i,
        .input-icon input:focus ~ i { color: var(--sage); }
        .toggle-pass {
            position: absolute;
            right: 6px;
            top: 50%;
            transform: translateY(-50%);
            border: 0;
            background: transparent;
            color: var(--muted);
            padding: 8px 10px;
            cursor: pointer;
        }
        .toggle-pass:hover { color: var(--slate); }

        .login-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 13px;
            margin: 4px 0 28px;
        }
        .login-options label {
            display: flex;
            align-items: center;
            gap: 8px;
            margin: 0;
            color: var(--muted);
            cursor: pointer;
        }
        .login-options input[type=checkbox] { accent-color: var(--sage); width: 16px; height: 16px; }
        .login-options a { color: var(--slate); font-weight: 500; }
        .login-options a:hover { color: var(--sage); text-decoration: none; }

        .btn-login {
            width: 100%;
            height: 50px;
            border: 0;
            border-radius: 10px;
            font-family: inherit;
            font-size: 15px;
            font-weight: 600;
            letter-spacing: .5px;
            color: #fff;
            background: linear-gradient(90deg, var(--slate) 0%, var(--sage) 100%);
            box-shadow: 0 10px 20px rgba(94, 118, 138, .25);
            cursor: pointer;
            transition: transform .15s, box-shadow .15s, opacity .15s;
        }
        .btn-login:hover { transform: translateY(-1px); box-shadow: 0 14px 26px rgba(94, 118, 138, .32); }
        .btn-login:active { transform: translateY(0); }
        .btn-login:disabled { opacity: .7; cursor: default; transform: none; }
        .btn-login i { margin-left: 8px; font-size: 13px; }

        .alert-login {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 13px;
            color: #9b3b3b;
            background: #fdf0f0;
            border: 1px solid #f3d3d3;
            border-radius: 10px;
            padding: 12px 14px;
            margin-bottom: 20px;
        }

        .login-footer {
            text-align: center;
            font-size: 12px;
            color: var(--muted);
            margin-top: 32px;
        }

        @media (max-width: 767px) {
            .login-wrap { padding: 16px 12px; }
            .login-side { display: none; }
            .login-card { border-radius: 14px; }
            .login-main { padding: 24px 20px; }
            .login-logo { width: 130px; margin-bottom: 14px; }
            .login-main h1 { font-size: 18px; margin-bottom: 2px; }
            .login-main .subtitle { font-size: 12px; margin-bottom: 18px; }
            .field { margin-bottom: 14px; }
            .field label { margin-bottom: 6px; }
            .input-icon input { height: 44px; }
            .alert-login { padding: 10px 12px; margin-bottom: 14px; }
            .login-options { font-size: 12px; margin: 2px 0 18px; }
            .btn-login { height: 46px; }
            .login-footer { margin-top: 18px; }
        }
    </style>
</head>

<body>
<div class="login-wrap">
    <div class="login-card">

        <div class="login-side">
            <span class="tag">Spa Médico</span>
            <div>
                <h2>Bienvenido a tu espacio de bienestar</h2>
                <p>Gestiona pacientes, tratamientos y citas de Esencia Spa Médico desde un solo lugar.</p>
            </div>
            <span class="tag">&copy; <?=date('Y')?> Esencia</span>
        </div>

        <div class="login-main">
            <img class="login-logo" src="<?=$this->Configuracion->logoUrl()?>" alt="Esencia Spa Médico">
            <h1>Iniciar sesión</h1>
            <p class="subtitle">Ingresa tus credenciales para continuar</p>

            <?php if (isset($_GET['error'])): ?>
                <div class="alert-login"><i class="ti-alert"></i> Correo o contraseña incorrectos.</div>
            <?php endif; ?>

            <form method="post" action="<?=base_url()?>Welcome/login" id="loginForm">
                <div class="field">
                    <label for="email">Correo electrónico</label>
                    <div class="input-icon">
                        <input type="email" id="email" name="email" placeholder="usuario@correo.com" required autofocus autocomplete="username">
                        <i class="ti-email"></i>
                    </div>
                </div>

                <div class="field">
                    <label for="password">Contraseña</label>
                    <div class="input-icon">
                        <input type="password" id="password" name="password" placeholder="••••••••" required autocomplete="current-password">
                        <i class="ti-lock"></i>
                        <button type="button" class="toggle-pass" id="togglePass" aria-label="Mostrar contraseña"><i class="ti-eye" style="position:static;transform:none"></i></button>
                    </div>
                </div>

                <div class="login-options">
                    <label><input type="checkbox" id="remember"> Recordarme</label>
                    <a href="#">¿Olvidaste tu contraseña?</a>
                </div>

                <button class="btn-login" id="form_submit" type="submit">Ingresar <i class="ti-arrow-right"></i></button>
            </form>

            <div class="login-footer">Esencia Spa Médico Ltda.</div>
        </div>

    </div>
</div>

<script src="<?=base_url()?>assets/js/vendor/jquery-2.2.4.min.js"></script>
<script src="<?=base_url()?>assets/js/toastr.min.js"></script>
<script>
    $('#togglePass').on('click', function () {
        var $p = $('#password');
        var show = $p.attr('type') === 'password';
        $p.attr('type', show ? 'text' : 'password');
        $(this).find('i').css('opacity', show ? .5 : 1);
    });
    $('#loginForm').on('submit', function () {
        $('#form_submit').prop('disabled', true).html('Ingresando...');
    });
<?php if (isset($tipo, $msg)): ?>
    toastr['<?=$tipo?>']('<?=$msg?>');
<?php endif; ?>
</script>
</body>

</html>
