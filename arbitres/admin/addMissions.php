<?php
    
    session_start();
    if(!isset($_SESSION['id_admin'])){
        header('location: ./index.php');
    }
    include('./selectAllArbitres.php');

?>

<?php 
  include('./base.php');
?>
    <div class="container">
        <h1>Ajouter Des missions</h1>
        <form action="" method="post" id="form" class="form">
            <div class="row">
                <label class="label" for="">Date de la mission</label>
                <input class="form-control" type="date" id="date_mission" name="date_mission"> 
            </div>


            <div class="row">
                <label class="label" for="">Team 1</label>
                <input type="text" id="team1" name="team1" class="form-control">
            </div>

            <div class="row">
                <label class="label" for="">Team 2</label>
                <input type="text" id="team2" name="team2" class="form-control">
            </div>

            <div class="row">
                <label class="label" for="">Commissaire</label>
                <input class="form-control" type="text" name="commissaire" id="commissaire">
            </div>

            <div class="row">
                <label class="label" for="">Note</label>
                <input class="form-control" type="number" name="note" id="note" min="0" max="20">
            </div>

            <div class="row">
                <label class="label" for="">Commentaire</label>
                <textarea name="commentaire" id="commentaire" cols="30" rows="10"></textarea>
            </div>

            <div class="row">
                <label class="label" for="">Arbitres</label>
                <select name="id_arbitre" id="id_arbitre" class="form-select" aria-label="Default select example">
                    <?php 
                        foreach($arbitres as $arbitre) : ?>
                            <option value="<?= $arbitre['id_arbitre'] ?>"><?= $arbitre['nom_prenoms'] ?> </option>
                       
                    <?php
                        endforeach
                    ?>
                </select>
            </div>

            <div class="row">
                <button class="form-control btn" type="submit" name='submit'> SUBMIT </button>
            </div>                    

        </form>
    </div>

<script>
    let form = document.querySelector('#form');
    
    

    function getAllArbitre(){
        let arbitre = document.querySelector('#content_arbitre');
        const xht = new XMLHttpRequest();
        xht.open('GET', 'selectAllArbitres.php')

        xht.onload = function (){
            let arbitres = JSON.parse(xht.responseText);

            const arbitre = arbitres.map(
                function(ab){
                    return `<option value=" ${ab.id_arbitre} "> ${ab.nom_prenoms}</option>`
                }
            ).join('');

            arbitre.innerHTML = arbitre;
        }

        xht.send();
    }

    function submitForm (event){
        event.preventDefault();

        const date_mission = document.querySelector('#date_mission');
        const team1 = document.querySelector('#team1');
        const team2 = document.querySelector('#team2');
        const commissaire = document.querySelector('#commissaire');
        const note = document.querySelector('#note');
        const commentaire = document.querySelector('#commentaire');
        const id_arbitre= document.querySelector('#id_arbitre');


        const data = new FormData();

        data.append('date_mission', date_mission.value);
        data.append('team1', team1.value);
        data.append('team2', team2.value);
        data.append('commissaire', commissaire.value);
        data.append('note', note.value);
        data.append('commentaire', commentaire.value);
        data.append('id_arbitre', id_arbitre.value);

        const xht = new XMLHttpRequest();
        xht.open('POST', 'addMissionsOperation.php')

        xht.onload = function (){
            team1.value = '';
            team2.value = '';
            commissaire.value = '';
            note.value = '';
            commentaire.value = '';
            window.confirm(xht.responseText);
        }

        xht.send(data);
    }
    form.addEventListener('submit', submitForm);
    getAllArbitre();
</script>

