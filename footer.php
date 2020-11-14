<?php require_once('inc/notifications.php'); ?>

    <!--Footer-->
    <footer class="bg-primary text-center text-lg-left mt-3">
        <!-- Copyright -->
        <div class="text-center p-3 text-light" style="background-color: rgba(0, 0, 0, 0.2);">
            © <?php echo date('Y'); ?> - <a class="text-light" href="http://www.drs.gov.ua/" target="_blank">Державна
                регуляторна служба України</a>
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
                        <form action="inc/notifications.php" class="row g-3" method="post">
                            <div class="col-12">
                                <div class="form-outline">
                                    <input
                                            type="text"
                                            name="user_name"
                                            class="form-control"
                                            id="validationCustom01"
                                            placeholder="Наприклад, Петрик П'яточкін"
                                            required
                                    />
                                    <label for="validationCustom01" class="form-label">Ім'я і прізвище</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="input-group form-outline">
                                    <input
                                            type="text"
                                            name="user_state"
                                            class="form-control"
                                            id="validationCustomUsername"
                                            aria-describedby="inputGroupPrepend"
                                            required
                                    />
                                    <label for="validationCustomUsername" class="form-label">Структурний
                                        підрозділ</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-outline">
                                    <input
                                            class="form-control"
                                            name="notification_text"
                                            id="validationCustom03"
                                            placeholder="Короткий опис проблеми..."
                                            required style="resize: none;"/>
                                    <label for="validationCustom03" class="form-label">Проблема</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-outline">
                                    <input
                                            type="email"
                                            name="user_email"
                                            class="form-control"
                                            required/>
                                    <label for="validationCustom05" class="form-label">E-mail</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-outline">
                                    <input
                                            type="text"
                                            name="user_phone"
                                            class="form-control"
                                            required/>
                                    <label for="validationCustom06" class="form-label">Телефон</label>
                                </div>
                            </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="submit" class="btn btn-info">
                        <i class="fa fa-paper-plane mr-1"></i>
                        Відправити
                    </button>
                </div>
            </div>
        </div>
    </div>
<!-- Modal Form-->
<!-- Modal Form-->
<div class="modal fade" id="notificationsPopup" tabindex="1" aria-labelledby="notificationsPopup"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary" id="notificationsPopup">Запити від
                    працівників
                    <?php
                        if (get_notification_count() > 0 ){
                            echo get_notification_count();
                        }
                    ?>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">

                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Прізвище, Ім'я</th>
                            <th scope="col">Відділ</th>
                            <th scope="col">Проблема</th>
                            <th scope="col">E-mail</th>
                            <th scope="col">Телефон</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th scope="row"><?= $notifications_list->id ?></th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>@fat</td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>Larry</td>
                            <td>the Bird</td>
                            <td>@twitter</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="submit" class="btn btn-info">
                    <i class="fa fa-paper-plane mr-1"></i>
                    Відправити
                </button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Form-->
<?php wp_footer(); ?>
</body>

</html>