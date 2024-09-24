<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UFCD 5417 | Avaliação 2024</title>
    <link rel="stylesheet" href="assets/css/dataTables.css">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="assets/js/lib/jquery.js"></script>
    <script src="assets/js/lib/dataTables.js"></script>
    <script src="assets/js/lib/bootstrap.js"></script>
    <script src="assets/js/template.js"></script>
</head>

<body>
    <div class="container-fluid">
        <?php include_once 'menu.php' ?>
    </div>

    <div class="container mx-auto">
        <div class="container text-center mt-5">
            <div class="row justify-content-md-center">
                <div class="col-md-auto title-background">
                    <h5>Template</h5>
                </div>
            </div>
        </div>
        <!-- Registo de Template -->
        <section id="registerTemplplate">
            <h5>Registo</h5>
            <div id="templateRegistration" class="row">
                <form class="row g-3 needs-validation mt-3" novalidate>
                    <div class="col-md-6">
                        <label for="descriptionTemplate" class="form-label">Descrição</label>
                        <input type="text" class="form-control form-control-sm" id="descriptionTemplate" required>
                    </div>
                    <div class="col-md-6">
                        <label for="numberTemplate" class="form-label">Número</label>
                        <input type="number" class="form-control form-control-sm" id="numberTemplate" required>
                    </div>
                    <div class="col-md-6">
                        <label for="dateTemplate" class="form-label">Data</label>
                        <input type="date" class="form-control form-control-sm" id="dateTemplate" required>
                    </div>
                    <div class="col-md-6">
                        <label for="datetimeTemplate" class="form-label">Data-Hora</label>
                        <input type="datetime" class="form-control form-control-sm" id="datetimeTemplate" required>
                    </div>
                    <div class="col-md-6">
                        <label for="emailTemplate" class="form-label">Email</label>
                        <input type="email" class="form-control form-control-sm" id="emailTemplate" required>
                    </div>
                    <div class="col-md-6">
                        <label for="phoneTemplate" class="form-label">Telefone</label>
                        <input type="phone" class="form-control form-control-sm" id="phoneTemplate" required>
                    </div>
                    <div class="col-md-6">
                        <label for="imgTemplate" class="form-label">Imagem</label>
                        <input type="file" class="form-control form-control-sm" id="imgTemplate" required>
                    </div>
                    <div class="col-md-6">
                        <label for="selectTemplate" class="form-label">Seleção</label>
                        <select class="form-select" aria-label="Default select example" id="selectTemplate">
                        </select>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-dark btn-sm" type="button" onclick="registerTemplate()">Registar</button>
                    </div>
                </form>
            </div>
        </section>

        <!-- Lista de Template -->
        <section id="templateList">
            <h5>Listagem</h5>
            <div id="templateFilterContainer" class="row">
                <form class="row g-3 needs-validation mt-3" novalidate>
                    <div class="col-md-6">
                        <label for="templateFilterSelect" class="form-label">Filtrar por Template</label>
                        <select class="form-select" aria-label="Default select example" id="templateFilterSelect" onchange="getTemplateTable()">
                        </select>
                    </div>
                </form>
            </div>
            <div id="listTemplate">
            </div>
        </section>

        <!-- Modal Associação de Template -->
        <div id="templateTypes">
            <div class="modal" tabindex="-1" id="templateTypesModal">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Associar Template</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="row g-3 needs-validation mt-3" novalidate>
                                <div id="listTemplateTypes">
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-dark btn-sm" type="button" id="registerTemplateTypesBtn">Associar</button>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Alteração Dados Template -->
        <div id="templateDetails">
            <div class="modal" tabindex="-1" id="templateDetailsModal">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Detalhes de Teplate</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="row g-3 needs-validation mt-3" novalidate>
                                <div class="col-md-6">
                                    <label for="descriptionTemplateEdit" class="form-label">Descrição</label>
                                    <input type="text" class="form-control form-control-sm" id="descriptionTemplateEdit" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="numberTemplateEdit" class="form-label">Número</label>
                                    <input type="number" class="form-control form-control-sm" id="numberTemplateEdit" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="dateTemplateEdit" class="form-label">Data</label>
                                    <input type="date" class="form-control form-control-sm" id="dateTemplateEdit" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="datetimeTemplateEdit" class="form-label">Data-Hora</label>
                                    <input type="datetime" class="form-control form-control-sm" id="datetimeTemplateEdit" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="emailTemplateEdit" class="form-label">Email</label>
                                    <input type="email" class="form-control form-control-sm" id="emailTemplateEdit" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="phoneTemplateEdit" class="form-label">Telefone</label>
                                    <input type="phone" class="form-control form-control-sm" id="phoneTemplateEdit" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="imgTemplateEdit" class="form-label">Imagem</label>
                                    <input type="file" class="form-control form-control-sm" id="imgTemplateEdit" required>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-dark btn-sm" type="button" id="editTemplateBtn">Guardar Alterações</button>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

