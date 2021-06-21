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
                <h5 class="modal-title text-primary" id="exampleModalLabel">Потрібна допомога!</h5>
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
                                <label for="validationCustom01" class="form-label">Ваше Ім'я та прізвище</label>
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
                            <div class="border-danger py-3 px-2" style="border: 1px dotted;">
                                <div class="col-12">
                                    <div class="form-outline">
                                        <input
                                                class="form-control"
                                                name="notification_text"
                                                id="validationCustom03"
                                                placeholder="Опис проблеми для програміста..."
                                                style="resize: none;"/>
                                        <label for="validationCustom03" class="form-label">Заповніть, якщо Ваш запит
                                            до
                                            IT
                                            відділу</label>
                                    </div>
                                </div>
                                <div class="col-12 mt-3">
                                    <div class="form-outline">
                                        <input
                                                class="form-control"
                                                name="notification_text_maintenance"
                                                id="validationCustom04"
                                                placeholder="Опис проблеми для господарського відділу..."
                                                style="resize: none;"/>
                                        <label for="validationCustom04" class="form-label">Заповніть, якщо Ваш запит
                                            до
                                            Господарського відділу</label>
                                    </div>
                                </div>
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
                            <input
                                    type="hidden"
                                    name="notification_date"
                                    class="form-control"
                                    value="<?php echo date("Y-m-d H:i"); ?>"/>
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
                <h5 class="modal-title text-primary" id="notificationsPopup">Нових запитів
                    <?php
                    if (get_notification_count_by_status_new() > 0) {
                        echo ": " . get_notification_count_by_status_new();
                    }
                    ?>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <ul class="nav nav-tabs mb-2 nav-justified mb-3" id="tab">
                        <li class="nav-item">
                            <a class="nav-link text-primary active" id="home-tab" data-toggle="tab" href="#new">IT-відділ
                                <?php
                                if (get_notification_count_for_it() > 0) {
                                    echo "(" . get_notification_count_for_it() . ")";
                                }
                                ?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-warning" id="maintenance-tab" data-toggle="tab"
                               href="#maintenance">Господарський відділ
                                <?php
                                if (get_notification_count_for_maintenance() > 0) {
                                    echo "(" . get_notification_count_for_maintenance() . ")";
                                }
                                ?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-success" id="profile-tab" data-toggle="tab"
                               href="#done">Виконані</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-danger" id="messages-tab" data-toggle="tab"
                               href="#deleted">Видалені</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="new">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Прізвище, Ім'я</th>
                                    <th scope="col">Відділ</th>
                                    <th scope="col">Проблема</th>
                                    <th scope="col">E-mail</th>
                                    <th scope="col">Телефон</th>
                                    <th scope="col">Створено</th>
                                    <?php if (current_user_can('edit_dashboard')) {
                                        echo '<th scope="col">Дія</th>';
                                    } ?>
                                </tr>
                                </thead>
                                <?php get_notifications_list_by_text_it();
                                foreach (get_notifications_list_by_text_it() as $notification_for_it) {
                                    ?>
                                    <tbody>
                                    <tr>
                                        <th scope="row"><?php echo $notification_for_it['id']; ?></th>
                                        <td><?php echo $notification_for_it['user_name']; ?></td>
                                        <td><?php echo $notification_for_it['user_state']; ?></td>
                                        <td class="notification-text"><?php echo $notification_for_it['notification_text']; ?></td>
                                        <td><?php echo $notification_for_it['user_email']; ?></td>
                                        <td><?php echo $notification_for_it['user_phone']; ?></td>
                                        <td><?php echo $notification_for_it['notification_date']; ?></td>
                                        <?php if (current_user_can('edit_dashboard')) { ?>
                                            <td><a href="?upd=<?= $notification_for_it['id'] ?>" type="submit"
                                                   class="btn btn-success" title="Відмітити виконаним">
                                                    <i class="far fa-check-circle mr-1"></i>
                                                </a>
                                                <a href="?del=<?= $notification_for_it['id'] ?>" type="submit"
                                                   class="btn btn-danger" title="Видалити зі списку">
                                                    <i class="fas fa-minus-circle mr-1"></i>
                                                </a>
                                            </td>
                                        <?php } ?>
                                    </tr>
                                    </tbody>
                                    <?php
                                }
                                ?>
                            </table>
                        </div>
                        <div class="tab-pane" id="maintenance">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Прізвище, Ім'я</th>
                                    <th scope="col">Відділ</th>
                                    <th scope="col">Проблема</th>
                                    <th scope="col">E-mail</th>
                                    <th scope="col">Телефон</th>
                                    <th scope="col">Дія</th>
                                </tr>
                                </thead>
                                <?php get_notifications_list_by_text_maintenance();
                                foreach (get_notifications_list_by_text_maintenance() as $notification_maintenance) {
                                    ?>
                                    <tbody>
                                    <tr>
                                        <th scope="row"><?php echo $notification_maintenance['id']; ?></th>
                                        <td><?php echo $notification_maintenance['user_name']; ?></td>
                                        <td><?php echo $notification_maintenance['user_state']; ?></td>
                                        <td class="notification-text"><?php echo $notification_maintenance['notification_text_maintenance']; ?></td>
                                        <td><?php echo $notification_maintenance['user_email']; ?></td>
                                        <td><?php echo $notification_maintenance['user_phone']; ?></td>
                                        <td>
                                            <a href="?upd=<?= $notification_maintenance['id'] ?>" type="submit"
                                               class="btn btn-success" title="Відмітити виконаним">
                                                <i class="far fa-check-circle mr-1"></i>
                                            </a>
                                            <?php if (current_user_can('edit_dashboard')) { ?>
                                                <a href="?del=<?= $notification_for_it['id'] ?>" type="submit"
                                                   class="btn btn-danger" title="Видалити зі списку">
                                                    <i class="fas fa-minus-circle mr-1"></i>
                                                </a>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    </tbody>
                                    <?php
                                }
                                ?>
                            </table>
                        </div>
                        <div class="tab-pane" id="done">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Прізвище, Ім'я</th>
                                    <th scope="col">Відділ</th>
                                    <th scope="col">Проблема</th>
                                    <th scope="col">E-mail</th>
                                    <th scope="col">Телефон</th>
                                    <?php if (current_user_can('edit_dashboard')) {
                                        echo '<th scope="col">Дія</th>';
                                    } ?>
                                </tr>
                                </thead>
                                <?php get_notifications_list_by_status_done();
                                foreach (get_notifications_list_by_status_done() as $notification_done) {
                                    ?>
                                    <tbody>
                                    <tr>
                                        <th scope="row"><?php echo $notification_done['id']; ?></th>
                                        <td><?php echo $notification_done['user_name']; ?></td>
                                        <td><?php echo $notification_done['user_state']; ?></td>
                                        <td class="notification-text"><?php echo $notification_done['notification_text'] . " " . $notification_done['notification_text_maintenance']; ?></td>
                                        <td><?php echo $notification_done['user_email']; ?></td>
                                        <td><?php echo $notification_done['user_phone']; ?></td>
                                        <?php if (current_user_can('edit_dashboard')) { ?>
                                            <td>
                                                <a href="?del=<?= $notification_done['id'] ?>" type="submit"
                                                   class="btn btn-danger" title="Видалити зі списку">
                                                    <i class="fas fa-minus-circle mr-1"></i>
                                                </a>
                                            </td>
                                        <?php } ?>
                                    </tr>
                                    </tbody>
                                    <?php
                                }
                                ?>
                            </table>
                        </div>
                        <div class="tab-pane" id="deleted">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Прізвище, Ім'я</th>
                                    <th scope="col">Відділ</th>
                                    <th scope="col">Проблема</th>
                                    <th scope="col">E-mail</th>
                                    <th scope="col">Телефон</th>
                                    <?php if (current_user_can('edit_dashboard')) {
                                        echo '<th scope="col">Дія</th>';
                                    } ?>
                                </tr>
                                </thead>
                                <?php get_notifications_list_by_status_deleted();
                                foreach (get_notifications_list_by_status_deleted() as $notification_deleted) {
                                    ?>
                                    <tbody>
                                    <tr>
                                        <th scope="row"><?php echo $notification_deleted['id']; ?></th>
                                        <td><?php echo $notification_deleted['user_name']; ?></td>
                                        <td><?php echo $notification_deleted['user_state']; ?></td>
                                        <td class="notification-text"><?php echo $notification_deleted['notification_text'] . " " . $notification_deleted['notification_text_maintenance']; ?></td>
                                        <td><?php echo $notification_deleted['user_email']; ?></td>
                                        <td><?php echo $notification_deleted['user_phone']; ?></td>
                                        <?php if (current_user_can('edit_dashboard')) { ?>
                                            <td><a href="?upd=<?= $notification_deleted['id'] ?>" type="submit"
                                                   class="btn btn-success" title="Відмітити виконаним">
                                                    <i class="far fa-check-circle mr-1"></i>
                                                </a>
                                            </td>
                                        <?php } ?>
                                    </tr>
                                    </tbody>
                                    <?php
                                }
                                ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Form-->
<?php wp_footer(); ?>
</body>

</html>
