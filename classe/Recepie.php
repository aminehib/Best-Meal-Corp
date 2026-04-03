<?php

namespace classe ;

class Recepie{

    public function getHTML(){
        ?>
        <div class = "recepie" id = "<?php echo htmlspecialchars($this->id) ?>" >
            <h2><?= htmlspecialchars($this->title) ?></h2>
            <img src= "<?php echo "/ProjetWeb/pages/images/uploads/" .htmlspecialchars($this->image_url) ?>" alt="">
            <p> <?php echo htmlspecialchars($this->description) ?> </p>
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