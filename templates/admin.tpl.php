<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <script src="https://kit.fontawesome.com/2ebde0cba5.js"></script>
    <link rel="stylesheet" href="/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="/resources/trix/trix.css">
    <link rel="stylesheet" href="/resources/pnotify/pnotify.custom.min.js">
    <link rel="stylesheet" href="/css/style.css">

    <title>Painel administrativo</title>
  </head>
  <body class="d-flex flex-column">
    <div id="header">
        <nav class="navbar navbar-dark bg-dark">
            <span>
                <a href="/admin" class="navbar-brand">Admin</a>
                <span class="navbar-text">
                    Painel administrativo
                </span>
            </span>

            <a href="/admin/auth/logout" class="btn btn-danger"><i class="fas fa-sign-out-alt"></i> sair</a>
        </nav>
    </div>

    <div id="main">
        <div class="row">
            <div class="col">
                <ul id="main-menu" class="nav flex-column nav-pills bg-secondary text-white p-2">
                    <li class="nav-item ">
                        <span class="nav-link text-white-50"><small>MENU</small></span>
                    </li>
                    <li class="nav-item">
                        <a href="/admin/pages" class="nav-link <?php if (resolve('/admin/pages.*')): ?> active <?php endif; ?>"><i class="fas fa-file"></i> Páginas</a>
                    </li>
                    <li class="nav-item">
                        <a href="/admin/users" class="nav-link <?php if (resolve('/admin/users.*')): ?> active <?php endif; ?>"><i class="fas fa-users"></i> Usuários</a>
                    </li>
                </ul>
            </div>
            <div id="content" class="col-10">
                <?php include $content ?>
            </div>
        </div>        
    </div>
    
    

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="/resources/trix/trix.js"></script>
    <script src="/resources/pnotify/pnotify.custom.min.js"></script>

    <script>

        document.addEventListener('trix-attachment-add', function () {
            const attachment = event.attachment;
            if (!attachment.file){
                return;
            }

            const form = new FormData();
            form.append('file', attachment.file);

            $.ajax({
                url: '/admin/upload/image',
                method: 'POST',
                data: form,
                contentType: false,
                processData: false,
                xhr: function () {
                    const xhr = $.ajaxSettings.xhr();
                    xhr.upload.addEventListener('progress', function (e) {
                       let progress = e.loaded / e.total * 100;
                       attachment.setUploadProgress(progress);
                    });

                    return xhr;
                }
            }).done(function (response) {
                attachment.setAttributes({
                    url: response,
                    href: response
                });
            }).fail(function () {
                console.log("Deu errado");
            });
        });

        <?php flash(); ?>

        // const confirmEl = document.querySelector('.confirm');
        // confirmEl.addEventListener('click', function (e) {
        //     e.preventDefault();
        // });

    </script>
  </body>
</html>
