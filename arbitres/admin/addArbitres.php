<?php
    session_start();
    if(!isset($_SESSION['id_admin'])){
        header('location: ./index.php');
    }
?>

<?php 
  include('./base.php');
?>
    <div class="container ">
        <h1>Ajouter Arbitres</h1>
        <form action="" method="post" id="form" class="form">
            <div class="row ">
                <label class="label" for="">Nom Prenoms</label>
                <input class="form-control" type="text" id="nom_prenoms" name="nom_prenoms"> 
            </div>


            <div class="row ">
                <label class="label" for="">Sexe</label>
                <select name="sexe" id="sexe" class="form-select" aria-label="Default select example">
                    <option value="M">M</option>
                    <option value="F">F</option>
                </select>
            </div>

            <div class="row ">
                <label class="label" for="">Date de naissaince</label>
                <input class="form-control" type="date" id="date_naissance" name="date_naissance">
            </div>

            <div class="row ">
                <label class="label" for="">Annee de grade </label>
                <input class="form-control" type="number" name="anne_grade" id="anne_grade">
            </div>

            <div class="row ">
                <label class="label" for="">Contact</label>
                <input class="form-control" type="text" name="contact" id="contact">
            </div>

            <div class="row ">
                <label class="label" for="">Email</label>
                <input class="form-control" type="email" name="email" id="email">
            </div>

            <div class="row ">
                <label class="label" for="">Grade</label>
                <select name="grade" id="grade" class="form-select" aria-label="Default select example">
                    <option value="eleve">Eleve</option>
                    <option value="district">District</option>
                    <option value="ligue">Ligue</option>
                    <option value="federal">Federal</option>
                    <option value="fifa">FIFA</option>
                </select>
            </div>

            <div class="row ">
                <label class="label" for="">Regions</label>
                <select name="region" id="region" class="form-select" aria-label="Default select example">
                    <option value="maritime">Martime</option>
                    <option value="central">Central</option>
                    <option value="plateau">Plateau</option>
                    <option value="kara">Kara</option>
                    <option value="savane">Savane</option>
                </select>
            </div>

            <div class="row ">
                <button class="form-control btn" type="submit" name='submit'> SUBMIT </button>
            </div>
        </form>
    </div>

<script>
    let form = document.querySelector('#form')

    function submitForm (event){
        event.preventDefault();

        const nom_prenoms = document.querySelector('#nom_prenoms');
        const sexe = document.querySelector('#sexe');
        const date_naissance = document.querySelector('#date_naissance');
        const anne_grade = document.querySelector('#anne_grade');
        const contact = document.querySelector('#contact');
        const email = document.querySelector('#email');
        const grade = document.querySelector('#grade');
        const region= document.querySelector('#region');


        const data = new FormData();

        data.append('nom_prenoms', nom_prenoms.value);
        data.append('sexe', sexe.value);
        data.append('date_naissance', date_naissance.value);
        data.append('anne_grade', anne_grade.value);
        data.append('contact', contact.value);
        data.append('email', contact.value);
        data.append('grade', grade.value);
        data.append('region', region.value);

        const xht = new XMLHttpRequest();
        xht.open('POST', 'addArbitresOperation.php')

        xht.onload = function (){
            nom_prenoms.value = '';
            anne_grade.value = '';
            contact.value = '';

            window.confirm(xht.responseText);
        }

        xht.send(data);
    }
    form.addEventListener('submit', submitForm);
</script>

