<section id="backoffice-container">
    <p class="texte miette-de-pain tres-petit" id="breadcrumb"><i class="fas fa-home"></i>/Compte/Dashobard/Profil</p>

    <div class="">
        <div class="container">
            <div class="row">
                <div class="col-3"></div>
                <div class="col-6 center">
                    <div class="segment turquoise elevated info">
                        <h1 class="texte souligne-turquoise">Informations profil</h1>
                        <br />
                        <br />
                        <br />
                        <form id="formulaire_update_profil" method="POST" action="/utilisateur">
                            <div class="row">
                                <div class="col-1">

                                </div>
                                <div class="col-10">
                                    <div class="row left">
                                        <div class="col-2">
                                            <p><?= LANG["profil"]["firstname"] ?></p>
                                        </div>
                                        <div class="col-10">
                                            <input disabled class="input fluide" placeholder="<?= LANG["profil"]["firstname"] ?>" type="text" id="firstname" name="firstname">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-1">
                                </div>
                            </div>
                            <br />
                            <div class="row">
                                <div class="col-1">

                                </div>
                                <div class="col-10">
                                    <div class="row left">
                                        <div class="col-2">
                                            <p><?= LANG["profil"]["lastname"] ?></p>
                                        </div>
                                        <div class="col-10">
                                            <input disabled class="input fluide" placeholder="<?= LANG["profil"]["lastname"] ?>" type="text" id="lastname" name="lastname">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-1">
                                </div>
                            </div>
                            <br />
                            <div class="row">
                                <div class="col-1">

                                </div>
                                <div class="col-10">
                                    <div class="row left">
                                        <div class="col-2">
                                            <p><?= LANG["profil"]["mail"] ?></p>
                                        </div>
                                        <div class="col-10">
                                            <input class="focus_element input turquoise-clair fluide" placeholder="<?= LANG["profil"]["mail"] ?>" type="mail" id="email" name="email">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-1">
                                </div>
                            </div>
                            <br />
                            <div class="row">
                                <div class="col-1">

                                </div>
                                <div class="col-10">
                                    <div class="row left">
                                        <div class="col-4">
                                            <p><?= LANG["profil"]["DoB"] ?></p>
                                        </div>
                                        <div class="col-8">
                                            <input class="focus_element input turquoise-clair fluide" type="date" id="birthDate" name="<?= LANG["profil"]["DoB"] ?>" require>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-1">
                                </div>
                            </div>
                            <br />
                            <div class="row">
                                <div class="col-1"></div>
                                <div class="col-10">
                                    <div class="row left">
                                        <div class="col-3">
                                            <p><?= LANG["profil"]["pwd"] ?></p>
                                        </div>
                                        <div class="col-6">
                                            <input class="focus_element input turquoise-clair fluide" placeholder="<?= LANG["profil"]["pwd"] ?>" type="password" id="password" name="pwd1" disabled>
                                        </div>
                                        <div class="col-3">
                                            <input id="bouton_modification_pwd" class="bouton inverse avertissement arrondi" type="button" value="<?= LANG['profil']['modify'] ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-1"></div>
                            </div>
                            <br />
                            <div class="row">
                                <div class="col-1"></div>
                                <div class="col-10">
                                    <div class="row left">
                                        <div class="col-3">
                                            <p><?= LANG["profil"]["new_pwd"] ?></p>
                                        </div>
                                        <div class="col-9">
                                            <input class="focus_element input turquoise-clair fluide" placeholder="<?= LANG["profil"]["new_pwd"] ?>" type="password" id="password2" name="pwd2" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-1"></div>
                            </div>
                            <br />
                            <div class="row">
                                <div class="col-1"></div>
                                <div class="col-10">
                                    <div class="row left">
                                        <div class="col-3">
                                            <p><?= LANG["profil"]["confirmation_new_pwd"] ?></p>
                                        </div>
                                        <div class="col-9">
                                            <input class="focus_element input turquoise-clair fluide" placeholder="<?= LANG["profil"]["confirmation_new_pwd"] ?>" type="password" id="password3" name="pwd3" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-1"></div>
                            </div>
                            <br />
                            <div class="row">
                                <div class="col-5">
                                    <input id="bouton_sauvegarde" name="bouton_sauvegarde" class="bouton vert arrondi inverse" type="button" value="<?= LANG["profil"]["update_profil"] ?>">
                                </div>
                                <div class="col-5">
                                    <!-- <input id="bouton_supression" name="bouton_supression" class="bouton rouge-clair arrondi inverse" type="button" value="<?= LANG["profil"]["delete_account"] ?>"> -->
                                </div>
                                <div id="colonneAnnulation" class="col-2" hidden>
                                    <input id="bouton_annulation" class="bouton avertissement arrondi inverse" type="button" value="<?= LANG["profil"]["undo_account"] ?>">
                                </div>
                            </div>
                            <div id="ligne_erreur" class="row">
                            </div>
                            <div hidden>
                                <p id="json_cache"><?php echo json_encode($_POST); ?></p>
                            </div>
                        </form>
                        <br />
                        <div class="row">
                            <div class="col-5">
                            </div>
                            <div class="col-5">
                                <!-- <input id="bouton_supression" name="bouton_supression" class="bouton rouge-clair arrondi inverse" type="button" value="<?= LANG["profil"]["delete_account"] ?>"> -->
                                <form class="inline-form bouton invisible" method="post" action="/admin/soft-delete">
                                    <input type="hidden" name="id" value="<?php echo $_SESSION['id'] ?>" />
                                    <input type="hidden" name="table" value="user" />
                                    <input type="hidden" name="origin" value="/" />
                                    <button class="bouton rouge-clair arrondi inverse" title="Bonjour" style="background-color: transparent; border: none; cursor: pointer;">Bonjour ceci est une suppression 🗑</button>
                                </form>
                            </div>
                            <div id="colonneAnnulation" class="col-2" hidden>
                                <input id="bouton_annulation" class="bouton avertissement arrondi inverse" type="button" value="<?= LANG["profil"]["undo_account"] ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-3"></div>
            </div>
        </div>
    </div>
</section>
<script src="../assets/js/utilisateur.js"></script>