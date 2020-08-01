<!--Footer-->
<footer class="bg-primary text-center text-lg-left mt-3">
    <!-- Copyright -->
    <div class="text-center p-3 text-light" style="background-color: rgba(0, 0, 0, 0.2);">
        © <?php echo date('Y'); ?> - <a class="text-light" href="http://www.drs.gov.ua/" target="_blank">Державна регуляторна служба України</a>
        | Відділ інформаційних технологій та цифрового розвитку
    </div>
    <!-- Copyright -->
</footer>
<!--/.Footer-->

<!-- Modal Form-->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary" id="exampleModalLabel">Запит в службу техпідтримки</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form class="row g-3 needs-validation" novalidate>
                        <div class="col-12">
                            <div class="form-outline">
                                <input
                                type="text"
                                class="form-control"
                                id="validationCustom01"
                                required
                                />
                                <label for="validationCustom01" class="form-label">Ім'я</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-outline">
                                <input
                                type="text"
                                class="form-control"
                                id="validationCustom02"
                                required
                                />
                                <label for="validationCustom02" class="form-label">Прізвище</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="input-group form-outline">
                                <input
                                type="text"
                                class="form-control"
                                id="validationCustomUsername"
                                aria-describedby="inputGroupPrepend"
                                required
                                />
                                <label for="validationCustomUsername" class="form-label">Структурний підрозділ</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-outline">
                                <textarea class="form-control" id="validationCustom03" placeholder="Короткий опис проблеми..." required style="resize: none;"/></textarea>
                                <label for="validationCustom03" class="form-label">Проблема</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-outline">
                                <input type="text" class="form-control" required />
                                <label for="validationCustom05" class="form-label">Телефон</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <span type="button" class="text-muted mr-2" data-dismiss="modal">
                        Скасувати
                    </span>
                    <button type="submit" class="btn btn-info">
                    <i class="fa fa-paper-plane mr-1"></i>
                    Відправити</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Form-->
<?php wp_footer(); ?>
</body>

</html>