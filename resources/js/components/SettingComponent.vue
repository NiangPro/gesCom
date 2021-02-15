<template>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item col">
                        <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Paramètres Généraux</a>
                    </li>
                    <li class="nav-item col">
                        <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Profil</a>
                    </li>
                    <li class="nav-item col">
                        <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Mot de passe</a>
                    </li>
                    <li class="nav-item col">
                        <a class="nav-link" id="pills-users-tab" data-toggle="pill" href="#pills-users" role="tab" aria-controls="pills-users" aria-selected="false">Utilisateurs</a>
                    </li>
                    <li class="nav-item col">
                        <a class="nav-link" id="pills-user-tab" data-toggle="pill" href="#pills-user" role="tab" aria-controls="pills-user" aria-selected="false">Ajout utilisateur</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <edit-setting></edit-setting>
                    </div>
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                        Profil
                    </div>
                    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                        <edit-password></edit-password>
                    </div>
                    <div class="tab-pane fade" id="pills-users" role="tabpanel" aria-labelledby="pills-users-tab">
                        Liste des utilisateurs
                    </div>
                    <div class="tab-pane fade" id="pills-user" role="tabpanel" aria-labelledby="pills-user-tab">
                        <add-user></add-user>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {

}
</script>

<style>

</style>
