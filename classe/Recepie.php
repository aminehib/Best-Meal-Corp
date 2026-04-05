<?php

namespace classe ;

class Recepie{

    public function getHTML(){
        ?>
        <div class = "recepie" id = "<?php echo htmlspecialchars($this->id) ?>" >
            <h2><?= $this->title ? htmlspecialchars($this->title) : '<span class="empty-placeholder">Sans titre</span>' ?></h2>
            <img src= "<?php echo "/ProjetWeb/pages/images/uploads/" .htmlspecialchars($this->image_url) ?>" alt="">
            <p> <?= $this->description ? htmlspecialchars($this->description) : '<span class="empty-placeholder">Aucune description.</span>' ?> </p>
            <a href="/ProjetWeb/pages/recette.php?id=<?php echo htmlspecialchars($this->id)?>" class="btn btn-primary">Voir la recette</a>
        </div>
        <?php
    }


    public function getTitle(){
        return $this->title ;
    }


    public function getId(){
        return $this->id ;
    }




}